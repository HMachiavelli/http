<?php

namespace Astronphp\Http;

class Header {

    //Authentication
    const WWW_AUTHENTICATE = 'WWW-Authenticate';
    const AUTHORIZATION = 'Authorization';
    const PROXY_AUTHENTICATE = 'Proxy-Authenticate';
    const PROXY_AUTHORIZATION = 'Proxy-Authorization';

    //Caching
    const AGE = 'Age';
    const CACHE_CONTROL = 'Cache-Control';
    const CLEAR_SITE_DATA = 'Clear-Site-Data';
    const EXPIRES = 'Expires';
    const PRAGMA = 'Pragma';
    const WARNING = 'Warning';

    //Client hints
    const ACCEPT_CH  = 'Accept-CH ';
    const ACCEPT_CH_LIFETIME  = 'Accept-CH-Lifetime ';
    const EARLY_DATA  = 'Early-Data ';
    const CONTENT_DPR  = 'Content-DPR ';
    const DPR  = 'DPR ';
    const SAVE_DATA  = 'Save-Data ';
    const VIEWPORT_WIDTH  = 'Viewport-Width ';
    const WIDTH  = 'Width ';

    //Conditionals
    const LAST_MODIFIED = 'Last-Modified';
    const ETAG = 'ETag';
    const IF_MATCH = 'If-Match';
    const IF_NONE_MATCH = 'If-None-Match';
    const IF_MODIFIED_SINCE = 'If-Modified-Since';
    const IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';
    const VARY = 'Vary';

    //Connection management
    const CONNECTION = 'Connection';
    const KEEP_ALIVE = 'Keep-Alive';

    //Content negotiation
    const ACCEPT = 'Accept';
    const ACCEPT_CHARSET = 'Accept-Charset';
    const ACCEPT_ENCODING = 'Accept-Encoding';
    const ACCEPT_LANGUAGE = 'Accept-Language';

    //Controls
    const EXPECT = 'Expect';
    const MAX_FORWARDS = 'Max-Forwards';

    //Cookies
    const COOKIE = 'Cookie';
    const SET_COOKIE = 'Set-Cookie';

    //CORS
    const ACCESS_CONTROL_ALLOW_ORIGIN = 'Access-Control-Allow-Origin';
    const ACCESS_CONTROL_ALLOW_CREDENTIALS = 'Access-Control-Allow-Credentials';
    const ACCESS_CONTROL_ALLOW_HEADERS = 'Access-Control-Allow-Headers';
    const ACCESS_CONTROL_ALLOW_METHODS = 'Access-Control-Allow-Methods';
    const ACCESS_CONTROL_EXPOSE_HEADERS = 'Access-Control-Expose-Headers';
    const ACCESS_CONTROL_MAX_AGE = 'Access-Control-Max-Age';
    const ACCESS_CONTROL_REQUEST_HEADERS = 'Access-Control-Request-Headers';
    const ACCESS_CONTROL_REQUEST_METHOD = 'Access-Control-Request-Method';
    const ORIGIN = 'Origin';
    const TIMING_ALLOW_ORIGIN = 'Timing-Allow-Origin';
    const X_PERMITTED_CROSS_DOMAIN_POLICIES = 'X-Permitted-Cross-Domain-Policies';

    //Do Not Track
    const DNT = 'DNT';
    const TK = 'Tk';

    //Downloads
    const CONTENT_DISPOSITION = 'Content-Disposition';

    //Message body information
    const CONTENT_LENGTH = 'Content-Length';
    const CONTENT_TYPE = 'Content-Type';
    const CONTENT_ENCODING = 'Content-Encoding';
    const CONTENT_LANGUAGE = 'Content-Language';
    const CONTENT_LOCATION = 'Content-Location';

    //Proxies
    const FORWARDED = 'Forwarded';
    const X_FORWARDED_FOR  = 'X-Forwarded-For ';
    const X_FORWARDED_HOST  = 'X-Forwarded-Host ';
    const X_FORWARDED_PROTO  = 'X-Forwarded-Proto ';
    const VIA = 'Via';

