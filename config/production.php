<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Production Configuration for HIT
    |--------------------------------------------------------------------------
    |
    | Configuration spécifique pour l'environnement de production
    |
    */

    'security' => [
        // Rate limiting
        'rate_limits' => [
            'chatbot' => [
                'max_attempts' => 10,
                'decay_minutes' => 1,
            ],
            'otp' => [
                'max_attempts' => 3,
                'decay_minutes' => 10,
            ],
            'login' => [
                'max_attempts' => 5,
                'decay_minutes' => 15,
            ],
        ],

        // Headers sécurisés
        'security_headers' => [
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'X-XSS-Protection' => '1; mode=block',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
        ],

        // CORS configuration
        'cors' => [
            'allowed_origins' => [
                'https://hubivoiretech.ci',
                'https://www.hubivoiretech.ci',
            ],
            'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
            'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'X-CSRF-TOKEN'],
            'max_age' => 86400,
        ],
    ],

    'performance' => [
        // Cache settings
        'cache_ttl' => [
            'default' => 3600,
            'long_term' => 86400,
            'short_term' => 300,
        ],

        // Database optimization
        'database' => [
            'slow_query_time' => 1000, // ms
            'connection_timeout' => 5,
            'max_connections' => 100,
        ],

        // Image optimization
        'images' => [
            'max_upload_size' => 5120, // KB
            'allowed_formats' => ['jpg', 'jpeg', 'png', 'webp'],
            'compression_quality' => 85,
        ],
    ],

    'monitoring' => [
        // Log retention
        'log_retention' => [
            'security' => 90, // days
            'chatbot' => 30,
            'performance' => 14,
            'general' => 7,
        ],

        // Alerts
        'alerts' => [
            'error_threshold' => 10, // errors per minute
            'response_time_threshold' => 3000, // ms
            'disk_space_threshold' => 90, // %
        ],

        // Health checks
        'health_checks' => [
            'database' => true,
            'cache' => true,
            'storage' => true,
            'external_apis' => true,
        ],
    ],

    'maintenance' => [
        // Automatic cleanup
        'cleanup' => [
            'temp_files' => 24, // hours
            'expired_sessions' => 7, // days
            'old_logs' => 30, // days
        ],

        // Backup schedule
        'backup' => [
            'database' => 'daily',
            'files' => 'weekly',
            'retention' => 30, // days
        ],
    ],

    'integrations' => [
        // OpenAI settings
        'openai' => [
            'timeout' => 10, // seconds
            'max_tokens' => 500,
            'temperature' => 0.7,
            'fallback_enabled' => true,
        ],

        // Payment settings (Paystack)
        'payments' => [
            'timeout' => 30, // seconds
            'webhook_verification' => true,
            'test_mode' => env('APP_ENV') !== 'production',
        ],
    ],

];