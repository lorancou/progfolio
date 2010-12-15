/*
 * mesh.js
 * ----------
 *
 * Minus Cube
 * Copyright (c) 2008 Laurent Couvidou
 * Contact : lorancou@free.fr
 *
 * This program is free software - see README for details.
 */

var material_red = {ambient: [0.5, 0.0, 0.0], diffuse: [0.5, 0.0, 0.0], specular: [1.0, 1.0, 1.0], phong: 4.0};
var material_white = {ambient: [0.5, 0.5, 0.5], diffuse: [0.5, 0.5, 0.5], specular: [1.0, 1.0, 1.0], phong: 4.0};

var minus_mesh = {
	vertices: [[
		[ 0.638294, -1.000000, 0.638294, 1.0 ],
		[ -0.638294, -1.000000, 0.638294, 1.0 ],
		[ -0.638294, -1.000000, -0.638294, 1.0 ],
		[ 0.638293, -1.000000, -0.638294, 1.0 ],
		[ 1.000000, 0.638294, 0.638294, 1.0 ],
		[ 1.000000, -0.638294, 0.638294, 1.0 ],
		[ 0.999999, -0.638294, -0.638294, 1.0 ],
		[ 1.000000, 0.638294, -0.638294, 1.0 ],
		[ -1.000000, 0.638294, -0.638294, 1.0 ],
		[ -1.000000, -0.638294, -0.638294, 1.0 ],
		[ -1.000000, -0.638294, 0.638294, 1.0 ],
		[ -1.000000, 0.638294, 0.638294, 1.0 ],
		[ 0.638294, -0.819147, 0.819147, 1.0 ],
		[ -0.819147, -0.638294, -0.819147, 1.0 ],
		[ 0.638293, -0.819147, -0.819147, 1.0 ],
		[ -0.638294, -0.819147, -0.819147, 1.0 ],
		[ 0.819147, 0.638294, -0.819147, 1.0 ],
		[ 0.819146, -0.638294, -0.819148, 1.0 ],
		[ 0.819147, 0.819147, 0.638294, 1.0 ],
		[ 0.819147, 0.819147, -0.638294, 1.0 ],
		[ 0.819147, -0.638294, 0.819147, 1.0 ],
		[ 0.819147, 0.638294, 0.819147, 1.0 ],
		[ -0.638293, 1.000000, -0.638294, 1.0 ],
		[ -0.638294, 1.000000, 0.638294, 1.0 ],
		[ 0.638294, 1.000000, 0.638294, 1.0 ],
		[ 0.638294, 1.000000, -0.638293, 1.0 ],
		[ -0.638294, -0.638294, -1.000000, 1.0 ],
		[ -0.638293, 0.638294, -1.000001, 1.0 ],
		[ 0.638295, 0.638294, -0.999999, 1.0 ],
		[ 0.638294, -0.638294, -1.000000, 1.0 ],
		[ 0.638294, -0.638294, 1.000000, 1.0 ],
		[ 0.638293, 0.638294, 1.000000, 1.0 ],
		[ -0.638294, 0.638294, 1.000000, 1.0 ],
		[ -0.638295, -0.638294, 1.000000, 1.0 ],
		[ -0.819147, 0.819147, 0.638294, 1.0 ],
		[ -0.819147, 0.819147, -0.638294, 1.0 ],
		[ -0.819148, -0.638294, 0.819147, 1.0 ],
		[ -0.819147, 0.638294, 0.819147, 1.0 ],
		[ -0.638294, -0.819147, 0.819147, 1.0 ],
		[ -0.819147, 0.638294, -0.819148, 1.0 ]
	]],
	faces: [
		{ indices: [ 0, 1, 2, 3 ], material: material_red },
		{ indices: [ 4, 5, 6, 7 ], material: material_red },
		{ indices: [ 8, 9, 10, 11 ], material: material_red },
		{ indices: [ 1, 10, 9, 2 ], material: material_red },
		{ indices: [ 0, 3, 6, 5 ], material: material_red },
		{ indices: [ 0, 12, 38, 1 ], material: material_red },
		{ indices: [ 10, 36, 37, 11 ], material: material_red },
		{ indices: [ 35, 8, 11, 34 ], material: material_red },
		{ indices: [ 34, 11, 37 ], material: material_red },
		{ indices: [ 13, 9, 8, 39 ], material: material_red },
		{ indices: [ 39, 8, 35 ], material: material_red },
		{ indices: [ 2, 15, 14, 3 ], material: material_red },
		{ indices: [ 6, 17, 16, 7 ], material: material_red },
		{ indices: [ 18, 4, 7, 19 ], material: material_red },
		{ indices: [ 19, 7, 16 ], material: material_red },
		{ indices: [ 4, 21, 20, 5 ], material: material_red },
		{ indices: [ 21, 4, 18 ], material: material_red },
		{ indices: [ 1, 38, 36, 10 ], material: material_red },
		{ indices: [ 0, 5, 20, 12 ], material: material_red },
		{ indices: [ 3, 14, 17, 6 ], material: material_red },
		{ indices: [ 9, 13, 15, 2 ], material: material_red },
		{ indices: [ 22, 23, 24, 25 ], material: material_white },
		{ indices: [ 26, 27, 28, 29 ], material: material_white },
		{ indices: [ 30, 31, 32, 33 ], material: material_white },
		{ indices: [ 23, 32, 31, 24 ], material: material_white },
		{ indices: [ 22, 25, 28, 27 ], material: material_white },
		{ indices: [ 22, 35, 34, 23 ], material: material_white },
		{ indices: [ 32, 37, 36, 33 ], material: material_white },
		{ indices: [ 12, 30, 33, 38 ], material: material_white },
		{ indices: [ 38, 33, 36 ], material: material_white },
		{ indices: [ 21, 31, 30, 20 ], material: material_white },
		{ indices: [ 20, 30, 12 ], material: material_white },
		{ indices: [ 24, 18, 19, 25 ], material: material_white },
		{ indices: [ 28, 16, 17, 29 ], material: material_white },
		{ indices: [ 15, 26, 29, 14 ], material: material_white },
		{ indices: [ 14, 29, 17 ], material: material_white },
		{ indices: [ 26, 13, 39, 27 ], material: material_white },
		{ indices: [ 13, 26, 15 ], material: material_white },
		{ indices: [ 23, 34, 37, 32 ], material: material_white },
		{ indices: [ 22, 27, 39, 35 ], material: material_white },
		{ indices: [ 25, 19, 16, 28 ], material: material_white },
		{ indices: [ 31, 21, 18, 24 ], material: material_white }
	]
};

j3d_model_make_normals( minus_mesh );
j3d_model_make_centers( minus_mesh );