    //Redirects
    const LOCATION = 'Location';

    //Request context
    const FROM = 'From';
    const HOST = 'Host';
    const REFERER = 'Referer';
    const REFERRER_POLICY = 'Referrer-Policy';
    const USER_AGENT = 'User-Agent';

    //Response context
    const ALLOW = 'Allow';
    const SERVER = 'Server';

    //Range requests
    const ACCEPT_RANGES = 'Accept-Ranges';
    const RANGE = 'Range';
    const IF_RANGE = 'If-Range';
    const CONTENT_RANGE = 'Content-Range';

    //Security
    const CROSS_ORIGIN_RESOURCE_POLICY = 'Cross-Origin-Resource-Policy';
    const CONTENT_SECURITY_POLICY = 'Content-Security-Policy';
    const CONTENT_SECURITY_POLICY_REPORT_ONLY = 'Content-Security-Policy-Report-Only';
    const EXPECT_CT = 'Expect-CT';
    const FEATURE_POLICY = 'Feature-Policy';
    const PUBLIC_KEY_PINS = 'Public-Key-Pins';
    const PUBLIC_KEY_PINS_REPORT_ONLY = 'Public-Key-Pins-Report-Only';
    const STRICT_TRANSPORT_SECURITY = 'Strict-Transport-Security';
    const UPGRADE_INSECURE_REQUESTS = 'Upgrade-Insecure-Requests';
    const X_CONTENT_TYPE_OPTIONS = 'X-Content-Type-Options';
    const X_DOWNLOAD_OPTIONS = 'X-Download-Options';
    const X_FRAME_OPTIONS = 'X-Frame-Options';
    const X_POWERED_BY = 'X-Powered-By';
    const X_XSS_PROTECTION = 'X-XSS-Protection';

    //Server-sent events
    const LAST_EVENT_ID = 'Last-Event-ID';
    const NEL  = 'NEL ';
    const PING_FROM = 'Ping-From';
    const PING_TO = 'Ping-To';
    const REPORT_TO = 'Report-To';

    //Transfer coding
    const TRANSFER_ENCODING = 'Transfer-Encoding';
    const TE = 'TE';
    const TRAILER = 'Trailer';

    //WebSockets
    const SEC_WEBSOCKET_KEY = 'Sec-WebSocket-Key';
    const SEC_WEBSOCKET_EXTENSIONS = 'Sec-WebSocket-Extensions';
    const SEC_WEBSOCKET_ACCEPT = 'Sec-WebSocket-Accept';
    const SEC_WEBSOCKET_PROTOCOL = 'Sec-WebSocket-Protocol';
    const SEC_WEBSOCKET_VERSION = 'Sec-WebSocket-Version';

    //Other
    const ACCEPT_PUSH_POLICY  = 'Accept-Push-Policy ';
    const ACCEPT_SIGNATURE  = 'Accept-Signature ';
    const ALT_SVC = 'Alt-Svc';
    const DATE = 'Date';
    const LARGE_ALLOCATION = 'Large-Allocation';
    const LINK = 'Link';
    const PUSH_POLICY  = 'Push-Policy ';
    const RETRY_AFTER = 'Retry-After';
    const SIGNATURE  = 'Signature ';
    const SIGNED_HEADERS  = 'Signed-Headers ';
    const SERVER_TIMING = 'Server-Timing';
    const SOURCEMAP = 'SourceMap';
    const UPGRADE = 'Upgrade';
    const X_DNS_PREFETCH_CONTROL = 'X-DNS-Prefetch-Control';

    private $content;

    public function __construct() {
        $this->content = new \Astronphp\Collection\Collection();
    }

    public function set($key, $value) {
        header("{$key}: $value");
    }

    public function add($key, $value) {
        $this->content->set($key, $value);
    }

    public function toArray() {
        $return = [];
        $this->content->each(function($key, $value) use(&$return) {
            $return[] = "{$key}: {$value}";
        });
        return $return;
    }

    public function dump($key = null) {
        @var_dump($key ? $this->content->{$key} : $this->content);
    }
}