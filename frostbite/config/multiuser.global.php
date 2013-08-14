<?php
return array(
    'mdgmultiuser' => array(
        'example_alias' => array(
            'route_login'           => 'example-user-route/login',
            'route_logout'          => 'example-user-route/logout',
            'route_register'        => 'example-user-route/register',
            'route_change_password' => 'example-user-route/changepassword',
            'route_change_email'    => 'example-user-route/changeemail',
            'table_name'            => 'example_user_table',
            'login_redirect_route'  => 'example-user-route',
            'logout_redirect_route' => 'example-user-route/login'
        )
    ),
    'router' => array(
        'routes' => array(
            'example-user-route' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/example-user',
                    'defaults' => array(
                        'controller' => 'mdgmultiuser.example_alias',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'login' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/login',
                            'defaults' => array(
                                'controller' => 'mdgmultiuser.example_alias',
                                'action' => 'login'
                            )
                        )
                    ),
                    'authenticate' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/authenticate',
                            'defaults' => array(
                                'controller' => 'mdgmultiuser.example_alias',
                                'action' => 'authenticate'
                            )
                        )
                    ),
                    'logout' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/logout',
                            'defaults' => array(
                                'controller' => 'mdgmultiuser.example_alias',
                                'action' => 'logout'
                            )
                        )
                    ),
                    'register' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/register',
                            'defaults' => array(
                                'controller' => 'mdgmultiuser.example_alias',
                                'action' => 'register'
                            )
                        )
                    ),
                    'changepassword' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/change-password',
                            'defaults' => array(
                                'controller' => 'mdgmultiuser.example_alias',
                                'action' => 'changepassword'
                            )
                        )
                    ),
                    'changeemail' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/change-email',
                            'defaults' => array(
                                'controller' => 'mdgmultiuser.example_alias',
                                'action' => 'changeemail'
                            )
                        )
                    )
                )
            )
        )
    )
);
