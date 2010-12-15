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

var minus_input_lmb_pressed;
var minus_input_rmb_pressed;
var minus_input_left_pressed;
var minus_input_up_pressed;
var minus_input_right_pressed;
var minus_input_down_pressed;

var minus_input_dx;
var minus_input_dy;

var minus_input_prev_x = 0;
var minus_input_prev_y = 0;

var minus_input_pick_x = 0;
var minus_input_pick_y = 0;

var minus_input_prev_valid;

var IE = document.all ? true : false;	
var minus_input_lmb;
var minus_input_rmb;

function minus_input_init()
{
    minus_input_lmb_pressed = false;
    minus_input_rmb_pressed = false;
    
    minus_input_dx = 0;
    minus_input_dy = 0;
    
    minus_input_prev_valid = false;
	
	if ( IE )
	{
		minus_input_lmb = 1;
		minus_input_rmb = 2;
    }
	else
	{
		minus_input_lmb = 1;
		minus_input_rmb = 3;
	}
    
    main_canvas.onmousedown = minus_input_mouse_down;
    main_canvas.onmouseup = minus_input_mouse_up;
    main_canvas.onmouseout = minus_input_mouse_out;
    main_canvas.onmousemove = minus_input_mouse_move;    

    document.onkeydown = minus_input_key_down;
    document.onkeyup = minus_input_key_up;

    main_canvas.oncontextmenu = function() { return false; };
}

function minus_input_mouse_down(e)
{
	var button = null;	
	if ( IE ) button = event.button;
	else button = e.which;
	if ( button == null ) return;
	
	log( "button=" + button );

    switch (button) {
        case minus_input_lmb:
        minus_input_lmb_pressed = true;
        //main_canvas.onmousemove = minus_input_mouse_move;
        break;
        case minus_input_rmb:
        minus_input_rmb_pressed = true;
		if (IE) {
			minus_input_pick_x = event.clientX;
			minus_input_pick_y = event.clientY;
		} else {
			minus_input_pick_x = e.layerX - main_canvas.offsetLeft;
			minus_input_pick_y = e.layerY - main_canvas.offsetTop;
		}
		//log ( "x=" + minus_input_pick_x );
		//log ( "y=" + minus_input_pick_y );
        break;
    }
}

function minus_input_mouse_up(e)
{
	var button = null;	
	if ( IE ) button = event.button;
	else button = e.which;
	if ( button == null ) return;

	if ( IE )
	{
		button = event.button;
	}
	else
	{
		button = e.which;
	}

    switch (button) {
        case minus_input_lmb:
        minus_input_lmb_pressed = false;
        //main_canvas.onmousemove = null;
        break;
        case minus_input_rmb:
        minus_input_rmb_pressed = false;
        break;
    }
}

function minus_input_mouse_out(e)
{
    minus_input_prev_valid = false;
    minus_input_lmb_pressed = false;
    //main_canvas.onmousemove = null;
    minus_input_left_pressed = false;
    minus_input_up_pressed = false;
    minus_input_right_pressed = false;
    minus_input_down_pressed = false;
}

function minus_input_mouse_move(e)
{
    var x;
    var y;
	
	if (IE) {
		x = event.clientX;
		y = event.clientY;
	} else {
		x = e.layerX - main_canvas.offsetLeft;
		y = e.layerY - main_canvas.offsetTop;
	}
    
    if (minus_input_prev_valid) {
        minus_input_dx += x - minus_input_prev_x;
        minus_input_dy += y - minus_input_prev_y;
    }
    
    minus_input_prev_x = x;
    minus_input_prev_y = y;
    minus_input_prev_valid = true;
}

function minus_input_key_down(e)
{
	var ev = null;
	if ( IE ) ev = event;
	else ev = e;
    if ( ev == null ) return;

    switch ( ev.keyCode )
    {
    case 37: case 81: case 65: minus_input_left_pressed = true; break;
    case 38: case 90: case 87: minus_input_up_pressed = true; break;
    case 39: case 68: minus_input_right_pressed = true; break;
    case 40: case 83: minus_input_down_pressed = true; break;
    }
}

function minus_input_key_up(e)
{
	var ev = null;
	if ( IE ) ev = event;
	else ev = e;
    if ( ev == null ) return;

    switch ( ev.keyCode )
    {
    case 37: case 81: case 65: minus_input_left_pressed = false; break;
    case 38: case 90: case 87: minus_input_up_pressed = false; break;
    case 39: case 68: minus_input_right_pressed = false; break;
    case 40: case 83: minus_input_down_pressed = false; break;
    }
}

function minus_input_scramble(e)
{
    minus.cube.scramble();
}

function minus_input_solve(e)
{
    minus.cube.solve();
}
