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

function j3d_matrix_transpose(a, d)
{
   if (d == null)
      return [[a[0][0], a[1][0], a[2][0], a[3][0]],
              [a[0][1], a[1][1], a[2][1], a[3][1]],
              [a[0][2], a[1][2], a[2][2], a[3][2]],
              [a[0][3], a[1][3], a[2][3], a[3][3]]];
   else {
      for (var i = 0; i < 4; i++)
         for (var j = 0; j <= i; j++) {
            var t1 = a[i][j];
            var t2 = a[j][i];
            
            d[i][j] = t2;
            d[j][i] = t1;
         }
         
      return d;
   }
}

function j3d_matrix_invert_simple(a, d)
{
   var m1 = [[a[0][0], a[1][0], a[2][0], 0.0],
             [a[0][1], a[1][1], a[2][1], 0.0],
             [a[0][2], a[1][2], a[2][2], 0.0],
             [    0.0,     0.0,     0.0, 1.0]];

   var m2 = [[     1.0,      0.0,      0.0, 0.0],
             [     0.0,      1.0,      0.0, 0.0],
             [     0.0,      0.0,      1.0, 0.0],
             [-a[3][0], -a[3][1], -a[3][2], 1.0]];

   return j3d_matrix_multiply(m2, m1, d);
}

function j3d_matrix_rotate_x(a, d)
{
   var s = Math.sin(a);
   var c = Math.cos(a);
//    var s = j3d_sin(a);
//    var c = j3d_cos(a);
   
   if (d == null)
      return [[ 1,  0,  0,  0],
              [ 0,  c,  s,  0],
              [ 0, -s,  c,  0],
              [ 0,  0,  0,  1]];
   else {
      var d0 = d[0];
      var d1 = d[1];
      var d2 = d[2];
      var d3 = d[3];
      
      d0[0] = 1;
      d0[1] = 0;
      d0[2] = 0;
      d0[3] = 0;

      d1[0] = 0;
      d1[1] = c;
      d1[2] = s;
      d1[3] = 0;

      d2[0] = 0;
      d2[1] = -s;
      d2[2] = c;
      d2[3] = 0;

      d3[0] = 0;
      d3[1] = 0;
      d3[2] = 0;
      d3[3] = 1;

      return d;      
   }
}

function j3d_matrix_rotate_y(a, d)
{
   var s = Math.sin(a);
   var c = Math.cos(a);

   if (d == null)   
      return [[ c,  0, -s,  0],
              [ 0,  1,  0,  0],
              [ s,  0,  c,  0],
              [ 0,  0,  0,  1]];
   else {
      var d0 = d[0];
      var d1 = d[1];
      var d2 = d[2];
      var d3 = d[3];
      
      d0[0] = c;
      d0[1] = 0;
      d0[2] = -s;
      d0[3] = 0;

      d1[0] = 0;
      d1[1] = 1;
      d1[2] = 0;
      d1[3] = 0;

      d2[0] = s;
      d2[1] = 0;
      d2[2] = c;
      d2[3] = 0;

      d3[0] = 0;
      d3[1] = 0;
      d3[2] = 0;
      d3[3] = 1;

      return d;      
   }
}
              
function j3d_matrix_rotate_z(a, d)
{
   var s = Math.sin(a);
   var c = Math.cos(a);

   if (d == null)   
      return [[ c,  s,  0,  0],
              [-s,  c,  0,  0],
              [ 0,  0,  1,  0],
              [ 0,  0,  0,  1]];
   else {
      var d0 = d[0];
      var d1 = d[1];
      var d2 = d[2];
      var d3 = d[3];
      
      d0[0] = c;
      d0[1] = s;
      d0[2] = 0;
      d0[3] = 0;

      d1[0] = -s;
      d1[1] = c;
      d1[2] = 0;
      d1[3] = 0;

      d2[0] = 0;
      d2[1] = 0;
      d2[2] = 1;
      d2[3] = 0;

      d3[0] = 0;
      d3[1] = 0;
      d3[2] = 0;
      d3[3] = 1;

      return d;      
   }
}

