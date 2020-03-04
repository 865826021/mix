<?php

namespace Mix\ServiceCenter;

/**
 * Interface ServiceCenterInterface
 * @package Mix\ServiceCenter
 */
interface ServiceCenterInterface
{

    /**
     * Get Service
     * @param string $name
     * @return ServiceInterface
     */
    public function get(string $name): ServiceInterface;
    
    /**
     * Register
     * @param ServiceBundleInterface $bundle
     * @throws \Exception
     */
    public function register(ServiceBundleInterface $bundle);

    /**
     * Un Register
     * @param ServiceBundleInterface $bundle
     * @throws \Exception
     */
    public function unregister(ServiceBundleInterface $bundle);

    /**
     * Clear
     * close all monitor
     * unregister all service
     */
    public function clear();

}
