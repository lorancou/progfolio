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

function j3d_vector_copy(a)
{
   return [a[0], a[1], a[2], a[3]];
}

function j3d_vector_dot(a, b)
{
   return a[0] * b[0] + a[1] * b[1] + a[2] * b[2] + a[3] * b[3];
}

function j3d_vector_magnitude(a)
{
   var a0 = a[0];
   var a1 = a[1];
   var a2 = a[2];
   var a3 = a[3];
   
   return Math.sqrt(a0 * a0 + a1 * a1 + a2 * a2 + a3 * a3);
}

function j3d_vector_add(a, b, d)
{  
   if (d == null)
      return [a[0] + b[0], 
              a[1] + b[1], 
              a[2] + b[2], 
              a[3] + b[3]];
   else {
      d[0] = a[0] + b[0];   
      d[1] = a[1] + b[1];   
      d[2] = a[2] + b[2];   
      d[3] = a[3] + b[3];   
      
      return d;
   }
}

function j3d_vector_subtract(a, b, d)
{  
   if (d == null)
      return [a[0] - b[0], 
              a[1] - b[1], 
              a[2] - b[2], 
              a[3] - b[3]];
   else {
      d[0] = a[0] - b[0];   
      d[1] = a[1] - b[1];   
      d[2] = a[2] - b[2];   
      d[3] = a[3] - b[3];   
      
      return d;
   }
}

function j3d_vector_multiply(a, b, d)
{  
   if (d == null)
      return [a[0] * b, 
              a[1] * b, 
              a[2] * b, 
              a[3] * b];
   else {
      d[0] = a[0] * b;   
      d[1] = a[1] * b;   
      d[2] = a[2] * b;   
      d[3] = a[3] * b;   
      
      return d;
   }
}

function j3d_vector_blend(a, b, f, d)
{  
   var e = 1 - f;
   
   if (d == null)
      return [e * a[0] + f * b[0], 
              e * a[1] + f * b[1], 
              e * a[2] + f * b[2], 
              e * a[3] + f * b[3]];
   else {
      d[0] = e * a[0] + f * b[0];
      d[1] = e * a[1] + f * b[1];
      d[2] = e * a[2] + f * b[2];
      d[3] = e * a[3] + f * b[3];
      
      return d;
   }
}

function j3d_vector_cross(a, b, d)
{
   if (d == null)
      return [a[1] * b [2] - a[2] * b[1], 
              a[2] * b [0] - a[0] * b[2], 
              a[0] * b [1] - a[1] * b[0], 
              0.0];
   else {
      d[0] = a[1] * b [2] - a[2] * b[1];
      d[1] = a[2] * b [0] - a[0] * b[2];
      d[2] = a[0] * b [1] - a[1] * b[0];
      d[3] = 0.0;
      
      return d;
   }
}

function j3d_vector_normalize(a, d)
{
   var a0 = a[0];
   var a1 = a[1];
   var a2 = a[2];
   var a3 = a[3];
   
   var len = Math.sqrt(a0 * a0 + a1 * a1 + a2 * a2 + a3 * a3);
   
   if (d == null)
      return [a0 / len, 
              a1 / len, 
              a2 / len, 
              a3 / len];
   else {
      d[0] = a0 / len;   
      d[1] = a1 / len;   
      d[2] = a2 / len;   
      d[3] = a3 / len;   
      
      return d;
   }
}