<?php namespace Dark\SmartyView;

use Illuminate\Support\ServiceProvider;

class SmartyViewServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('dark/smartyView');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{				
		$app = $this->app;
		
		$this->app['view']->addExtension('tpl', 'smarty', function() use ($app){
			return new SmartyEngine($app['config']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}