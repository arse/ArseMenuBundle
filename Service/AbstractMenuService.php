<?php
/**
 *
 * File: ListBase.php
 * User: thomas
 * Date: 03/11/12
 *
 */
namespace Arse\MenuBundle\Service;

use Arse\MenuBundle\Service\MenuController;
use Symfony\Component\Routing\Router;

/**
 * Abstract class to be extended for each bundle that wants to modify a list
 */
abstract class AbstractMenuService
{
    /** @var $menuService MenuController */
    protected $menuService;

    /** @var $router Router */
    protected $router;

    /**
     * make all the changes to lists here:
     *  add new lists or  modify existing lists - fetch them with $this->menuService->getMenu('list_name');
     *
     * @abstract
     * @return void
     */
    abstract function getMenus();


    /**
     * @param \Arse\MenuBundle\Service\MenuController $listService
     */
    public function setMenuService($listService)
    {
        $this->menuService = $listService;
        return $this;
    }

    /**
     * @param \Arse\MenuBundle\Service\Router $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
        return $this;
    }

}
