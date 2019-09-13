<?php

use Astronphp\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase {
    private $request;

    public function setUp() {
        $this->response = new Response(null, [
            'url'=> '10.0.0.0',
            'content_type'=> 'application/json',
            'http_code'=> '200',
            'header_size'=> '692',
            'request_size'=> '127',
            'filetime'=> '-1',
            'ssl_verify_result'=> '0',
            'redirect_count'=> '0',
            'total_time'=> '0',
            'namelookup_time'=> '0',
            'connect_time'=> '0',
            'pretransfer_time'=> '0',
            'size_upload'=> '0',
            'size_download'=> '100',
            'speed_download'=> '100',
            'speed_upload'=> '0',
            'download_content_length'=> '100',
            'upload_content_length'=> '0',
            'starttransfer_time'=> '0',
            'redirect_time'=> '0',
            'redirect_url'=> '',
            'primary_ip'=> '10.0.0.0',
            'certinfo'=> [],
            'primary_port'=> '100',
            'local_ip'=> '10.0.0.0',
            'local_port'=> '100',
        ]);
    }

    public function test_Should_ReturnUrl() {
        $this->assertEquals('10.0.0.0', $this->response->getUrl());
    }
    public function test_Should_ReturnContentType() {
        $this->assertEquals('application/json', $this->response->getContentType());
    }
    public function test_Should_ReturnHttpCode() {
        $this->assertEquals('200', $this->response->getHttpCode());
    }
    public function test_Should_ReturnHeaderSize() {
        $this->assertEquals('692', $this->response->getHeaderSize());
    }
    public function test_Should_ReturnRequestSize() {
        $this->assertEquals('127', $this->response->getRequestSize());
    }
    public function test_Should_ReturnFiletime() {
        $this->assertEquals('-1', $this->response->getFiletime());
    }
    public function test_Should_ReturnSslVerifyResult() {
        $this->assertEquals('0', $this->response->getSslVerifyResult());
    }
    public function test_Should_ReturnRedirectCount() {
        $this->assertEquals('0', $this->response->getRedirectCount());
    }
    public function test_Should_ReturnTotalTime() {
        $this->assertEquals('0', $this->response->getTotalTime());
    }
    public function test_Should_ReturnNamelookupTime() {
        $this->assertEquals('0', $this->response->getNameLookupTime());
    }
    public function test_Should_ReturnConnectTime() {
        $this->assertEquals('0', $this->response->getConnectTime());
    }
    public function test_Should_ReturnPretransferTime() {
        $this->assertEquals('0', $this->response->getPreTransferTime());
    }
    public function test_Should_ReturnSizeUpload() {
        $this->assertEquals('0', $this->response->getSizeUpload());
    }
    public function test_Should_ReturnSizeDownload() {
        $this->assertEquals('100', $this->response->getSizeDownload());
    }
    public function test_Should_ReturnSpeedDownload() {
        $this->assertEquals('100', $this->response->getSpeedDownload());
    }
    public function test_Should_ReturnSpeedUpload() {
        $this->assertEquals('0', $this->response->getSpeedUpload());
    }
    public function test_Should_ReturnDownloadContentLength() {
        $this->assertEquals('100', $this->response->getDownloadContentLength());
    }
    public function test_Should_ReturnUploadContentLength() {
        $this->assertEquals('0', $this->response->getUploadContentLength());
    }
    public function test_Should_ReturnStarttransferTime() {
        $this->assertEquals('0', $this->response->getStartTransferTime());
    }
    public function test_Should_ReturnRedirectTime() {
        $this->assertEquals('0', $this->response->getRedirectTime());
    }
    public function test_Should_ReturnRedirectUrl() {
        $this->assertEquals('', $this->response->getRedirectUrl());
    }
    public function test_Should_ReturnPrimaryIp() {
        $this->assertEquals('10.0.0.0', $this->response->getPrimaryIp());
    }
    public function test_Should_ReturnCertinfo() {
        $this->assertEquals([], $this->response->getCertInfo());
    }
    public function test_Should_ReturnPrimaryPort() {
        $this->assertEquals('100', $this->response->getPrimaryPort());
    }
    public function test_Should_ReturnLocalIp() {
        $this->assertEquals('10.0.0.0', $this->response->getLocalIp());
    }
    public function test_Should_ReturnLocalPort() {
        $this->assertEquals('100', $this->response->getLocalPort());
    }
}