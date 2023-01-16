<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuBuilder
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $linkClass = 'focus:text-indigo-700 border-b-2 border-transparent focus:border-indigo-700 flex px-5 items-center py-6 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none transition duration-150 ease-in-out';

        $menu = $this->factory->createItem('root', ['attributes'=>['class'=>'flex navigation']]);

        $menu->addChild('Главная', ['route' => 'homepage', 'attributes'=>['class '=> $linkClass]]);
        $menu->addChild('Дипломатия', ['route' => 'homepage', 'attributes'=>['class' => $linkClass]]);
        $menu->addChild('Контакты', ['route' => 'homepage', 'attributes'=>['class' => $linkClass]]);


        return $menu;
    }
}