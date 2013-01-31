<?php


return array(
	'debugging'      => false,
	'caching'        => false,
	'cache_lifetime' => 120,
	
	'template_path'  => \App::make('path').'/views',
	'cache_path'     => \App::make('path').'/views/cache',
	'compile_path'   => \App::make('path').'/views/compile',
);
