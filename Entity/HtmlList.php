<?php
/**
 *
 * File: Menu.php
 * User: thomas
 * Date: 02/11/12
 *
 */
namespace Arse\MenuBundle\Entity;

use Arse\MenuBundle\Entity\HtmlListItem;
use Arse\MenuBundle\Entity\HtmlSubListItem;

class HtmlList
{
    protected $name;

    /** @var array html attributes */
    protected $attributes = array();

    /**
     * @var array array of ListItem's
     */
    protected $items = array();

    protected $type;
    const TYPE_ORDERED_LIST = 'ol';
    const TYPE_UNORDERED_LIST = 'ul';

    public function __construct($name, $type = self::TYPE_UNORDERED_LIST, $attributes = array()){
        $this->name = $name;
        $this->type = $type;
        $this->attributes = $attributes;
    }

    /**
     * @param $item HtmlListItem
     */
    public function addItem(HtmlListItem $item){
        $this->items[] = $item;
    }

    public function addSubListItem(HtmlListItem $item, HtmlList $list){
        // check that we have more than one item in the html list
        // TODO this is hacky as it's a workaround to ensure that the htmllist already exists in the menuservice
        // TODO so, a property should be added in htmllist to be set when created by the menu service and checked here?
        if (count($list->getItems()) == 0){
            throw new \RuntimeException('The supplied html list should have one item  before it can be used as a sublist.');
            exit;
        }

        $subList = new HtmlSubListItem($item, $list);
        $this->items[] = $subList;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttribute($name, $value){
        $this->attributes[$name] = $value;
    }
}
