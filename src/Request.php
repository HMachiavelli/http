<?php

namespace Astronphp\Http;

use Astronphp\Http\Body;
use Astronphp\Http\Header;
use Astronphp\Http\Sanitizer;
use Astronphp\Collection\Collection;

class Request {
    
    const GET    = 'GET';
    const POST   = 'POST';
    const PUT    = 'PUT';
    const PATCH  = 'PATCH';
    const DELETE = 'DELETE';
    const SERVER = 'SERVER';
    const FILES  = 'FILES';

    const TEXT        = 'text/plain';
    const HTML        = 'text/html';
    const JSON        = 'application/json';
    const FORM_DATA   = 'multipart/form-data';
    const URL_ENCODED = 'application/x-www-form-urlencoded';

    private $query;
    private $body;
    private $server;
    private $files;

    private $curl;
    private $baseUrl;
    private $options;

    private $parameters = [];
    private $response;

    public function __construct(string $baseUrl = null) {
        $this->baseUrl = $baseUrl;
        $this->query   = new Collection($_GET);
        $this->body    = new Collection($_POST);
        $this->server  = new Collection($_SERVER);
        $this->files   = new Collection($_FILES);
    }

    // ==========================================================================
    // =============================== DEBUG METHODS ============================
    // ==========================================================================

    public function dump() {
        @var_dump($this->get, $this->post, $this->server, $this->files);
    }

    // ==========================================================================
    // ======================= RETRIEVE HTTP REQUEST DATA  ======================
    // ==========================================================================

    public function query(string $key = null) {
        return $key === null ? $this->query : $this->query->get($key);
    }

    public function body(string $key = null) {
        return $key === null ? $this->body : $this->body->get($key);
    }

    public function files(string $key = null) {
        return $key === null ? $this->files : $this->files->get($key);
    }

    public function server(string $key = null) {
        return $key === null ? $this->server : $this->server->get(strtoupper($key));
    }

    public function header(string $key) {
        return $this->server->get(strtoupper("http_{$key}"));
    }

    // ==========================================================================
    // =========================== MAKE HTTP REQUEST  ===========================
    // ==========================================================================

    public function set($parameter, $value = null) {
        if (is_array($parameter)) {
            return $this->parameters = $parameter;
        }
        return $this->parameters[$parameter] = $value;
    }

    public function get(string $url, Header $header = null) {
        return $this->request(static::GET, $url, $header);
    }

    public function post(string $url, Header $header = null, $body = null) {
        return $this->request(static::POST, $url, $header, $body);
    }

    public function put(string $url, Header $header = null, $body = null) {
        return $this->request(static::PUT, $url, $header, $body);
    }

    public function patch(string $url, Header $header = null, $body = null) {
        return $this->request(static::PATCH, $url, $header, $body);
    }

    public function delete(string $url, Header $header = null, $body = null) {
        return $this->request(static::DELETE, $url, $header, $body);
    }
 
    // ==========================================================================
    // ============================= INTERNAL METHODS ===========================
    // ==========================================================================

    private function request(string $method, string $url, Header $header = null, Body $body = null) {
        return $this->setUrl($this->buildUrl($url))
            ->setCustomRequest($method)
            ->setHeader($header)
            ->setFields($header, $body)
            ->setDefaultOptions()
            ->send($header)
            ->getResponse();
    }
    
    private function buildUrl(string $url) {
        $parameters = $this->parameters;
        foreach ($parameters as $key => $value) {
            $url = str_replace("{{$key}}", $value, $url, $count);
            if ($count > 0) unset($parameters[$key]);
        }
        $query = $parameters ? '?' . http_build_query($parameters) : '';
        return $this->baseUrl . $url . $query;
    }
    
    private function send(Header $header = null) {
        $this->open()->exec($header)->close();
        return $this;
    }

    private function open() {
        $this->curl = curl_init();
        return $this;
    }

    private function exec(Header $header = null) {
        curl_setopt_array($this->curl, $this->options);

        $response = curl_exec($this->curl);
        $info     = curl_getinfo($this->curl);
        
        if ($code = curl_errno($this->curl)) { 
            throw new \Astronphp\Http\Exception\ResponseException(curl_error($this->curl), $code);
        }
        
        $this->response = new Response();

        $accept = $header ? $header->get(Header::ACCEPT) : self::JSON;
        switch ($accept) {
            case self::JSON:
                $decoded = json_decode($response, true);
                $this->response->setData($decoded ?? []);
                break;
            case self::URL_ENCODED:
                parse_str($response, $decoded);
                $this->response->setData($decoded ?? []);
                break;
            case self::FORM_DATA:
                $decoded = urldecode($response);
                $this->response->setData($decoded ?? []);
                break;
            case self::HTML:
                $this->response->set('html', $response);
                break;
            case self::TEXT:
                $this->response->set('text', $response);
                break;
        }

        $this->response->setInfo($info);
        return $this;
    }

    private function close() {
        curl_close($this->curl);
        return $this;
    }

    // ==========================================================================
    // =========================== GETTERS AND SETTERS ==========================
    // ==========================================================================

    public function setBaseUrl(string $baseUrl): self {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function setUrl(string $url): self {
        $this->options[CURLOPT_URL] = $url;
        return $this;
    }

    public function setHeader(Header $header = null): self {
        if ($header) {
            $this->options[CURLOPT_HTTPHEADER] = $header->toArray();
        }
        return $this;
    }

    public function setFields(Header $header = null, Body $body = null): self {
        $contentType = $header ? $header->get(Header::CONTENT_TYPE) : self::JSON;
        if ($body) {
            switch ($contentType) {
                case self::JSON:
                    $this->options[CURLOPT_POSTFIELDS] = $body->toJson();
                    break;
                case self::URL_ENCODED:
                    $this->options[CURLOPT_POSTFIELDS] = $body->toUrlEncoded();
                    break;
                case self::FORM_DATA:
                    $this->options[CURLOPT_POSTFIELDS] = $body->toFormData();
                    break;
                case self::HTML:
                    $this->options[CURLOPT_POSTFIELDS] = $body->get('html');
                    break;
                case self::TEXT:
                    $this->options[CURLOPT_POSTFIELDS] = $body->get('text');
                    break;
            }
        }
        return $this;
    }

    public function setCustomRequest(string $method) : self {
        $this->options[CURLOPT_CUSTOMREQUEST] = $method;
        return $this;
    }

    private function setDefaultOptions(): self {
        $this->options[CURLOPT_RETURNTRANSFER] = true;
        $this->options[CURLOPT_FRESH_CONNECT]  = true;
        $this->options[CURLOPT_CONNECTTIMEOUT] = 10;
        $this->options[CURLOPT_TIMEOUT]        = 40;
        $this->options[CURLOPT_ENCODING]       = '';
        return $this;
    }

    public function getResponse(): Response {
        return $this->response;
    }
}