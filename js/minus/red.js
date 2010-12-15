/*
 * red.js
 * ----------
 *
 * Minus Cube
 * Copyright (c) 2008 Laurent Couvidou
 * Contact : lorancou@free.fr
 *
 * This program is free software - see README for details.
 */

var material_red = {ambient: [0.5, 0.0, 0.0], diffuse: [0.5, 0.0, 0.0], specular: [1.0, 1.0, 1.0], phong: 4.0};

var minus_red_model = {
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
		[ -0.638294, -0.819147, 0.819147, 1.0 ],
		[ 0.638294, -0.819147, 0.819147, 1.0 ],
		[ -0.819147, 0.638294, 0.819147, 1.0 ],
		[ -0.819147, -0.638294, 0.819147, 1.0 ],
		[ -0.819147, 0.819147, -0.638294, 1.0 ],
		[ -0.819147, 0.819147, 0.638294, 1.0 ],
		[ -0.819147, 0.638294, -0.819147, 1.0 ],
		[ -0.819147, -0.638294, -0.819147, 1.0 ],
		[ 0.638293, -0.819147, -0.819147, 1.0 ],
		[ -0.638294, -0.819147, -0.819147, 1.0 ],
		[ 0.819147, 0.638294, -0.819147, 1.0 ],
		[ 0.819146, -0.638294, -0.819148, 1.0 ],
		[ 0.819147, 0.819147, 0.638294, 1.0 ],
		[ 0.819147, 0.819147, -0.638294, 1.0 ],
		[ 0.819147, -0.638294, 0.819147, 1.0 ],
		[ 0.819147, 0.638294, 0.819147, 1.0 ]
	]],
	faces: [
		{ indices: [ 0, 1, 2, 3 ], material: material_red },
		{ indices: [ 4, 5, 6, 7 ], material: material_red },
		{ indices: [ 8, 9, 10, 11 ], material: material_red },
		{ indices: [ 1, 10, 9, 2 ], material: material_red },
		{ indices: [ 0, 3, 6, 5 ], material: material_red },
		{ indices: [ 0, 13, 12, 1 ], material: material_red },
		{ indices: [ 10, 15, 14, 11 ], material: material_red },
		{ indices: [ 16, 8, 11, 17 ], material: material_red },
		{ indices: [ 17, 11, 14 ], material: material_red },
		{ indices: [ 19, 9, 8, 18 ], material: material_red },
		{ indices: [ 18, 8, 16 ], material: material_red },
		{ indices: [ 2, 21, 20, 3 ], material: material_red },
		{ indices: [ 6, 23, 22, 7 ], material: material_red },
		{ indices: [ 24, 4, 7, 25 ], material: material_red },
		{ indices: [ 25, 7, 22 ], material: material_red },
		{ indices: [ 4, 27, 26, 5 ], material: material_red },
		{ indices: [ 27, 4, 24 ], material: material_red },
		{ indices: [ 1, 12, 15, 10 ], material: material_red },
		{ indices: [ 0, 5, 26, 13 ], material: material_red },
		{ indices: [ 3, 20, 23, 6 ], material: material_red },
		{ indices: [ 9, 19, 21, 2 ], material: material_red }
    ]
};

j3d_model_make_normals( minus_red_model );
j3d_model_make_centers( minus_red_model );
