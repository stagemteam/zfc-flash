<?php
/**
 * The MIT License (MIT)
 * Copyright (c) 2018 Stagem Team
 * This source file is subject to The MIT License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/MIT
 *
 * @category Stagem
 * @package Stagem_ZfcFlash
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */
declare(strict_types=1);

namespace Stagem\ZfcFlash\Adapter\Factory;

use Psr\Container\ContainerInterface;
use Slim\Flash\Messages;
use Stagem\ZfcFlash\Adapter\SlimFlashAdapter;

class SlimFlashAdapterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        // Start the session whenever we use this!
        session_start();

        $flash = new Messages();
        $adapter = new SlimFlashAdapter($flash);

        return $adapter;
    }
}