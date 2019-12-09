<?php

namespace Astronphp\Http;

class Body {

    private $content;

    public function __construct() {
        $this->content = new \Astronphp\Collection\Collection();
    }

    public function get($key) {
        return $this->content->get($key);
    }

    public function add($key, $value) {
        $this->content->set($key, $value);
    }

    public function toJson() {
        return json_encode($this->content->toArray());
    }
    
    public function toUrlEncoded() {
        return http_build_query($this->content->toArray());
    }
    
    public function toFormData() {
        return $this->content->toArray();
    }

    public function dump($key = null) {
        @var_dump($key ? $this->content->{$key} : $this->content);
    }
}