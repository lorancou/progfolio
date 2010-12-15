/*
 * element.js
 * ----------
 *
 * Minus Cube
 * Copyright (c) 2008 Laurent Couvidou
 * Contact : lorancou@free.fr
 *
 * This program is free software - see README for details.
 */

function minus_camera()
{
    // .. public

    this.rotx = 0.0;
    this.roty = 0.0;
    this.dist = 8.0;

    this.frame = function( time_step )
    {
        __compute_matrices();
    }

    this.position = function()
    {
        return __position;
    }

    this.projection = function()
    {
        return __projection;
    }

    this.inv_projection = function()
    {
        return __inv_projection;
    }

    // .. private

    var __this = this;
    var __position =j3d_matrix_identity();
    var __projection =j3d_matrix_identity();
    var __inv_projection =j3d_matrix_identity();

    var __compute_matrices = function()
    {
        // Camera position
        var t1 = j3d_matrix_translate( 0.0, 0.0, __this.dist );
        
        // Debug rotations
        var rx = j3d_matrix_rotate_x( __this.rotx );
        var ry = j3d_matrix_rotate_y( __this.roty );
        
        // Perspective projection
        var p  = j3d_matrix_project( 10, 10, 5, 25 );
        
        // Screen-space centering, depends on ratio
        var tf = j3d_matrix_translate( 0.5, 0.5 * main_canvas.height / main_canvas.width, 0 );
        
        // Screen-space scaling to canvas pixel width
        var s1 = j3d_matrix_scale( main_canvas.width, main_canvas.width, 1 );
        
        var m = j3d_matrix_multiply( ry, rx );
        var n = j3d_matrix_multiply( m, t1 );
        var p = j3d_matrix_multiply( n, p );
        var kl = j3d_matrix_multiply( p, tf );
        var kr = j3d_matrix_multiply( kl, s1 );

        __position = n;
        __projection = kr;
        __inv_projection = j3d_matrix_invert_simple(kr);
    }

}