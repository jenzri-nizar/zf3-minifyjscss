<?php
/**
 * User: Jenzri Nizar
 * Date: 19/08/2016
 * Time: 15:56
 */

namespace Zf3\Minify;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('headlink',\Zf3\Minify\View\Helper\HeadLink::class);
        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('headLink',\Zf3\Minify\View\Helper\HeadLink::class);
        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('HeadLink',\Zf3\Minify\View\Helper\HeadLink::class);

        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setFactory(\Zf3\Minify\View\Helper\HeadLink::class, function ($sm) {
            $helper=new \Zf3\Minify\View\Helper\HeadLink();
            $basePath=$sm->get('ViewHelperManager')->get("BasePath");
            $helper->setBaseUrl($basePath());
            return $helper;
        });

        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('headscript',\Zf3\Minify\View\Helper\HeadScript::class);
        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('headScript',\Zf3\Minify\View\Helper\HeadScript::class);
        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setAlias('HeadScript',\Zf3\Minify\View\Helper\HeadScript::class);

        $e->getApplication()->getServiceManager()->get('ViewHelperManager')->setFactory(\Zf3\Minify\View\Helper\HeadScript::class, function ($sm) {
            $helper=new \Zf3\Minify\View\Helper\HeadScript();
            $basePath=$sm->get('ViewHelperManager')->get("BasePath");
            $helper->setBaseUrl($basePath());
            return $helper;
        });
    }

}
