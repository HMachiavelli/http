<?php

use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase {
    private $session;

    public function setUp() {
        $_SESSION['unit_test']['before'] = 'start';

        $this->session = \Astronphp\Http\Session::getInstance();

        $_SESSION['unit_test']['after']  = 'end';
    }

    public function test_Should_ReturnTrue_When_VerifyingPreviouslySetData() {
        $this->assertTrue($this->session->isset('unit_test.before'));
    }

    public function test_Should_ReturnFalse_When_VerifyingPreviouslySetData() {
        $this->assertFalse($this->session->empty('unit_test.before'));
    }

    public function test_Should_ReturnValue_When_AccessingPreviouslySetData() {
        $this->assertEquals('start', $this->session->get('unit_test.before'));
    }

    public function test_Should_ReturnValue_When_AccessingDataSetLater() {
        $this->assertEquals('end', $this->session->get('unit_test.after'));
    }

    public function test_Should_SetValueInGlobal_When_SettingValueByClass() {
        $this->session->set('unit_test.final', 'final');
        $this->assertEquals('final', $_SESSION['unit_test']['final']);
    }

    public function test_Should_ReturnFalse_When_VerifyingAfterUnset() {
        $this->session->unset('unit_test.before');
        $this->assertFalse($this->session->isset('unit_test.before'));
    }

    public function test_Should_ReturnConstant_When_GettingStatus() {
        $this->assertEquals(PHP_SESSION_NONE, $this->session->status());
    }
}