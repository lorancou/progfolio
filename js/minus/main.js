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

// .. public

var MAX_FPS = 30;
var MAX_INTERVAL = 1000 / MAX_FPS;

var main_canvas = null;
var main_ctx = null;

var main_time_step = 0.0;
var main_time = new Date().getTime();
var main_last_time = new Date().getTime();
var main_tick = 0;

var main_fps = [];

var minus = null;

function main_init()
{
    log( "initializing..." );
    
    main_canvas = document.getElementById('main');
//     if ( !main_canvas )
//     {
//         return;
//     }

    main_ctx = main_canvas.getContext('2d');
    
    minus = new minus_game();
    minus.init();
    minus.frame( 0.0 );

    setTimeout( 'main_frame()', 0.0 );
    
    log( "done." );
}

function main_frame()
{
    main_time = new Date().getTime();
    main_time_step = main_time - main_last_time;
    
    minus.frame( main_time_step );
    
    // Debug purpose
    main_stats();
    
    main_last_time = main_time;
    main_tick++;
    
    //setTimeout('main_frame()', MAX_INTERVAL);
    setTimeout( 'main_frame()', 0.0 );
}

function main_stats()
{
    var cur_fps = 1000.0 / main_time_step;
    
    main_fps.push( cur_fps );
    if ( main_fps.length > 30 )
    {
        main_fps.shift();
    }
    var avg_fps = 0.0;
    for ( var i = 0; i< main_fps.length; ++i )
    {
        avg_fps += main_fps[i];
    }
    avg_fps /= main_fps.length;
    
    cur_fps_string = cur_fps.toFixed(1);
    if ( cur_fps_string.length == 3 ) cur_fps_string = '&nbsp;' + cur_fps_string;
    var fps_span = document.getElementById("fps")
    if ( fps_span )
    {
        fps_span.innerHTML = cur_fps_string;
    }
    
    avg_fps_string = avg_fps.toFixed(1);
    if ( avg_fps_string.length == 3 ) avg_fps_string = '&nbsp;' + avg_fps_string;
    var avg_span = document.getElementById("avg")
    if ( avg_span )
    {
        avg_span.innerHTML = avg_fps_string;
    }
}
