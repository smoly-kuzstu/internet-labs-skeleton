<?php
namespace Kuzstu\BlogBundle\Model\Decorator;

class CacheDecorator extends AbstractDecorator{
    
    protected $aclManager;
    protected $user;
    
    public function __construct(CrudOperationsModel $model, $aclManager, $user) {
        parent::__construct($model);
        $this->aclManager = $aclManager;
        $this->user = $user;
    }
    
    public function readItem($id){
         if ($this->aclManager->userHasRole($user, 'user')){
             return $this->wrappedModel->readItem($id);
         } else{
            throw new \Exception("Access denided!");
            return false;
         }
    }
    
    public function createItem($title, $content){
        if ($this->aclManager->userHasRole($user, 'admin')){  
            
            $this->wrappedModel->createItem($id);
            
            $this->aclManager->setHolder('blog_entry', $id, $user);
            return true;
        } else{
            throw new \Exception("Access denided!");
            return false;
        }
    }
}

?>
