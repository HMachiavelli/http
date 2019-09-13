<?php

namespace Astronphp\Http\Interfaces;

interface Singleton {
    public static function getInstance(): Singleton;
}