/*
 * main.js
 * ----------
 *
 * Minus Cube
 * Copyright (c) 2008 Laurent Couvidou
 * Contact : lorancou@free.fr
 *
 * This program is free software - see README for details.
 */

var main_canvas = null;
var main_ctx = null;

var main_time_step = 0;
var main_time = 0;



var max_fps = 30;
var max_interval = 1000 / max_fps;

var minus_light = null;
var minus_sort = null;
var minus_camera = null;
var minus_cube = null;

var minusrx = 0;
var minusry = 0;


function init()
{
    log( "Initializing..." );
    
    minus_light = new j3d_light(
        j3d_vector_normalize( [0.33, 0.66, 1.0, 0.0] )
    );
        
    minus_sort = new j3d_sort( 64, 200, 2 );
    
    minus_camera = new minus_camera();

    minus_cube = new minus_cube();
        
    main_canvas = document.getElementById('main');
    main_ctx = main_canvas.getContext('2d');
    main_ctx.fillStyle = "#eeeeee";    
    
    minus_input_init( main_canvas );
    
    setTimeout('frame()', max_interval);
    
    log( "Done." );
}

function frame()
{
    // Draw
    minus_sort.clear(main_ctx);
    minus_sort.begin();
    minus_cube.draw();
    minus_sort.draw(main_ctx);

    main_time = new Date().getTime();
    
    avgtime = avgtime * 0.95 + (main_time - last_time) * 0.05;
    
    // Controls    
    if ( minus_input_lmb_pressed )
    {
        minus_camera.rotx += 0.002 * main_time_step;
        minus_camera.roty += 0.001 * main_time_step;
    }
    else if ( minus_input_rmb_pressed )
    {
        minus_element.position[ 0 ] += 0.1;
    }

    // Camera
    minus_camera.update();
    minus_light.eye = minus_camera.position();

    // Gameplay
    minus_cube.update();

    
    // Debugging purpose
    stats();
    
    setTimeout('frame()', max_interval);
}

