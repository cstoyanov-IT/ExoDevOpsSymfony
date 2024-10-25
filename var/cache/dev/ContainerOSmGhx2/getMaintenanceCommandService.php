<?php

namespace ContainerOSmGhx2;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMaintenanceCommandService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Command\MaintenanceCommand' shared autowired service.
     *
     * @return \App\Command\MaintenanceCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/src/Command/MaintenanceCommand.php';

        $container->privates['App\\Command\\MaintenanceCommand'] = $instance = new \App\Command\MaintenanceCommand(($container->services['doctrine.orm.default_entity_manager'] ?? $container->load('getDoctrine_Orm_DefaultEntityManagerService')), ($container->privates['cache.app.taggable'] ?? $container->load('getCache_App_TaggableService')), ($container->privates['monolog.logger'] ?? $container->load('getMonolog_LoggerService')));

        $instance->setName('app:maintenance');
        $instance->setDescription('Performs maintenance tasks like cache clearing and generating statistics');

        return $instance;
    }
}
