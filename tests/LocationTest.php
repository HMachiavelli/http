<?php

use Astronphp\Http\Location;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase {
    public function setUp() {
        Location::setBaseUri('https://www.example.com/api');
    }

    public function test_Should_ReturnBaseUri() {
        $this->assertEquals('https://www.example.com/api', Location::getBaseUri());
    }

    public function test_Should_ReturnTrue_When_TestingIfIsAbsolute() {
        $location = new Location('https://www.example.com/api/users/1');
        $this->assertTrue($location->isAbsolute());
    }

    public function test_Should_ReturnTrue_When_TestingIfIsRelative() {
        $location = new Location('/users/1');
        $this->assertTrue($location->isRelative());
    }

    public function test_Should_ReturnString_When_Casting_RelativeUri() {
        $location = new Location('/users/1');
        $this->assertEquals('https://www.example.com/api/users/1', (string) $location);
    }

    public function test_Should_ReturnString_When_Casting_AbsoluteUri() {
        $location = new Location('https://www.example.com/api/users/1');
        $this->assertEquals('https://www.example.com/api/users/1', (string) $location);
    }
}