<?php
class ArticleController extends Zend_Controller_Action{
	
	protected $_flashMessenger = null;
	protected $_redirector = null;
	protected $NB_ART_PAGE = 2;
	
	public function init(){
		
		$this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
		$this->_redirector = $this->_helper->getHelper('Redirector');
                $this->initView();
	}
	
	public function indexAction(){
					
		$modele = new Application_Model_Article();
		$index = ($this->_getParam('page') <= 1) ? 0 : ($this->_getParam('page')-1)*$this->NB_ART_PAGE;	
		$this->view->articles = $modele->countArticles($this->NB_ART_PAGE, $index);		
		
		
		if($this->_flashMessenger->hasMessages()){
			$this->view->message = $this->_flashMessenger->getMessages();
		}

		// Pagination
		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_Array($modele->tousArticles()->toArray()));
		$paginator->setItemCountPerPage($this->NB_ART_PAGE);
		$paginator->setCurrentPageNumber($this->_getParam('page', 1));
		$this->view->paginator = $paginator;
		
	}

	public function editerAction(){
		$form = new Application_Form_Article();
		$form->setAction($this->view->url);
		$this->view->form = $form;
		
		if($this->getRequest()->isPost()){	// requete POST => traitement a faire
			$po = $this->getRequest()->getPost();	// recuperation des données POST

			if($form->isValid($po)){	//les données sont elles valides?
				$article = new Application_Model_Article();
				$data_form = $form->getValues();

				if($this->_request->getParam('id_article')){
					$article->editArticle($data_form);
					$this->_flashMessenger->addMessage('Votre article est bien édité');
					$this->_redirector->gotoUrl('article/index');
				}	
				else{
					$article->addArticle($data_form);
					$this->_flashMessenger->addMessage('Votre article a bien été ajouté');
					$this->_redirector->gotoUrl('article/index');
                                }
			}
			else{
				//gestion d'erreur de validité
				$this->_flashMessenger->addMessage('Les données du formulaire ne sont pas valides');
				$this->_redirector->gotoUrl('article/index');
			}
		}
		else{
			
			$id = $this->getRequest()->getParam('id');
			if($id){
				$article = new Application_Model_Article();
				$article = $article->retourneArticle($id)->current()->toArray();
				$form->populate($article);
			}
		
		}
		
		
	}
	
	public function supprimerAction(){
		$article = new Application_Model_Article();
		$id = $this->_request->getParam('id');
		$article->supprimerArticle($id);
		$this->_flashMessenger->addMessage('Votre article a bien été supprimé');
		$this->_redirector->gotoUrl('article/index');
	}
}
