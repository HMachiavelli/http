<?php

namespace Astronphp\Http;

class Response {

    const CONTINUE = 100;
    const SWITCHING_PROTOCOL = 101;
    const PROCESSING = 102;
    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const NON_AUTHORITATIVE_INFORMATION = 203;
    const NO_CONTENT = 204;
    const RESET_CONTENT = 205;
    const PARTIAL_CONTENT = 206;
    const MULTI_STATUS = 207;
    const IM_USED = 226;
    const MULTIPLE_CHOICE = 300;
    const MOVED_PERMANENTLY = 301;
    const FOUND = 302;
    const SEE_OTHER = 303;
    const NOT_MODIFIED = 304;
    const USE_PROXY  = 305;
    const UNUSED  = 306;
    const TEMPORARY_REDIRECT = 307;
    const PERMANENT_REDIRECT = 308;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const NOT_ACCEPTABLE = 406;
    const PROXY_AUTHENTICATION_REQUIRED = 407;
    const REQUEST_TIMEOUT = 408;
    const CONFLICT = 409;
    const GONE = 410;
    const LENGTH_REQUIRED = 411;
    const PRECONDITION_FAILED = 412;
    const PAYLOAD_TOO_LARGE = 413;
    const URI_TOO_LONG = 414;
    const UNSUPPORTED_MEDIA_TYPE = 415;
    const REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const EXPECTATION_FAILED = 417;
    const IM_A_TEAPOT = 418;
    const MISDIRECTED_REQUEST = 421;
    const UNPROCESSABLE_ENTITY = 422;
    const LOCKED = 423;
    const FAILED_DEPENDENCY = 424;
    const UPGRADE_REQUIRED = 426;
    const PRECONDITION_REQUIRED = 428;
    const TOO_MANY_REQUESTS = 429;
    const REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    const INTERNAL_SERVER_ERROR = 500;
    const NOT_IMPLEMENTED = 501;
    const BAD_GATEWAY = 502;
    const SERVICE_UNAVAILABLE = 503;
    const GATEWAY_TIMEOUT = 504;
    const HTTP_VERSION_NOT_SUPPORTED = 505;
    const VARIANT_ALSO_NEGOTIATES = 506;
    const INSUFFICIENT_STORAGE = 507;
    const LOOP_DETECTED = 508;
    const NOT_EXTENDED = 510;
    const NETWORK_AUTHENTICATION_REQUIRED = 511;

    private $data;
    private $info;

    public function __construct($data = [], array $info = []) {
        $this->setData($data);
        $this->setInfo($info);
    }

    public function json() {
        echo $this->data->toJson(); exit;
    }

    public function get(string $key = null) {
        return $key ? $this->data->get($key) : $this->data;
    }

    public function setData($data = []) {
        if (is_string($data)) {
            $data = (array) json_decode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
        $this->data = new \Astronphp\Collection\Collection((array) $data);
    }

    public function setInfo(array $info) {
        $this->info = $info;
    }

    public function getUrl() {
        return $this->info['url'] ?? null;
    }
    
    public function getContentType() {
        return $this->info['content_type'] ?? null;
    }
    
    public function getHttpCode() {
        return $this->info['http_code'] ?? null;
    }
    
    public function getHeaderSize() {
        return $this->info['header_size'] ?? null;
    }
    
    public function getRequestSize() {
        return $this->info['request_size'] ?? null;
    }
    
    public function getFileTime() {
        return $this->info['filetime'] ?? null;
    }
    
    public function getSslVerifyResult() {
        return $this->info['ssl_verify_result'] ?? null;
    }
    
    public function getRedirectCount() {
        return $this->info['redirect_count'] ?? null;
    }
    
    public function getTotalTime() {
        return $this->info['total_time'] ?? null;
    }
    
    public function getNameLookupTime() {
        return $this->info['namelookup_time'] ?? null;
    }
    
    public function getConnectTime() {
        return $this->info['connect_time'] ?? null;
    }
    
    public function getPreTransferTime() {
        return $this->info['pretransfer_time'] ?? null;
    }
    
    public function getSizeUpload() {
        return $this->info['size_upload'] ?? null;
    }
    
    public function getSizeDownload() {
        return $this->info['size_download'] ?? null;
    }
    
    public function getSpeedDownload() {
        return $this->info['speed_download'] ?? null;
    }
    
    public function getSpeedUpload() {
        return $this->info['speed_upload'] ?? null;
    }
    
    public function getDownloadContentLength() {
        return $this->info['download_content_length'] ?? null;
    }
    
    public function getUploadContentLength() {
        return $this->info['upload_content_length'] ?? null;
    }
    
    public function getStartTransferTime() {
        return $this->info['starttransfer_time'] ?? null;
    }
    
    public function getRedirectTime() {
        return $this->info['redirect_time'] ?? null;
    }
    
    public function getRedirectUrl() {
        return $this->info['redirect_url'] ?? null;
    }
    
    public function getPrimaryIp() {
        return $this->info['primary_ip'] ?? null;
    }
    
    public function getCertInfo() {
        return $this->info['certinfo'] ?? null;
    }
    
    public function getPrimaryPort() {
        return $this->info['primary_port'] ?? null;
    }
    
    public function getLocalIp() {
        return $this->info['local_ip'] ?? null;
    }
    
    public function getLocalPort() {
        return $this->info['local_port'] ?? null;
    }
}