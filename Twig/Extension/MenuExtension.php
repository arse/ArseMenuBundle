<?php
/**
 *
 * File: menuExtension.php
 * User: thomas
 * Date: 02/11/12
 *
 */
namespace Arse\MenuBundle\Twig\Extension;

use Arse\MenuBundle\Service\MenuController;
use Arse\MenuBundle\Entity\HtmlList;
use Arse\MenuBundle\Entity\HtmlListItem;
use Arse\MenuBundle\Entity\HtmlSubListItem;

use Symfony\Component\HttpKernel\KernelInterface;

class MenuExtension extends \Twig_Extension
{
    /** @var MenuController */
    protected $menuService;

    /** @var \Twig_Environment */
/*    protected $environment;

    public function initRuntime(\Twig_Environment $environment){
        $this->environment = $environment;
    }*/

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'menu' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html'))),
        );
    }

    /**
     * renders a menu item to an html menu
     *
     * @param string $string
     * @return int
     */
    public function render ($name)
    {
        /** @var $list HtmlList */
        $list = $this->menuService->getMenu($name);

        if ($list){
            $str = $this->renderList($list);
            return $str;
        }
        else{
            throw new \InvalidArgumentException('No menu exists with name: ' . strip_tags($name));
            exit;
        }

    }

    protected function renderList(HtmlList $list){
        $type = $list->getType();
        $str = '<' . $type . ' ' . $this->renderAttributes($list->getAttributes()) . '>';

        foreach ($list->getItems() as /** @var $item HtmlListItem */ $item){
            // pull out item and list if it's a sublist
            $hasSubList = false;
            if ($item instanceof HtmlSubListItem){
                $list = $item->getSubList();
                $item = $item->getItem();
                $hasSubList = true;
            }

            $str .= '<li' . ' ' . $this->renderAttributes($item->getAttributes()) . '>';
            // TODO the anchor should be able to have attributes set...maybe?
            $str .= '<a href="' . $item->getUrl() . '">' . $item->getText() . '</a>';

            if ($hasSubList){
                $str .= $this->renderList($list);
            }

            $str .= '</li>';
        }

        $str .= '</' . $type . '>';

        return $str;
    }

    protected function renderAttributes(array $attributes){
        if (count($attributes) == 0){
            return '';
        }

        $attrs = array();
        // TODO validate key against possible keys?
        foreach ($attributes as $key => $val){
            $attrs[] = $key . '="' . htmlentities($val) . '"';
        }
        return implode(' ', $attrs);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'arse_menu';
    }

    /**
     * @param $menuService
     *
     * @return MenuExtension
     */
    public function setMenuService($menuService)
    {
        $this->menuService = $menuService;
        return $this;
    }

    /**
     * @return \Arse\MenuBundle\Service\MenuController
     */
    public function getMenuService()
    {
        return $this->menuService;
    }

}
