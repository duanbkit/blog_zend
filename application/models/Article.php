<?php
class Application_Model_Article
{
	protected $_table;
	public function __construct (array $options=null){
		$this->_table = new Application_Model_DbTable_Article();
	}

	public function tousArticles(){
		$select = $this->_table->select()->where('publie = ?',1);
		return $this->_table->fetchAll($select);

	}
	
	public function countArticles($un,$deux){
		$select = $this->_table->select()->where('publie = ?',1)->limit($un,$deux);
		return $this->_table->fetchAll($select);

	}

	public function retourneArticle($id){
		$select = $this->_table->select();
		$select->where("id_article = ?",$id);
		return $this->_table->fetchAll($select);
	}
	
	public function addArticle($donnees){
		$donnees['date'] = time();
		$this->_table->insert($donnees);
	}
	
	public function editArticle($donnees){
		$donnees['date'] = time();
		$this->_table->update($donnees, array('id_article = ?' => $donnees['id_article']));	
	}
	
	public function supprimerArticle($id){
		$this->_table->delete(array("id_article = ?" => $id));
	}

}
