<?php
namespace Kuzstu\BlogBundle\Model\Decorator;

use Kuzstu\BlogBundle\Model;

abstract class AbstractDecorator extends CrudOperationsModel {
    protected $model;
 
    public function __construct(CrudOperationsModel $model) {
        $this->model = $model;
    }
}
?>
