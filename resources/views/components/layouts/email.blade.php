<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Notification de Hub Ivoire Tech' }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        .header {
            background-color: #FF6B00;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .content h2 {
            color: #FF6B00;
        }
        .footer {
            background-color: #2C2C2C;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }
        .footer a {
            color: #FF6B00;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            background-color: #FF6B00;
            color: white !important;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <h1>{{ $title ?? 'Hub Ivoire Tech' }}</h1>
        </div>
        <div class="content">
            {{ $slot }}
        </div>
        <div class="footer">
            <p>
                <strong>Hub Ivoire Tech</strong><br>
                Tour POSTEL 2001, Mezzanine et 13e étage<br>
                Plateau - Abidjan, Côte d'Ivoire<br>
                <a href="mailto:hello@hubivoiretech.ci">hello@hubivoiretech.ci</a> | <a href="https://hubivoiretech.ci">hubivoiretech.ci</a>
            </p>
            <p>&copy; {{ date('Y') }} Hub Ivoire Tech. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html> 