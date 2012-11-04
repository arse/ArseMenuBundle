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

class MenuController
{
    protected $lists = array();

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

}
