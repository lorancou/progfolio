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

function j3d_intersect_ray_aabb( ray_org, ray_dir, aabb_min, aabb_max )
{
    var tmin, tmax, tymin, tymax, tzmin, tzmax;

    if (ray_dir[0] >= 0)
    {
        tmin = (aabb_min[0] - ray_org[0]) / ray_dir[0];
        tmax = (aabb_max[0] - ray_org[0]) / ray_dir[0];
    }
    else
    {
        tmin = (aabb_max[0] - ray_org[0]) / ray_dir[0];
        tmax = (aabb_min[0] - ray_org[0]) / ray_dir[0];
    }
    if (ray_dir[1] >= 0)
    {
        tymin = (aabb_min[1] - ray_org[1]) / ray_dir[1];
        tymax = (aabb_max[1] - ray_org[1]) / ray_dir[1];
    }
    else
    {
        tymin = (aabb_max[1] - ray_org[1]) / ray_dir[1];
        tymax = (aabb_min[1] - ray_org[1]) / ray_dir[1];
    }
    if ( (tmin > tymax) || (tymin > tmax) )
    {
        return false;
    }

    if (tymin > tmin)
    {
        tmin = tymin;
    }
    if (tymax < tmax)
    {
        tmax = tymax;
    }
    if (ray_dir[2] >= 0)
    {
        tzmin = (aabb_min[2] - ray_org[2]) / ray_dir[2];
        tzmax = (aabb_max[2] - ray_org[2]) / ray_dir[2];
    }
    else
    {
        tzmin = (aabb_max[2] - ray_org[2]) / ray_dir[2];
        tzmax = (aabb_min[2] - ray_org[2]) / ray_dir[2];
    }
    if ( (tmin > tzmax) || (tzmin > tmax) )
    {
        return false;
    }

    if (tzmin > tmin)
    {
        tmin = tzmin;
    }
    if (tzmax < tmax)
    {
        tmax = tzmax;
    }
    return ( (tmin < t1) && (tmax > t0) );
}