function j3d_matrix_rotate_axis(a, u, d)
{
    var s = Math.sin(angle);
    var c = j3d_cos(angle);

    var ux = u[0];
    var uy = u[1];
    var uz = u[2];
 
    if (d == null)
        return [[ ux*ux+c*(1-ux*ux), ux*uy*(1-c)-uz*s,  ux*uz*(1-c)+uy*s,  0.0 ],
                [ ux*uy*(1-c)+uz*s,  uy*uy+c*(1-uy*uy), uy*uz*(1-c)-ux*s,  0.0 ],
                [ ux*uz*(1-c)-uy*s,  uy*uz*(1-c)+ux*s,  uz*uz+c*(1-uz*uz), 0.0 ]
                [ 0.0,               0.0,               0.0,               1.0 ]];
    else {
      var d0 = d[0];
      var d1 = d[1];
      var d2 = d[2];
      var d3 = d[3];
      
      d0[0] = ux*ux+c*(1-ux*ux);
      d1[0] = ux*uy*(1-c)+uz*s;
      d2[0] = ux*uz*(1-c)-uy*s;
      d3[0] = 0.0;

      d0[1] = ux*uy*(1-c)-uz*s;
      d1[1] = uy*uy+c*(1-uy*uy);
      d2[1] = uy*uz*(1-c)+ux*s;
      d3[1] = 0.0;

      d0[2] = ux*uz*(1-c)+uy*s;
      d1[2] = uy*uz*(1-c)-ux*s;
      d2[2] = uz*uz+c*(1-uz*uz);
      d3[2] = 0.0;

      d0[3] = 0.0;
      d1[3] = 0.0;
      d2[3] = 0.0;
      d3[3] = 0.0;

      return d;      
    }
}
              
function j3d_matrix_translate(x, y, z, d)
{
   if (d == null)
      return [[ 1,  0,  0,  0],
              [ 0,  1,  0,  0],
              [ 0,  0,  1,  0],
              [ x,  y,  z,  1]];
   else {
      var d0 = d[0];
      var d1 = d[1];
      var d2 = d[2];
      var d3 = d[3];
      
      d0[0] = 1;
      d0[1] = 0;
      d0[2] = 0;
      d0[3] = 0;

      d1[0] = 0;
      d1[1] = 1;
      d1[2] = 0;
      d1[3] = 0;

      d2[0] = 0;
      d2[1] = 0;
      d2[2] = 1;
      d2[3] = 0;

      d3[0] = x;
      d3[1] = y;
      d3[2] = z;
      d3[3] = 1;

      return d;      
   }
}

function j3d_matrix_scale(x, y, z, d)
{
   if (d == null)
      return [[ x,  0,  0,  0],
              [ 0,  y,  0,  0],
              [ 0,  0,  z,  0],
              [ 0,  0,  0,  1]];
   else {
      var d0 = d[0];
      var d1 = d[1];
      var d2 = d[2];
      var d3 = d[3];
      
      d0[0] = x;
      d0[1] = 0;
      d0[2] = 0;
      d0[3] = 0;

      d1[0] = 0;
      d1[1] = y;
      d1[2] = 0;
      d1[3] = 0;

      d2[0] = 0;
      d2[1] = 0;
      d2[2] = z;
      d2[3] = 0;

      d3[0] = 0;
      d3[1] = 0;
      d3[2] = 0;
      d3[3] = 1;

      return d;      
   }
}

function j3d_matrix_project(w, h, n, f, d)
{
   var l = f - n;
   
   if (d == null)
      return [[ 2 * n / w,          0,          0,          0],
              [         0,  2 * n / h,          0,          0],
              [         0,          0,      f / l,          1],
              [         0,          0, -f * n / l,          0]];
   else {
      var d0 = d[0];
      var d1 = d[1];
      var d2 = d[2];
      var d3 = d[3];
      
      d0[0] = 2 * n / w;
      d0[1] = 0;
      d0[2] = 0;
      d0[3] = 0;

      d1[0] = 0;
      d1[1] = 2 * n / h;
      d1[2] = 0;
      d1[3] = 0;

      d2[0] = 0;
      d2[1] = 0;
      d2[2] = f / l;
      d2[3] = 1;

      d3[0] = 0;
      d3[1] = 0;
      d3[2] = -f * n / l;
      d3[3] = 0;

      return d;      
   }
}

