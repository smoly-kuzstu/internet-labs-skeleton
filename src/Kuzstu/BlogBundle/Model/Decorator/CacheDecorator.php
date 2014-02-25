<?php
namespace Kuzstu\BlogBundle\Model\Decorator;

class CacheDecorator extends AbstractDecorator{
    
    protected $cacheManager;
    
    public function __construct(CrudOperationsModel $model, $cacheManager) {
        parent::__construct($model);
        $this->cacheManager = $cacheManager;
    }
    
    public function readItem($id){
        if ($this->cacheManager->hasKey($id)){
            return $this->cacheManager->getByKey($id);
        } else{
            $item = $this->wrappedModel->readItem($id);
            $this->cacheManager->putKey($id);
            return $item;
        }
    }
}

?>
