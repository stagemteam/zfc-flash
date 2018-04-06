<?php
/**
 * @category Stagem
 * @package Stagem_ZfcFlash
 * @author Serhii Stagem <popow.serhii@gmail.com>
 * @datetime: 03.02.2018 11:58
 */
namespace Stagem\ZfcFlash;

class ConfigProvider
{
    public function __invoke()
    {
        $config =  require __DIR__ . '/../config/module.config.php';

        return $config;
    }
}