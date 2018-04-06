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
 * @package Stagem_Flash
 * @author Serhii Popov <popow.serhii@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */

namespace Stagem\ZfcFlash;

interface FlashInterface
{
    /**
     * Default messages namespace
     */
    const NAMESPACE_DEFAULT = 'default';

    /**
     * Success messages namespace
     */
    const NAMESPACE_SUCCESS = 'success';

    /**
     * Warning messages namespace
     */
    const NAMESPACE_WARNING = 'warning';

    /**
     * Error messages namespace
     */
    const NAMESPACE_ERROR = 'error';

    /**
     * Info messages namespace
     */
    const NAMESPACE_INFO = 'info';

    /**
     * Set real flash manager
     *
     * @param object $flash
     * @return self
     */
    public function setFlash($flash);

    /**
     * Get real flash manager
     *
     * @return object
     */
    public function getFlash();

    /**
     * Change the namespace messages are added to
     *
     * Useful for per action messaging between requests
     *
     * @param string $namespace
     * @return self
     */
    public function setNamespace($namespace = self::NAMESPACE_DEFAULT);

    /**
     * Get the message namespace
     *
     * @return string
     */
    public function getNamespace();

    /**
     * Add message
     *
     * @param $message
     * @param null $namespace
     * @return mixed
     */
    public function addMessage($message, $namespace = null);

    /**
     * Get all messages
     *
     * @return array
     */
    public function getAllMessages();

    /**
     * Get messages from a specific namespace
     *
     * @param  string $namespace
     * @return array
     */
    public function getMessages($namespace = null);

    /**
     * Whether a specific namespace has messages
     *
     * @param  string $namespace
     * @return bool
     */
    public function hasMessages($namespace = null);

    /**
     * Clear all messages from the previous request & current namespace
     *
     * @param  string $namespace
     * @return bool True if messages were cleared, false if none existed
     */
    public function clearMessages($namespace = null);

    /**
     * Check to see if messages have been added to the current
     * namespace within this request
     *
     * @param  string $namespace
     * @return bool
     */
    public function hasCurrentMessages($namespace = null);

    /**
     * Get messages that have been added to the current
     * namespace within this request
     *
     * @param  string $namespace
     * @return array
     */
    public function getCurrentMessages($namespace = null);

    /**
     * Get messages that have been added to the current
     * namespace in specific namespace
     *
     * @param  string $namespace
     * @return array
     */
    public function getCurrentMessagesFromNamespace($namespace);

    /**
     * Get messages from a specific namespace
     *
     * @param  string $namespace
     * @return array
     */
    public function getMessagesFromNamespace($namespace);

    /**
     * Clear messages from the container
     *
     * @return bool True if current messages were cleared from the container, false if none existed.
     */
    public function clearCurrentMessagesFromContainer();
}