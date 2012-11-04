
Arse\MenuBundle (Symfony 2.1)
==================

A simple bundle to help maintain menus/lists across bundles. The primary use for this bundle is for menus, but it can be
used to create and modify ul's and ol's across your application. Other uses may include a list of help commands across
an application, instruction steps for your application etc.

The bundle creates a service (arse.menu), which exposes a menu controller (Arse\MenuBundle\Service\MenuController). This
gives you access to create and fetch new menus/lists - now referred to as lists for the sake of brevity - from a class
within your bundles .

Use
-----

Install the bundle and add to AppKernel.php

```
$bundles[] = new Arse\MenuBundle\ArseMenuBundle();
```

To create / modify a list, a bundle needs to have a tagged service and the class must extend the
Arse\MenuBundle\Service\AbstractMenuService abstract class.

e.g.
```
namespace Foo\MyBundle\Menu;

use Arse\MenuBundle\Service\AbstractMenuService;
use Arse\MenuBundle\Entity\HtmlListItem;
use Arse\MenuBundle\Entity\HtmlList;

class Menu extends AbstractMenuService
{
    public function getMenus(){
        $attributes = array('class' => 'foo bar car', 'id' => 'some-test-id');
        $m = $this->menuService->addUnorderedList('my-first-menu', $attributes);
        $m->addItem(new HtmlListItem('http://example.com', 'test link', array('id' => 'foo')));

        // add a sublist to the list
        $sublist = new HtmlList('sublist');
        $sublist->addItem(new HtmlListItem('http://foo/1_big.jpg', 'it is a face'));
        $m->addSubListItem(new HtmlListItem('http://google.com', 'google!'), $sublist);

        // fetch another menu/list for modification (a sublist is fetchable like this)
        $m = $this->menuService->getMenu('my-other-menu');
        $m->addItem(new HtmlListItem('http://example.com', 'test link', array('id' => 'foo2')));
    }
}
```

And expose the class as a service for that bundle with the tag name: arse.menu.listing

```
  foo.mybundle.menu:
    class:  Foo\MyBundle\Menu\Menu
    tags:
      - { name: arse.menu.listing }
```

Rendering
-----------

To render the list, there is a twig function which will render the HTML for your list.

```
{{ menu('menu_name') }}
```

That's All Folks
------------------

That's all there is to it! Yes, it's basic, but it suffices for simple menus and listings.


Todo
--------------

I'd like to add the possibility to render lists using twig templates. This would make bootstrap navigations easy to
create. I directly have no use for this, but maybe someone who does would want to create a twig template for creating a
navigation menu?
