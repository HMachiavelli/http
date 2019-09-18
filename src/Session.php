<?php

namespace Astronphp\Http;

use Astronphp\Http\Interfaces\Singleton;
use Astronphp\Collection\Collection;

class Session implements Singleton {
    protected static $instance;

    private $content;

    private function __construct() {
        $this->content = new Collection();
        $this->content->setByReference($_SESSION);
    }
    
    public function start() {
        session_start();
    }

    public function destroy() {
        session_destroy();
    }

    public function status() {
        return session_status();
    }

    public static function getInstance(): Singleton {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }
    
    public function dump(string $key = null) {
        @var_dump($key ? $this->content->get($key) : $this->content);
    }

    public function get(string $property) {
        return $this->content->get($property);
    }

    public function set(string $property, $value) {
        $this->content->set($property, $value);
    }

    public function isset(string $property): bool {
        return $this->content->isset($property);
    }

    public function empty(string $property): bool {
        return $this->content->empty($property);
    }

    public function unset(string $property) {
        $this->content->unset($property);
    }
}