/*
   Ajax3d - a 3d engine using the WHATWG HTML <canvas> tag.
   
   Copyright (C) 2007 Eben Upton
   
   This program is free software; you can redistribute it and/or
   modify it under the terms of version 2 of the GNU General Public 
   License as published by the Free Software Foundation.
   
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
   
   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

function j3d_clip(planes)
{
   this.planes = planes;

   var planes_internal;

   this.transform = function(matrix)
   {
      var transpose = j3d_matrix_transpose(matrix);
      
      planes_internal = j3d_matrix_multiply(planes, transpose);
   };                       
                       
   this.clip_indices = function(indices, vertices, matrix, mask)
   {
      if (mask == null)
         mask = 0xffffffff;
      
      var vertices0 = vertices[0];
      var vertices1 = vertices[1];
      var thresh = vertices0.length;
         
      for (var i = 0; indices.length > 0 && i < planes_internal.length; i++) {
         var plane = planes_internal[i];
         
         if (mask & 1 << i) {
            var new_indices = [];
         
            var index = indices[indices.length - 1];
            var vertex = index < thresh ? vertices0[index] : vertices1[index - thresh];
            var dot = j3d_vector_dot(vertex, plane);
         
            for (var j = 0; j < indices.length; j++) {
               var new_index = indices[j];
               var new_vertex = new_index < thresh ? vertices0[new_index] : vertices1[new_index - thresh];
               var new_dot = j3d_vector_dot(new_vertex, plane);
      
               if (new_dot > 0 && dot <= 0 || new_dot <= 0 && dot > 0) {
                  new_indices.push(thresh + vertices1.j3d_length);
                  
                  j3d_vector_blend(vertex, new_vertex, dot / (dot - new_dot), vertices1[vertices1.j3d_length++]);
               }
         
               if (new_dot <= 0)
                  new_indices.push(new_index);
         
               index = new_index;
               vertex = new_vertex;
               dot = new_dot;    
            }
            
            indices = new_indices;
         }
      }
      
      return indices;
   };

   this.clip_model = function(model, matrix, mprime)
   {
      if (mprime == null) {
         mprime = {vertices: []};
      }

      mprime.vertices[0] = model.vertices[0];
      
      if (mprime.vertices[1] == null || mprime.vertices[1].length < model.faces.length * planes.length)
         mprime.vertices[1] = j3d_util_make2darray(model.faces.length * planes.length, 4);
         
      mprime.vertices[1].j3d_length = 0;

      mprime.normals = model.normals;
      mprime.centers = model.centers;
      
      if (mprime.faces == null || mprime.faces.length < model.faces.length)
         mprime.faces = j3d_util_makeobjectarray(model.faces.length);
         
//      mprime.faces.j3d_length = 0;
      
      mprime.bias = model.bias;
      
      this.transform(matrix);

      var length = 0;
      
      for (var i = 0; i < model.faces.length; i++) {
         var face = model.faces[i];
   
         if (face.clip == 0) {
            var fprime = mprime.faces[length++];
            
            fprime.indices = face.indices;
            fprime.material = face.material;
            fprime.normal = face.normal;
            fprime.center = face.center;
            fprime.clip = face.clip;
            fprime.cull = face.cull;
            fprime.bias = face.bias;
         } else {
            var iprime = this.clip_indices(face.indices, mprime.vertices, face.clip);
            
            if (iprime.length > 0) {
               var fprime = mprime.faces[length++];
               
               fprime.indices = iprime;
               fprime.material = face.material;
               fprime.normal = face.normal;
               fprime.center = face.center;
               fprime.clip = face.clip;
               fprime.cull = face.cull;
               fprime.bias = face.bias;
            }
         }
      }
      
      mprime.faces.j3d_length = length;
      
      return mprime;
   }
}