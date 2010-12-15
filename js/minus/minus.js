/*
 * minus.js
 * ----------
 *
 * Minus Cube
 * Copyright (c) 2008 Laurent Couvidou
 * Contact : lorancou@free.fr
 *
 * This program is free software - see README for details.
 */

function minus_minus()
{
    // .. public
    
    this.light = null;
    this.sort = null;
    this.camera = null;
    this.cube = null;
    
    this.init = function()
    {
        this.light = new j3d_light( j3d_vector_normalize( [0.33, 0.66, 1.0, 0.0] ) );
        this.sort = new j3d_sort( 64, 200, 2 );
        this.camera = new minus_camera();
        this.cube = new minus_cube();
        minus_input_init( main_canvas );
    }
    
    this.frame = function()
    {
        // Controls
        if ( minus_input_lmb_pressed )
        {
            this.camera.rotx += 0.002 * this.time_step;
            this.camera.roty += 0.001 * this.time_step;
        }
        else if ( minus_input_rmb_pressed )
        {
            minus_element.position[ 0 ] += 0.1;
        }
        
        // Camera
        this.camera.update();
        this.light.eye = this.camera.position();
        
        // Gameplay
        this.cube.update();
        
        // Draw
        main_ctx.fillStyle = "#eeeeee";
        this.sort.clear(main_ctx);
        this.sort.begin();
        this.cube.draw();
        this.sort.draw(main_ctx);
    }    
}