function j3d_matrix_null(d)
{
   if (d == null)
      return [[0, 0, 0, 0], 
              [0, 0, 0, 0], 
              [0, 0, 0, 0], 
              [0, 0, 0, 0]];
   else {
      var d0 = d[0];
      var d1 = d[1];
      var d2 = d[2];
      var d3 = d[3];
      
      d0[0] = 0;
      d0[1] = 0;
      d0[2] = 0;
      d0[3] = 0;

      d1[0] = 0;
      d1[1] = 0;
      d1[2] = 0;
      d1[3] = 0;

      d2[0] = 0;
      d2[1] = 0;
      d2[2] = 0;
      d2[3] = 0;

      d3[0] = 0;
      d3[1] = 0;
      d3[2] = 0;
      d3[3] = 0;

      return d;      
   }
}

function j3d_matrix_identity(d)
{
   if (d == null)
      return [[1, 0, 0, 0], 
              [0, 1, 0, 0], 
              [0, 0, 1, 0], 
              [0, 0, 0, 1]];
   else {
      var d0 = d[0];
      var d1 = d[1];
      var d2 = d[2];
      var d3 = d[3];
      
      d0[0] = 1;
      d0[1] = 0;
      d0[2] = 0;
      d0[3] = 0;

      d1[0] = 0;
      d1[1] = 1;
      d1[2] = 0;
      d1[3] = 0;

      d2[0] = 0;
      d2[1] = 0;
      d2[2] = 1;
      d2[3] = 0;

      d3[0] = 0;
      d3[1] = 0;
      d3[2] = 0;
      d3[3] = 1;

      return d;      
   }
}

function j3d_matrix_multiply(a, b, d)
{
   var length = a.j3d_length;
   
   if (length == null)
      length = a.length;
   
   if (d == null)
      d = j3d_util_make2darray(length, 4);

   var b0 = b[0];
   var b1 = b[1];
   var b2 = b[2];
   var b3 = b[3];
   
   var b00 = b0[0];
   var b01 = b0[1];
   var b02 = b0[2];
   var b03 = b0[3];
   var b10 = b1[0];
   var b11 = b1[1];
   var b12 = b1[2];
   var b13 = b1[3];
   var b20 = b2[0];
   var b21 = b2[1];
   var b22 = b2[2];
   var b23 = b2[3];
   var b30 = b3[0];
   var b31 = b3[1];
   var b32 = b3[2];
   var b33 = b3[3];
         
   for (var i = 0; i < length; i++) {
      var ai = a[i];
      var di = d[i];
            
      var ai0 = ai[0];
      var ai1 = ai[1];
      var ai2 = ai[2];
      var ai3 = ai[3];
      
      di[0] = ai0 * b00 + ai1 * b10 + ai2 * b20 + ai3 * b30;
      di[1] = ai0 * b01 + ai1 * b11 + ai2 * b21 + ai3 * b31;
      di[2] = ai0 * b02 + ai1 * b12 + ai2 * b22 + ai3 * b32;
      di[3] = ai0 * b03 + ai1 * b13 + ai2 * b23 + ai3 * b33;
   }

   d.j3d_length = length;
      
   return d;
}

function j3d_matrix_dehomogenize(a, d)
{
   var length = a.j3d_length;
   
   if (length == null)
      length = a.length;
   
   if (d == null)
      d = j3d_util_make2darray(length, 4);
   
   for (var i = 0; i < length; i++) {
      var ai = a[i];
      var di = d[i];
      
      var ai3 = ai[3];
      
      di[0] = ai[0] / ai3;
      di[1] = ai[1] / ai3;   
      di[2] = ai[2] / ai3;
      di[3] = 1.0;
   }
   
   d.j3d_length = length;
   
   return d;
}