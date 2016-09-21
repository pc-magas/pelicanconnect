<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('member_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Member:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('member_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Member:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('member_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Member:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('member_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Member:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('member_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Member:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
