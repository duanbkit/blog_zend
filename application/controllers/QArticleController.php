<?php
 class ArticleController extends Zend_Controller_Action{
    public function indexAction()
    {
	    $modele = new Application_Model_Article();
	    $this->view->articles = $modele->tousArticles();   
 
    }
        


    public function editerAction(){
	
		/* --------------------------------
		 *           Partie Damien
		 * -------------------------------- */
		$form = new Application_Form_Article();
		$form->setAction($this->view->url);
		$this->view->form = $form;
		
		
		if($this->getRequest()->isPost())// Si les données arrivent par la méthode POST
		{      
		       $article = $this->getRequest()->getPost();	//stockage des données issues du POST dans une variable
		       if($form->isValid($article))//Si les données sont valides par rapport au formulaire (formulaire->isValid(lesdonnées))
		       {
			      /*	Instanciation d'un article    */
				    $article = new ...(); //Pas ce genre d'article qu'on a créé
				    $data_form = $form->getValues(); //Enregistrement des données du formulaire dans une variable
				     

					 if($this->_request->getParam('id')) //Si il y a une un id dans les données POST
					 {
						  //Utilisation de la méthode editerArticle du modèle Article avec les données du formulaire en paramètre
						  $article->editerArticle($data_form);

						  
					 }
					else
					{
						 $article->addArticle($data_form); //Utilisation de la méthode pour ajouter un article
						
					}
				}
			}
			else
			{
			 $id = $this->getRequest()->getParam('id'); //Enregistrement de l'id recu par la requete GET dans une variable
			 /*	Si id existe  */
				if($id){
				/*	Instanciation d'un article  */
					$article = new ...(); // Meme article que au dessus, à toi de trouver le bon
					$article = $article->retourneArticle($id)->current()->toArray(); //Utilisation de la méthode retourneArticle
					$form->populate($article);	//	Ajout des données de l'article dans le formulaire   
				}
			}
		 
		}	   
} 
?>
