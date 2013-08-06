<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sharedEvents = $eventManager->getSharedManager();
        $sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
                $controller = $e->getTarget();
                $request = $controller->getRequest();

                // Skip ACL checks for Console based requests
                if (!$request instanceof ConsoleRequest) {
                    $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
                    $config = $e->getApplication()->getServiceManager()->get('config');
                    $allowedRoutes = array('zfcuser/login', 'zfcuser/register');
                    if (in_array($matchedRoute, $allowedRoutes) || $controller->zfcUserAuthentication()->hasIdentity()) {
                        return; // they're logged in or on the login page, allow
                    }
                    // otherwise, redirect to the login page
                    return $controller->redirect()->toRoute('zfcuser/login');
                }
            }, 1000
        );
    }

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
}
