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

    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {

        // borrowed from EdpModuleLayouts
        $sharedEventManager = $e->getApplication()->getEventManager()->getSharedManager();

        $sharedEventManager->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function(\Zend\Mvc\MvcEvent $dispatchEvent) {
                $controller = $dispatchEvent->getTarget();
                $request = $controller->getRequest();
                $matchedRoute = $dispatchEvent->getRouteMatch()->getMatchedRouteName();

                $controllerClass = get_class($controller);
                $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
                $config = $dispatchEvent->getApplication()->getServiceManager()->get('config');

                $layout = 'layout/layout';

                if (array_key_exists('module_layoutes', $config)) {
                    if (array_key_exists($moduleNamespace, $config['module_layouts'])) {
                        $layout = $config['module_layouts'][$moduleNamespace];
                    }
                }

                if (array_key_exists('route_layouts', $config)) {
                    if (array_key_exists($matchedRoute, $config['route_layouts'])) {
                        $layout = $config['route_layouts'][$matchedRoute];
                    }
                }

                if ($layout !== 'layout/layout') {
                    if (empty($layout)) {
                        $result = $dispatchEvent->getResult();
                        if ($result instanceof \Zend\View\Model\ViewModel) {
                            $result->setTerminal(true);
                        }
                    } else {
                        $controller->layout($layout);
                    }
                }
            }, 99);

        $sharedEventManager->attach('Zend\View\View', 'render', function($e) {
                $viewModel = $e->getTarget();
                \Zend\Debug\Debug::dump($viewModel);
            });
    }

}
