<?php

namespace UnicornTheme;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap($e)
    {
        // borrowed from EdpModuleLayouts
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
            $controller      = $e->getTarget();
            $request         = $controller->getRequest();
            $matchedRoute    = $e->getRouteMatch()->getMatchedRouteName();

            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config          = $e->getApplication()->getServiceManager()->get('config');

            $layout = null;
            if (isset($config['module_layouts'][$moduleNamespace])) {
                $layout = $config['module_layouts'][$moduleNamespace];
            }

            if(isset($config['route_layouts'][$matchedRoute])) {
                $layout = $config['route_layouts'][$matchedRoute];
            }

            if ($layout !== null) {
                $controller->layout($layout);
            }
        }, 99);
    }
}
