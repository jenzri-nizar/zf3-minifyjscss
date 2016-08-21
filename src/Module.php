<?php
/**
 * User: Jenzri Nizar
 * Date: 19/08/2016
 * Time: 14:21
 */

namespace Zf3\Scss;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
class Module
{



    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('headlink',\Zf3\Scss\View\Helper\headLink::class);
        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('headLink',\Zf3\Scss\View\Helper\headLink::class);
        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('HeadLink',\Zf3\Scss\View\Helper\headLink::class);

        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setFactory(\Zf3\Scss\View\Helper\headLink::class, function ($sm) {
            $helper=new \Zf3\Scss\View\Helper\headLink();
            $basePath=$sm->get('ViewHelperManager')->get("BasePath");
            $helper->setBaseUrl($basePath());
            return $helper;
        });


    }

}