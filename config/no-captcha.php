<?php

return [

    /* -----------------------------------------------------------------
     |  Credentials
     | -----------------------------------------------------------------
     */

    'secret'  => env('NOCAPTCHA_SECRET', 'no-captcha-secret'),
    'sitekey' => env('NOCAPTCHA_SITEKEY', 'no-captcha-sitekey'),

    /* -----------------------------------------------------------------
     |  Version
     | -----------------------------------------------------------------
     |  Supported: v3, v2
     */

    'version' => 'v3',

    /* -----------------------------------------------------------------
     |  Localization
     | -----------------------------------------------------------------
     */

    'lang' => 'jp',

    /* -----------------------------------------------------------------
     |  Skip IPs
     | -----------------------------------------------------------------
     */

    'skip-ips' => [
        // 127.0.0.1
    ],

];