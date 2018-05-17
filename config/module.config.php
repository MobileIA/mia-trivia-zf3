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
                    'votes' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/votes/:id',
                            'defaults' => [
                                'controller' => Controller\TriviaController::class,
                                'action'     => 'votes',
                            ],
                        ],
                    ],
                    'export' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/votes/export/:id',
                            'defaults' => [
                                'controller' => Controller\TriviaController::class,
                                'action'     => 'export',
                            ],
                        ],
                    ],
                ]
            ],
            'api-trivia-list' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/trivia/list',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'list',
                    ],
                ],
            ],
            'api-trivia-vote' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/trivia/vote',
                    'defaults' => [
                        'controller' => Controller\ApiController::class,
                        'action'     => 'vote',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\ApiController::class => InvokableFactory::class,
            Controller\TriviaController::class => InvokableFactory::class
        ],
    ],
    'service_manager' => [
        'factories' => [
            Table\TriviaTable::class => \MIABase\Factory\TableFactory::class,
            Table\OptionTable::class => \MIABase\Factory\TableFactory::class,
            Table\VoteTable::class => \MIABase\Factory\TableFactory::class,
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
                    'votes' => ['allow' => 'admin'],
                    'export' => ['allow' => 'admin'],
                ]
            ],
            Controller\ApiController::class => [
                'actions' => [
                    'list' => ['allow' => 'guest'],
                    'vote' => ['allow' => 'guest'],
                ]
            ],
        ],
    ],
    'view_manager' => array(
        'template_map' => [
            'mia-trivia/trivia/votes' => __DIR__ . '/../view/trivia/votes.phtml',
        ],
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
