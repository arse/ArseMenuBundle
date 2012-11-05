<?php
/**
 *
 * File: Servic.php
 * User: thomas
 * Date: 02/11/12
 *
 */
namespace Arse\MenuBundle\Service;

use Arse\MenuBundle\Entity\HtmlList;
use Arse\MenuBundle\Service\AbstractMenuService;

use Symfony\Component\Routing\Router;

class MenuController
{
    protected $lists = array();

    /**
     * @var $router Router
     */
    protected $router;

    /**
     * add an ordered list
     * @param       $name
     * @param array $attributes
     */
    public function addOrderedList($name, $attributes = array()){
        $list = new HtmlList($name, HtmlList::TYPE_ORDERED_LIST, $attributes);
        $this->addList($list);
        return $list;
    }

    /**
     * add an unordered list
     * @param       $name
     * @param array $attributes
     */
    public function addUnorderedList($name, $attributes = array()){
        $list = new HtmlList($name, HtmlList::TYPE_UNORDERED_LIST, $attributes);
        $this->addList($list);
        return $list;
    }

    public function processMenusFromService(AbstractMenuService $serviceMenuBase){
        // trigger the changes to be made to the lists
        $serviceMenuBase->getMenus();
    }

    /**
     * Add an html list to the service
     * @param \Arse\MenuBundle\Entity\HtmlList $list
     */
    protected function addList(HtmlList $list){
        $this->lists[$list->getName()] = $list;
    }

    /**
     * @param array $menus
     * @return MenuController
     */
/*    public function setLists(array $lists)
    {
        $this->lists = $lists;
        return $this;
    }*/

    /**
     * @return array
     */
    public function getMenus()
    {
        return $this->lists;
    }

    /**
     * @param $name
     *
     * @return HtmlList
     */
    public function getMenu($name){
        if (array_key_exists($name, $this->lists)){
            return $this->lists[$name];
        }
        return false;
    }

    /**
     * generate url for path
     * @param       $pathName
     * @param array $args
     */
    public function generateUrlForPathName($pathName, $args = array()){
        $this->router->generate($pathName, $args);
    }

    public function setRouter($router)
    {
        $this->router = $router;
        return $this;
    }

}
