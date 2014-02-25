<?php
namespace Kuzstu\BlogBundle\Model\Decorator;

use Kuzstu\BlogBundle\Model;

abstract class AbstractDecorator extends CrudOperationsModel {
    protected $wrappedModel;
 
    public function __construct(CrudOperationsModel $model) {
        $this->wrappedModel = $model;
    }
    
    public function createItem($title, $content){
        $this->wrappedModel->createItem($title, $content);
    }
    
    public function readItem($id){
        return $this->wrappedModel->readItem($id);
    }
    
    public function addComment($id, $content){
        $this->wrappedModel->addComment($id, $content);
    }

    public function readItemsList(){
        return $this->wrappedModel->readItemsList();
    }

    public function updateItem($id, $item, $title){
        $this->wrappedModel->updateItem($id, $item, $title);
    }
    
    public function deleteItem($id){
        $this->wrappedModel->deleteItem($id);
    }
}
?>
