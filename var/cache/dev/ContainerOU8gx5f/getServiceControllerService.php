<?php

namespace ContainerOU8gx5f;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getServiceControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\ServiceController' shared autowired service.
     *
     * @return \App\Controller\ServiceController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/ServiceController.php';

        $container->services['App\\Controller\\ServiceController'] = $instance = new \App\Controller\ServiceController(($container->services['doctrine.orm.default_entity_manager'] ?? $container->load('getDoctrine_Orm_DefaultEntityManagerService')), ($container->privates['serializer'] ?? self::getSerializerService($container)), ($container->privates['cache.app.taggable'] ?? $container->load('getCache_App_TaggableService')));

        $instance->setContainer(($container->privates['.service_locator.O2p6Lk7'] ?? $container->load('get_ServiceLocator_O2p6Lk7Service'))->withContext('App\\Controller\\ServiceController', $container));

        return $instance;
    }
}
