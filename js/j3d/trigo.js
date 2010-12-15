/*
   Ajax3d - a 3d engine using the WHATWG HTML <canvas> tag.
   
   Copyright (C) 2007-2008 Eben Upton, Laurent Couvidou
   
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

var PI_2 = 1.57079632679489661923;
var PI = 3.14159265358979323846;
var PIx3_2 = 4.71238898038468985769;
var PIx2 = 6.28318530717958647692;

var j3d_sin_table = [
    0.000000, 0.017452, 0.034899, 0.052336, 0.069756, 0.087156,
    0.104528, 0.121869, 0.139173, 0.156434, 0.173648, 0.190809,
    0.207912, 0.224951, 0.241922, 0.258819, 0.275637, 0.292372,
    0.309017, 0.325568, 0.342020, 0.358368, 0.374607, 0.390731,
    0.406737, 0.422618, 0.438371, 0.453991, 0.469472, 0.484810,
    0.500000, 0.515038, 0.529919, 0.544639, 0.559193, 0.573576,
    0.587785, 0.601815, 0.615661, 0.629320, 0.642788, 0.656059,
    0.669131, 0.681998, 0.694658, 0.707107, 0.719340, 0.731354,
    0.743145, 0.754710, 0.766044, 0.777146, 0.788011, 0.798636,
    0.809017, 0.819152, 0.829038, 0.838671, 0.848048, 0.857167,
    0.866025, 0.874620, 0.882948, 0.891007, 0.898794, 0.906308,
    0.913545, 0.920505, 0.927184, 0.933580, 0.939693, 0.945519,
    0.951057, 0.956305, 0.961262, 0.965926, 0.970296, 0.974370,
    0.978148, 0.981627, 0.984808, 0.987688, 0.990268, 0.992546,
    0.994522, 0.996195, 0.997564, 0.998630, 0.999391, 0.999848
];

function j3d_cos(a)
{
    return j3d_sin(a + PI_2);
}

function j3d_sin(a)
{
    var ma = a;
    while ( ma > PIx2 )
    {
        ma -= PIx2;
    }

    var index = 0;
    var sign;

    if (ma < PI_2)
    {
        index = parseInt(ma * 90 / PIx2);
        sign = 1.0;
    }
    else if (ma < PI)
    {
        index = 90 - parseInt((ma - PI_2) * 90 / PIx2);
        sign = 1.0;
    }
    else if (ma < PIx3_2)
    {
        index = 90 - parseInt((ma - PI) * 90 / PIx2);
        sign = -1.0;
    }
    else
    {
        index = parseInt((ma - PIx3_2) * 90 / PIx2);
        sign = -1.0;
    }

    log( "ma = " + ma );
    log( "index = " + index );
    log( "sign = " + sign );

    return sign * j3d_sin_table[index];
}
