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

function j3d_model_make_normals(model)
{
   model.normals = new Array(model.faces.length);
   
   for (var i = 0; i < model.faces.length; i++) {
      var v1 = j3d_vector_subtract(model.vertices[0][model.faces[i].indices[2]], model.vertices[0][model.faces[i].indices[0]]);
      var v2 = j3d_vector_subtract(model.vertices[0][model.faces[i].indices[1]], model.vertices[0][model.faces[i].indices[0]]);
      
      model.normals[i] = j3d_vector_normalize(j3d_vector_cross(v2, v1));

//        model.normals[i][0] = -model.normals[i][0];
//        model.normals[i][1] = -model.normals[i][1];
//        model.normals[i][2] = -model.normals[i][2];
//        model.normals[i][3] = -model.normals[i][3];

      model.faces[i].normal = i;
   }
}

function j3d_model_make_centers(model)
{
   model.centers = new Array(model.faces.length);

   for (var i = 0; i < model.faces.length; i++) {
      var center = [0, 0, 0, 0];

      for (var j = 0; j < model.faces[i].indices.length; j++)
         center = j3d_vector_add(center, model.vertices[0][model.faces[i].indices[j]]);

      model.centers[i] = j3d_vector_multiply(center, 1.0 / model.faces[i].indices.length);
      
      model.faces[i].center = i;
   }
}

function j3d_model_multiply(model, matrix, mprime)
{
   if (mprime == null)
      mprime = {vertices: []};

   mprime.normals = model.normals;
   mprime.centers = model.centers;
   mprime.faces = model.faces;
   mprime.bias = model.bias;
                 
   for (var i = 0; i < model.vertices.length; i++) {
      if (mprime.vertices[i] == null || mprime.vertices[i].length < model.vertices[i].length)
         mprime.vertices[i] = j3d_util_make2darray(model.vertices[i].length, 4);
         
      j3d_matrix_multiply(model.vertices[i], matrix, mprime.vertices[i]);
   }
                 
   return mprime;
}                                    

function j3d_model_dehomogenize(model, mprime)
{
   if (mprime == null)
      mprime = {vertices: []};

   mprime.normals = model.normals;
   mprime.centers = model.centers;
   mprime.faces = model.faces;
   mprime.bias = model.bias;

   for (var i = 0; i < model.vertices.length; i++) {
      if (mprime.vertices[i] == null || mprime.vertices[i].length < model.vertices[i].length)
         mprime.vertices[i] = j3d_util_make2darray(model.vertices[i].length, 4);
      
      j3d_matrix_dehomogenize(model.vertices[i], mprime.vertices[i]);
   }
                 
   return mprime;
}