<?php

use Astronphp\Http\Header;
use Astronphp\Http\Location;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase {
    private $header;

    public function setUp() {
        $this->header = new Header();
    }

    public function test_ShouldReturnArrayOfHeader() {
        $this->header->add('Content-Type', 'application/json');
        $this->header->add('Accept', 'application/json');
        $this->assertEquals([
            'Content-Type: application/json',
            'Accept: application/json',
        ], $this->header->toArray());
    }
}