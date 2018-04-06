<?php
declare(strict_types=1);

namespace Stagem\ZfcFlash\Adapter;

use Slim\Flash\Messages;
use Stagem\ZfcFlash\FlashInterface;

class SlimFlashAdapter implements FlashInterface
{
    /**
     * Instance namespace, default is 'default'
     *
     * @var string
     */
    protected $namespace = self::NAMESPACE_DEFAULT;

    protected $flash;

    public function __construct(Messages $flash = null)
    {
        $this->flash = $flash;
    }

    /**
     * Set real flash manager
     *
     * @param object $flash
     * @return $this
     */
    public function setFlash($flash)
    {
        $this->flash = $flash;

        return $this;
    }

    /**
     * Get real flash manager
     *
     * @return Messages
     */
    public function getFlash(): Messages
    {
        return $this->flash;
    }

    /**
     * Change the namespace messages are added to
     * Useful for per action controller messaging between requests
     *
     * @param  string $namespace
     * @return self
     */
    public function setNamespace($namespace = 'default')
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Get the message namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param $message
     * @param null $namespace
     * @return $this
     */
    public function addMessage($message, $namespace = null)
    {
        if (null === $namespace) {
            $namespace = $this->getNamespace();
        }
        $this->flash->addMessage($namespace, $message);

        return $this;
    }

    /**
     * Check to see if messages have been added to the current
     * namespace within this request
     *
     * @param  string $namespace
     * @return bool
     */
    public function hasCurrentMessages($namespace = null)
    {
        if (null === $namespace) {
            $namespace = $this->getNamespace();
        }

        return $this->flash->hasMessage($namespace);
    }

    /**
     * Get messages that have been added to the current
     * namespace within this request
     *
     * @param  string $namespace
     * @return array
     */
    public function getCurrentMessages($namespace = null)
    {
        if (null === $namespace) {
            $namespace = $this->getNamespace();
        }
        if ($this->hasCurrentMessages($namespace)) {
            $messages = $this->flash->getMessages();
            return $messages[$namespace];
        }

        return [];
    }

    /**
     * Get all messages
     *
     * @return array
     */
    public function getAllMessages()
    {
        return $this->flash->getMessages();
    }

    /**
     * Get messages from a specific namespace
     *
     * @param  string $namespace
     * @return array
     */
    public function getMessages($namespace = null)
    {
        if (null === $namespace) {
            $namespace = $this->getNamespace();
        }
        if ($this->hasMessages($namespace)) {
            $messages = $this->flash->getMessages();
            return $messages[$namespace];
        }

        return [];
    }

    /**
     * Whether a specific namespace has messages
     *
     * @param  string $namespace
     * @return bool
     */
    public function hasMessages($namespace = null)
    {
        if (null === $namespace) {
            $namespace = $this->getNamespace();
        }
        $messages = $this->flash->getMessages();

        return isset($messages[$namespace]);
    }

    /**
     * Clear all messages from the previous request & current namespace
     *
     * @param  string $namespace
     * @return bool True if messages were cleared, false if none existed
     */
    public function clearMessages($namespace = null)
    {
        if (null === $namespace) {
            $namespace = $this->getNamespace();
        }
        if ($this->hasMessages($namespace)) {
            $this->flash->clearMessage($namespace);

            return true;
        }

        return false;
    }

    /**
     * Get messages that have been added to the current
     * namespace in specific namespace
     *
     * @param  string $namespace
     * @return array
     */
    public function getCurrentMessagesFromNamespace($namespace)
    {
        return $this->getCurrentMessages($namespace);
    }

    /**
     * Get messages from a specific namespace
     *
     * @param  string $namespace
     * @return array
     */
    public function getMessagesFromNamespace($namespace)
    {
        return $this->getMessages($namespace);
    }

    /**
     * Clear messages from the container
     *
     * @return bool True if current messages were cleared from the container, false if none existed.
     */
    public function clearCurrentMessagesFromContainer()
    {
        $this->flash->clearMessages();

        return true;
    }
}
