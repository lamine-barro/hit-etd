<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Hub Ivoire Tech' }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            margin: 0;
            padding: 20px;
            background-color: #f7fafc;
        }
        .email-container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .content h1 {
            color: #2d3748;
            font-size: 20px;
            font-weight: 600;
            margin: 0 0 20px 0;
        }
        .content p {
            margin: 16px 0;
            font-size: 16px;
            color: #4a5568;
        }
        .otp-code {
            background-color: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 4px;
            color: #2d3748;
            font-family: 'Courier New', monospace;
        }
        .warning {
            background-color: #fef5e7;
            border: 1px solid #f6ad55;
            border-radius: 6px;
            padding: 16px;
            margin: 20px 0;
            color: #744210;
            font-size: 14px;
        }
        .footer {
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            background-color: #f7fafc;
        }
        .footer p {
            margin: 5px 0;
            font-size: 12px;
            color: #718096;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="content">
            {{ $slot }}
        </div>
        <div class="footer">
            <p><strong>Hub Ivoire Tech</strong></p>
            <p>Tour POSTEL 2001 - Plateau, Abidjan</p>
            <p>&copy; {{ date('Y') }} Hub Ivoire Tech</p>
        </div>
    </div>
</body>
</html> 