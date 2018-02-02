<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace MIATrivia;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return array(
    'router' => [
        'routes' => [
            'trivia' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/trivia',
                    'defaults' => [
                        'controller' => Controller\TriviaController::class,
                        'action'     => 'index',
                    ],
                ],
                'child_routes' => [
                    'list' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/list[/:page]',
                            'defaults' => [
                                'controller' => Controller\TriviaController::class,
                                'action'     => 'index',
                                'page'       => 1
                            ],
                        ],
                    ],
                    'add' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'controller' => Controller\TriviaController::class,
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/edit/:id',
                            'defaults' => [
                                'controller' => Controller\TriviaController::class,
                                'action'     => 'edit',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/delete/:id',
                            'defaults' => [
                                'controller' => Controller\TriviaController::class,
                                'action'     => 'delete',
                            ],
                        ],
                    ],
                ]
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\TriviaController::class => InvokableFactory::class
        ],
    ],
    'service_manager' => [
        'factories' => [
            Table\TriviaTable::class => \MIABase\Factory\TableFactory::class,
        ],
    ],
    'authentication_acl' => [
        'resources' => [
            Controller\TriviaController::class => [
                'actions' => [
                    'index' => ['allow' => 'admin'],
                    'add' => ['allow' => 'admin'],
                    'edit' => ['allow' => 'admin'],
                    'delete' => ['allow' => 'admin'],
                ]
            ],
            Controller\UserController::class => [
                'actions' => [
                    'mobileia' => ['allow' => 'guest'],
                ]
            ]
        ],
    ],
    'view_manager' => [
        'template_map' => [
            
        ],
    ]
);
