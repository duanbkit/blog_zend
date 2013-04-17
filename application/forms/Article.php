<?php
class Application_Form_Article extends Zend_Form
{
	public function init(){
	
		$this->setMethod('post');

		$decorators_input = array(
			'ViewHelper',
			'Errors',
			array('Description', array('tag' => 'p', 'class' => 'description')),
			array('HtmlTag', array('tag' => 'div','class' => 'input')),
			array('label', null),
			array(array('tr' => 'HtmlTag'), array('tag' => 'div', 'class' => 'clearfix'))
		);

		$decorators_submit = array(
			'ViewHelper',
			'Errors',
			array('Description', array('tag' => 'p', 'class' => 'description')),
			array(array('tr' => 'HtmlTag'), array('tag' => 'div', 'class' => 'actions'))
		);

		//titre
		$this->addElement('text','titre',array(
			'decorators' => $decorators_input,
			'label' => 'Titre',
			'required' => true,
			'validators' => array(array('validator' => 'StringLength','options' => array(5,30)))
		));

		//texte
		$this->addElement('textarea','texte',array(
			'decorators' => $decorators_input,
			'label' => 'Texte',
			'required' => true
		));

		//checkbox publié
		$this->addElement('checkbox','publie',array(
			'decorators' => $decorators_input,
			'label' => 'Publié'
		));

		$this->addElement('hidden','id_article');

		//bouton soumettre
		$this->addElement('submit','submit',array(
			'decorators' => $decorators_submit,
			'ignore' => true,
			'class' => 'btn large primary',
			'label' => 'Soumettre'
		));

		//Protection CSRF
		$this->addElement('hash','csrf',array(
			'ignore' => true
		));
	}
}
