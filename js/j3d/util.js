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

function j3d_util_make2darray(d1, d2)
{
   var res = new Array(d1);
   
   for (var i = 0; i < d1; i++)
      res[i] = new Array(d2);
      
   return res;
}

function j3d_util_makeobjectarray(d)
{
   var res = new Array(d);
   
   for (var i = 0; i < d; i++)
      res[i] = new Object();
      
   return res;
}

function j3d_util_rgbcolor(r, g, b)
{
   var r = Math.floor(r);
   var g = Math.floor(g);
   var b = Math.floor(b);
   
   if (r > 255)
      r = 255;
   if (g > 255)
      g = 255;
   if (b > 255)
      b = 255;

   return "rgb(" + r + ", " + g + ", " + b + ")";
}

function j3d_util_rgbacolor(r, g, b, a)
{
   var r = Math.floor(r);
   var g = Math.floor(g);
   var b = Math.floor(b);
   
   if (r > 255)
      r = 255;
   if (g > 255)
      g = 255;
   if (b > 255)
      b = 255;

   if (a < 0.0)
      a = 0.0;
   if (a > 1.0)
      a = 1.0;

   return "rgba(" + r + ", " + g + ", " + b + ", " + a + ")";
}