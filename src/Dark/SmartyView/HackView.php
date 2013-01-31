<?php
  
namespace Dark\SmartyView;

use \Illuminate\View;

class HackView extends View\View
{
	
	public function __construct($view, array $data = array())
	{
		$this->view = $view;
		$this->data = $data;
	}
	
}