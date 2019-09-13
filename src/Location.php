<?php

namespace Astronphp\Http;

class Location {
    private static $baseUri;
    private $uri;

    public function __construct(string $uri) {
        $this->uri = trim($uri, '/');
    }

    public static function setBaseUri(string $baseUri) {
        self::$baseUri = rtrim($baseUri, '/');
    }

    public static function getBaseUri(): string {
        return self::$baseUri;
    }

    public function isAbsolute(): bool {
        return preg_match('/^(?:[a-z]+:)?\/\//i', $this->uri);
    }

    public function isRelative(): bool {
        return !$this->isAbsolute();
    }

    public function buildUri(): string {
        return self::$baseUri . '/' . $this->uri;
    }

    public function toString(): string {
        if ($this->isAbsolute()) {
            return $this->uri;
        }
        return $this->buildUri();
    }

    public function __toString() {
        return $this->toString();
    }
}