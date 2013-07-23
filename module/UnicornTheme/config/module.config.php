<?php

return array(
    'view_helpers' => array(
        'invokables'=> array(
            'unicornuserwidget'    => 'UnicornTheme\View\Helper\UnicornUserWidget',
        ),
        'aliases' => array(
            'userwidget' => 'unicornuserwidget'
        )
    ),
    'view_manager' => array(
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/login'            => __DIR__ . '/../view/layout/login.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'module_layouts' => array(
//        'ZfcUser' => 'layout/login',
    ),
    'route_layouts' => array(
        'zfcuser/register' => 'layout/login',
//        'zfcuser/register' => null,
        'zfcuser/login' => 'layout/login',
    )
);
