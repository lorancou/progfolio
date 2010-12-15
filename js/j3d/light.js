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

function j3d_light(dir)
{
	this.dir = dir;
	this.eye = [0, 0, 0, 1];
	
	var dir_internal;
	var eye_internal;

	var work1 = [0, 0, 0, 0];
	var work2 = [0, 0, 0, 0];
    
	this.transform = function(matrix) 
	{
		var inverse = j3d_matrix_invert_simple(matrix);
		
		dir_internal = j3d_matrix_multiply([this.dir], inverse)[0];
		eye_internal = j3d_matrix_multiply([this.eye], inverse)[0];
	};
	
	this.light_face = function(normal, center, material)
	{
		if (material.static)
		{
			return material.static;
		}
		else
		{
			// Ambient component
			var r = material.ambient[0];
			var g = material.ambient[1];
			var b = material.ambient[2];
			
			// Diffuse component
			var diff = j3d_vector_dot(normal, dir_internal);

			if (diff > 0)
			{
				r += material.diffuse[0] * diff;
				g += material.diffuse[1] * diff;
				b += material.diffuse[2] * diff;
			}
			
			// Specular component
			if (normal != null && center != null)
			{
				var v1 = j3d_vector_subtract(center, eye_internal, work1);
				var dot = j3d_vector_dot(v1, normal);
				var v2 = j3d_vector_multiply(normal, -2 * dot, work2);
				var v3 = j3d_vector_add(v1, v2, work1);
				var v4 = j3d_vector_normalize(v3, work1);
				
				var spec = j3d_vector_dot(v4, dir_internal);
				
				if (spec > 0)
				{
					spec = Math.pow(spec, material.phong);
					
					r += material.specular[0] * spec;
					g += material.specular[1] * spec;
					b += material.specular[2] * spec;
				}
			}
			
			// Generate HTML color
			return j3d_util_rgbcolor(r * 256, g * 256, b * 256);
		}
	};

	this.light_model = function(model, matrix)   
	{
		this.transform(matrix);

		var length = model.faces.j3d_length;
		
		if (length == null)
			length = model.faces.length;
		
		for (var i = 0; i < length; i++) {
			var face = model.faces[i];
			
			face.color = this.light_face(model.normals[face.normal], model.centers[face.center], face.material);
		}
		
		return model;
	};
}
