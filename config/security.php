<?php

$defaultContentSecurityPolicy = "default-src 'self'; "
    ."script-src 'self' 'unsafe-inline' http://localhost:*; "
    ."style-src 'self' 'unsafe-inline' https://fonts.bunny.net https://fonts.googleapis.com http://localhost:*; "
    ."font-src 'self' data: https://fonts.bunny.net https://fonts.gstatic.com; "
    ."img-src 'self' data: https://ui-avatars.com; "
    ."connect-src 'self' ws://localhost:* http://localhost:*; "
    ."base-uri 'self'; form-action 'self'; frame-ancestors 'none'; object-src 'none'";

return [
    'content_security_policy' => env('SECURITY_CSP') ?: $defaultContentSecurityPolicy,
];
