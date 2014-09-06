<?php


return array(

	//smarty_property variables set the smarty instance global public members dynamically
	//examples left_delimiter
	//BY RANK LIU
	'smarty_property' => array(

		'debugging'      => false,
		'caching'        => false,
		'force_compile'  => false,
		'cache_lifetime' => 120,
		'left_delimiter' => '{%',
		'right_delimiter'=> '%}',
		'compile_check'  => true

	),


	'template_path'  => \App::make('path').'/views',
	'cache_path'     => \App::make('path').'/storage/views/cache',
	'compile_path'   => \App::make('path').'/storage/views/compile',

	/*
	|--------------------------------------------------------------------------
	| The path to additional Smarty plugins
	|--------------------------------------------------------------------------
	|
	| This option specifies a path to additional Smarty plugins.
	|
	*/

	'plugins_paths'  => array(
			\App::make('path').'/libraries/smarty/plugins',
		),
);
