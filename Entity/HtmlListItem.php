<?php
/**
 *
 * File: MenuItem.php
 * User: thomas
 * Date: 02/11/12
 *
 */
namespace Arse\MenuBundle\Entity;

class HtmlListItem
{
    /** @var string */
    protected $text;
    /** @var string */
    protected $url;
    /** @var array */
    protected $attributes = array();

    public function __construct($urlOrDt, $textOrDd = null, $attributes = array()){
        $this->text = $textOrDd;
        $this->url = $urlOrDt;
        $this->attributes = $attributes;
    }

/*    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }*/

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttribute($name, $value){
        $this->attributes[$name] = $value;
    }

    public function getAttribute($name){
        return $this->attributes[$name];
    }

    public function setUrl($link)
    {
        $this->url = $link;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $title
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text != null ? $this->text : $this->url;
    }

}
