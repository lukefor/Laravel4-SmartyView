<?php
namespace Dark\SmartyView;

use Illuminate\View;
use Illuminate\View\Engines;
use Illuminate\View\Compilers\CompilerInterface;

class SmartyEngine implements Engines\EngineInterface {

	protected $config;

	public function __construct($config)
	{
		$this->config = $config;
	}

	/**
	 * Get the evaluated contents of the view.
	 *
	 * @param  string  $path
	 * @param  array   $data
	 * @return string
	 */
	public function get($path, array $data = array())
	{
		return $this->evaluatePath($path, $data);
	}


	private static function smartyNameToViewName($filename){
		$viewPos = strpos($filename, "views" . DS);
		if($viewPos !== false)
			$filename = substr($filename, strpos($filename, "views" . DS) + 6);
		return str_replace(DS, ".", str_replace(".tpl", "", $filename));
	}

	public static function integrateViewComposers($_template, $forceName = false){
		if(!is_a($_template, 'Smarty_Internal_Template'))
			return;

		$events = \App::make('events');

		if($forceName !== false && empty($_template->properties['file_dependency'])){
			$viewName = self::smartyNameToViewName($forceName);
			$view = new HackView($viewName);
			$events->fire('composing: '.$view->getName(), array($view));
			foreach($view->getData() as $key => $value){
				$_template->tpl_vars[$key] = new \Smarty_Variable($value);
			}
			unset($hackView);
		} else {
			foreach($_template->properties['file_dependency'] as $file){
				if($file[2] == 'file'){
					$viewName = self::smartyNameToViewName($file[0]);

					$view = new HackView($viewName);
					$events->fire('composing: '.$view->getName(), array($view));
					foreach($view->getData() as $key => $value){
						$_template->tpl_vars[$key] = new \Smarty_Variable($value);
					}
					unset($hackView);
				}
			}
		}
	}

	/**
	 * Get the evaluated contents of the view at the given path.
	 *
	 * @param  string  $path
	 * @param  array   $data
	 * @return string
	 */
	protected function evaluatePath($__path, $__data)
	{
		ob_start();

		try {
			require_once dirname(__FILE__) . '/Smarty/libs/Smarty.class.php';

			$configKey = 'smartyView::';

			$caching = $this->config[$configKey . 'caching'];
			$cache_lifetime = $this->config[$configKey . 'cache_lifetime'];
			$debugging = $this->config[$configKey . 'debugging'];

			$template_path = $this->config[$configKey . 'template_path'];
			$compile_path  = $this->config[$configKey . 'compile_path'];
			$cache_path    = $this->config[$configKey . 'cache_path'];

			// Get the plugins path from the configuration
			$plugins_paths = $this->config[$configKey . 'plugins_paths'];
			$Smarty = new \Smarty();

			$Smarty->setTemplateDir($template_path);
			$Smarty->setCompileDir($compile_path);
			$Smarty->setCacheDir($cache_path);

			// Add the plugin folder from the config to the Smarty object.
			// Note that I am using addPluginsDir here rather than setPluginsDir
			// because I want to add a secondary folder, not replace the
			// existing folder.
			foreach($plugins_paths as $path)
				$Smarty->addPluginsDir($path);

			$Smarty->debugging = $debugging;
			$Smarty->caching = $caching;
			$Smarty->cache_lifetime = $cache_lifetime;
			$Smarty->compile_check = true;

			//$Smarty->escape_html = true;
			$Smarty->error_reporting = E_ALL &~ E_NOTICE;

			foreach ($__data as $var => $val) {
				$Smarty->assign($var, $val);
			}

			print $Smarty->display($__path);

		} catch (\Exception $e) {
			$this->handleViewException($e);
		}

		return ob_get_clean();
	}

	/**
	 * Handle a view exception.
	 *
	 * @param  Exception  $e
	 * @return void
	 */
	protected function handleViewException($e)
	{
		ob_get_clean(); throw $e;
	}

	/**
	 * Get the compiler implementation.
	 *
	 * @return Illuminate\View\Compilers\CompilerInterface
	 */
	public function getCompiler()
	{
		return $this->compiler;
	}

}