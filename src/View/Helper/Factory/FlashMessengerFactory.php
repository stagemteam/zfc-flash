<?php

namespace Stagem\ZfcFlash\View\Helper\Factory;

use ReflectionClass;
use Psr\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\FlashMessenger;
use Stagem\ZfcFlash\FlashInterface;

class FlashMessengerFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     * @param string $name
     * @param null|array $options
     * @return FlashMessenger
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        // test if we are using Zend\ServiceManager v2 or v3
        if (! method_exists($container, 'configure')) {
            $container = $container->getServiceLocator();
        }

        $helper = new FlashMessenger();
        $flashAdapter = $container->get(FlashInterface::class);

        $class = new ReflectionClass(FlashMessenger::class);
        $property = $class->getProperty('pluginFlashMessenger');
        $property->setAccessible(true);
        $property->setValue($helper, $flashAdapter);

        #$helper->setPluginFlashMessenger($flashMessenger);

        $config = $container->get('config');
        if (isset($config['view_helper_config']['flashmessenger'])) {
            $configHelper = $config['view_helper_config']['flashmessenger'];
            if (isset($configHelper['message_open_format'])) {
                $helper->setMessageOpenFormat($configHelper['message_open_format']);
            }
            if (isset($configHelper['message_separator_string'])) {
                $helper->setMessageSeparatorString($configHelper['message_separator_string']);
            }
            if (isset($configHelper['message_close_string'])) {
                $helper->setMessageCloseString($configHelper['message_close_string']);
            }
        }

        return $helper;
    }

    /**
     * Create service (v2)
     *
     * @param ServiceLocatorInterface $container
     * @param string $normalizedName
     * @param string $requestedName
     * @return FlashMessenger
     */
    public function createService(ServiceLocatorInterface $container, $normalizedName = null, $requestedName = null)
    {
        return $this($container, $requestedName);
    }
}
