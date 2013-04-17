<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initRoutes()
	{
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/routes.ini',APPLICATION_ENV);
		$router = new Zend_Controller_Router_Rewrite();
		$router->addConfig($config, 'routes');
		Zend_Controller_Front::getInstance()->setRouter($router);
	}

}

