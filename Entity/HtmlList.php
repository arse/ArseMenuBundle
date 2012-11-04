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
