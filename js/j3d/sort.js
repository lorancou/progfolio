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

function j3d_sort(buckets, cells, bounds)
{
    var cell_type_face     = 0;
    var cell_type_particle = 1;
    
    var bucket = new Array(buckets);
    
    var cell = j3d_util_makeobjectarray(cells);
    var bound = j3d_util_makeobjectarray(bounds);
    
    var pos;

    this.pick_group = false;
    this.picked_group = -1;
    
    this.clear = function(ctx)
    {
        for (var i = 0; i < bound.length; i++) {
            var b = bound[i];
            
            ctx.fillRect(b.xmin - 1, b.ymin - 1, b.xmax - b.xmin + 2, b.ymax - b.ymin + 2);
        }
    };
    
    this.begin = function()
    {
        for (var i = 0; i < bucket.length; i++)
        bucket[i] = null;
        
        for (var i = 0; i < bound.length; i++) {
            var b = bound[i];
            
            b.xmin = 2048;
            b.ymin = 2048;
            b.xmax = -2048;
            b.ymax = -2048;
        }
        
        pos = 0;
    };
    
    this.begin();
    
    function add_cell(z)
    {
        var b = Math.floor(z * bucket.length);
        
        if (b < 0)
        b = 0;
        if (b > bucket.length - 1)
        b = bucket.length - 1;
        
        if (pos == cell.length)
        cell.push(new Object());
        
        var c = cell[pos++];
        
        c.next = bucket[b];
        
        bucket[b] = c;
        
        return c;   
    }
    
    this.add_face = function(vertices, face, group, bias)
    {
        var vertices0 = vertices[0];
        var vertices1 = vertices[1];
        var thresh = vertices0.length;
        
        var zmin = 1.0;
        
        for (var i = 0; i < face.indices.length; i++) {
            var index = face.indices[i];
            var znew = index < thresh ? vertices0[index][2] : vertices1[index - thresh][2];
            
            if (znew < zmin)
            zmin = znew;
        }
        
        if (bias != null)
        zmin += bias;
        
        if (face.bias != null)
        zmin += face.bias;
        
        var c = add_cell(zmin);
        
        c.type = cell_type_face;
        c.vertices = vertices;
        c.face = face;
        c.color = face.color;
        c.group = group;
    };
    
    this.add_particle = function(vertex, color, size, group, bias)
    {
        var z = vertex[2];
        
        if (bias != null)
        z += bias;
        
        var c = add_cell(z);
        
        c.type = cell_type_particle;
        c.vertex = vertex;
        c.color = color;
        c.group = group;
        c.size = size;
    };
    
    this.add_model = function(model, group)
    {
        var vertices0 = model.vertices[0];
        var vertices1 = model.vertices[1];
        var thresh = vertices0.length;
        
        var length = model.faces.j3d_length;
        
        if (length == null)
        length = model.faces.length;
        
        for (var i = 0; i < length; i++) {
            var face = model.faces[i];
            
            if (face.cull != false) {  
                var i0 = face.indices[0];
                var i1 = face.indices[1];
                var i2 = face.indices[2];
                
                var v0 = i0 < thresh ? vertices0[i0] : vertices1[i0 - thresh];
                var v1 = i1 < thresh ? vertices0[i1] : vertices1[i1 - thresh];
                var v2 = i2 < thresh ? vertices0[i2] : vertices1[i2 - thresh];
                
                var wind = (v1[0] - v0[0]) * (v2[1] - v0[1]) - (v2[0] - v0[0]) * (v1[1] - v0[1]);
                
                 if (wind > 0.0)
                     continue;
            }
            
            this.add_face(model.vertices, face, group, model.bias);
        }
    };
    
    this.draw = function(ctx)
    {
        this.picked_group = -1;

        for (var i = bucket.length - 1; i >= 0; i--)
        for (var c = bucket[i]; c != null; c = c.next) {
            ctx.fillStyle = c.color;
//            ctx.strokeStyle = c.color;
//            ctx.lineWidth = 1.5;
//            ctx.lineCap = 'round';
//            ctx.lineJoin = 'bevel';
                        
            if (c.type == cell_type_face)
            {
                ctx.beginPath();
                
                var vertices0 = c.vertices[0];
                var vertices1 = c.vertices[1];
                var thresh = vertices0.length;

                var b = bound[c.group];
                b.xmin = 100000;
                b.xmax = -100000;
                b.ymin = 100000;
                b.ymax = -100000;
                
                for (var k = 0; k < c.face.indices.length; k++) {
                    var index = c.face.indices[k];
                    
                    var x, y;
                    
                    if (index < thresh) {
                        x = vertices0[index][0];
                        y = vertices0[index][1];
                    } else {
                        x = vertices1[index - thresh][0];
                        y = vertices1[index - thresh][1];
                    }
                    
                    if (this.log) {
                        log(k + ': ' + x + ", " + y + "<br>");
                    }

                    if (this.pick_group)
                    {
                        if (x < b.xmin)
                            b.xmin = x;
                        if (x > b.xmax)
                            b.xmax = x;
                        if (y < b.ymin)
                            b.ymin = y;
                        if (y > b.ymax)
                            b.ymax = y;
                    }
                    
                    if (k == 0)
                        ctx.moveTo(x, y);
                    else
                        ctx.lineTo(x, y);
                }

                if ( this.pick_group
                     && minus_input_pick_x > b.xmin
                     && minus_input_pick_x < b.xmax
                     && minus_input_pick_y > b.ymin
                     && minus_input_pick_y < b.ymax )
                {
                    this.picked_group = c.group;

//                     ctx.lineWidth = 3;
//                     ctx.strokeStyle = "green";
//                     ctx.stroke();
//                     ctx.strokeStyle = "";
                }
                
                ctx.fill();
            } else {
//                 var size = c.size;
                
//                 var x = c.vertex[0] - size / 2;
//                 var y = c.vertex[1] - size / 2;
                
//                 if (x < b.xmin)
//                 b.xmin = x;
//                 if (x + size - 1 > b.xmax)
//                 b.xmax = x + size - 1;
//                 if (y < b.ymin)
//                 b.ymin = y;
//                 if (y + size - 1 > b.ymax)
//                 b.ymax = y + size - 1;
                
//                 ctx.fillRect(Math.floor(x), Math.floor(y), size, size);
            }
        }
    };
}





