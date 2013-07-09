<?php


return array(
	'debugging'      => false,
	'caching'        => false,
	'cache_lifetime' => 120,

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
