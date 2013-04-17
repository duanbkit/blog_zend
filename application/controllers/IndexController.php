<?php

class IndexController extends Zend_Controller_Action
{

	protected $_redirector = null;
	
    public function init()
    {
        /* Initialize action controller here */
        $this->_redirector = $this->_helper->getHelper('Redirector');
    }

    public function indexAction()
    {
        $this->_redirector->gotoUrl('/article/index');
    }


}

