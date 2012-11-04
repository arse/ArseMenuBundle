<?php
/**
 *
 * File: HtmlSubListItem.php.php
 * User: thomas
 * Date: 04/11/12
 *
 */
namespace Arse\MenuBundle\Entity;

use Arse\MenuBundle\Entity\HtmlList;
use Arse\MenuBundle\Entity\HtmlListItem;

class HtmlSubListItem
{
    protected $item;
    protected $subList;

    public function __construct(HtmlListItem $item, HtmlList $subList){
        $this->item = $item;
        $this->subList = $subList;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getSubList()
    {
        return $this->subList;
    }
}
