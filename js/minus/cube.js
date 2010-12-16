/*
 * cube.js
 * ----------
 *
 * Minus Cube
 * Copyright (c) 2008 Laurent Couvidou
 * Contact : lorancou@free.fr
 *
 * This program is free software - see README for details.
 */

function minus_cube()
{
    // .. params

    var SCRAMBLE_LEVEL= 3;

    // .. public

    this.padding = 1.0;
    this.rotdx = 2.0 * Math.random() * PI - PI;
    this.rotdy = 2.0 * Math.random() * PI - PI;

    this.frame = function( time_step )
    {
        __update_rotation( time_step );

        for ( var e = 0; e < __element.length; e++ )
        {
            __element[e].frame( time_step );
        }
    }

    this.draw = function()
    {
        for ( var e = 0; e < __element.length; e++ )
        {
            if ( e != 0 ) //|| parseInt( main_time / 200 ) % 2 == 0 )
                __element[e].draw( j3d_matrix_multiply( __rotxy, __rotdxy ), e, __slot_pos[ __element[e].slot ] );
        }
    }

    this.store_rotation = function()
    {
        this.rotdx = 0.0;
        this.rotdy = 0.0;

        var new_rotxy = j3d_matrix_multiply( __rotxy, __rotdxy );
        __rotxy = new_rotxy;
        __rotdxy = j3d_matrix_identity();
    }

    this.interact = function( screen_x, screen_y )
    {
        var ray_screen_org = [ screen_x, screen_y, 0.0, 1.0 ];
        var ray_screen_dir = [ 0.0, 0.0, 1.0, 1.0 ];

        var ray_world_org = j3d_matrix_multiply( [ray_screen_org], minus.camera.inv_projection() )[0];
        var ray_world_dir = j3d_matrix_multiply( [ray_screen_dir], minus.camera.inv_projection() )[0];

        var ray_proj_org = j3d_matrix_dehomogenize( j3d_matrix_multiply( [ray_world_org], minus.debugcam.projection() ) )[0];
        var ray_proj_dir = j3d_matrix_dehomogenize( j3d_matrix_multiply( [ray_world_dir], minus.debugcam.projection() ) )[0];

        var ray_rot_org = j3d_matrix_dehomogenize( j3d_matrix_multiply( [ray_world_org], __rotxy ) )[0];
        var ray_rot_dir = j3d_matrix_dehomogenize( j3d_matrix_multiply( [ray_world_dir], __rotxy ) )[0];

        for ( var e = 1; e < __element.length; e++ )
        {
            if ( j3d_intersect_ray_aabb(
                ray_world_org, ray_world_dir,
                [ 0.0, 0.0, 0.0 ],
                [ 2*__element[e].position[0], 2*__element[e].position[1], 2*__element[e].position[2] ] ) )
            {
                log( "element " + e + " interesects!" );
            }
        }
    }

    this.interact = function( e )
    {
        var element = __element[e];
        var slot = element.slot;
        log( "element " + e + " on slot "+ slot );

        for ( var i = 0; i<3; ++i )
        {
            var other_slot = __neighbor[slot][i];
            var other_e = __slot[other_slot];
            var other_element = __element[other_e];

            log( "candidate element " + other_e + " on neighbor " + other_slot );

            if ( other_e == 0 )
            {
                __switch_elements( element, other_element );
                break;
            }
        }
    }

    this.scramble = function()
    {
        this.solve();
        for ( var i = 0; i<SCRAMBLE_LEVEL; ++i )
        {
            var rand = Math.floor( Math.random() * 3 );
            __switch_elements(
                __element[0],
                __element[__neighbor[__element[0].slot][rand]]
            );
            minus.update_needed = true;
        }
    }

    this.solve = function()
    {
        __slot[0] = 0;
        __slot[1] = 1;
        __slot[2] = 2;
        __slot[3] = 3;
        __slot[4] = 4;
        __slot[5] = 5;
        __slot[6] = 6;
        __slot[7] = 7;
        __element[0].slot = 0;
        __element[1].slot = 1;
        __element[2].slot = 2;
        __element[3].slot = 3;
        __element[4].slot = 4;
        __element[5].slot = 5;
        __element[6].slot = 6;
        __element[7].slot = 7;
        minus.update_needed = true;
    }

    // .. private

    var __this = this;
    var __element;
    var __slot;
    var __slot_pos;
    var __neighbor;
    var __rotxy;
    var __rotdxy;

    function __construct()
    {
        __element = new Array(8);

        __element[0] = new minus_element( 0, 0 );
        __element[1] = new minus_element( 0, 1 );
        __element[2] = new minus_element( 1, 2 );
        __element[3] = new minus_element( 1, 3 );
        __element[4] = new minus_element( 2, 4 );
        __element[5] = new minus_element( 3, 5 );
        __element[6] = new minus_element( 2, 6 );
        __element[7] = new minus_element( 3, 7 );

        var p = __this.padding;

        __slot = new Array(8);
        __slot[0] = 0;
        __slot[1] = 1;
        __slot[2] = 2;
        __slot[3] = 3;
        __slot[4] = 4;
        __slot[5] = 5;
        __slot[6] = 6;
        __slot[7] = 7;

        __slot_pos = new Array(8);
        __slot_pos[0] = [ -p, -p, -p ];
        __slot_pos[1] = [ -p, -p,  p ];
        __slot_pos[2] = [ -p,  p, -p ];
        __slot_pos[3] = [ -p,  p,  p ];
        __slot_pos[4] = [  p, -p, -p ];
        __slot_pos[5] = [  p, -p,  p ];
        __slot_pos[6] = [  p,  p, -p ];
        __slot_pos[7] = [  p,  p,  p ];

        __neighbor = new Array(8);
        __neighbor[0] = [ 1, 2, 4 ];
        __neighbor[1] = [ 0, 3, 5 ];
        __neighbor[2] = [ 0, 3, 6 ];
        __neighbor[3] = [ 1, 2, 7 ];
        __neighbor[4] = [ 0, 5, 6 ];
        __neighbor[5] = [ 1, 4, 7 ];
        __neighbor[6] = [ 2, 4, 7 ];
        __neighbor[7] = [ 3, 5, 6 ];

        __rotxy = j3d_matrix_identity();
        __rotdxy = j3d_matrix_identity();
    }

    function __update_rotation( time_step )
    {
        __rotdxy = j3d_matrix_multiply(
            j3d_matrix_rotate_x( __this.rotdx ),
            j3d_matrix_rotate_y( __this.rotdy )
        );
    }

    function __switch_elements( e1, e2 )
    {
        __slot[e1.slot] = e2.id;
        __slot[e2.slot] = e1.id;
  
        var temp = e2.slot;
        e2.slot = e1.slot;
        e1.slot = temp;
        
        log( "switch!" );
    }

    __construct();
}