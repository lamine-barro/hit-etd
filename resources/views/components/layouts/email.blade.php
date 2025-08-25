<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Hub Ivoire Tech' }}</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body, table, td, a { 
            -webkit-text-size-adjust: 100%; 
            -ms-text-size-adjust: 100%; 
        }
        
        table, td { 
            mso-table-lspace: 0pt; 
            mso-table-rspace: 0pt; 
        }
        
        img { 
            -ms-interpolation-mode: bicubic; 
            border: 0; 
            outline: none; 
            text-decoration: none; 
        }
        
        /* Main styles */
        body {
            margin: 0 !important;
            padding: 0 !important;
            background-color: #f5f5f5 !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
            width: 100% !important;
            height: 100% !important;
        }
        
        /* Container */
        .email-wrapper {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Main content box */
        .email-body {
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            overflow: hidden;
        }
        
        /* Header */
        .email-header {
            background-color: #FF6B35;
            padding: 30px 40px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 15px;
        }
        
        .logo-img {
            height: 50px;
            width: auto;
            display: inline-block;
        }
        
        .header-title {
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0 5px 0;
        }
        
        .header-tagline {
            color: #ffffff;
            font-size: 14px;
            opacity: 0.95;
        }
        
        /* Content area */
        .email-inner {
            padding: 40px;
        }
        
        /* Typography */
        h1 {
            margin: 0 0 24px 0;
            font-size: 24px;
            font-weight: 600;
            color: #333333;
            line-height: 1.3;
        }
        
        h2 {
            margin: 0 0 20px 0;
            font-size: 20px;
            font-weight: 600;
            color: #333333;
            line-height: 1.3;
        }
        
        h3 {
            margin: 0 0 16px 0;
            font-size: 18px;
            font-weight: 600;
            color: #333333;
            line-height: 1.3;
        }
        
        p {
            margin: 0 0 16px 0;
            font-size: 16px;
            line-height: 1.6;
            color: #555555;
        }
        
        /* Button */
        .btn {
            display: inline-block;
            padding: 12px 28px;
            background-color: #FF6B35;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            margin: 24px 0;
            text-align: center;
        }
        
        .btn:hover {
            background-color: #e55a2b;
        }
        
        /* Alert boxes */
        .alert {
            padding: 16px 20px;
            border-radius: 6px;
            margin: 24px 0;
            border-left: 4px solid;
        }
        
        .alert-info {
            background-color: #f0f8ff;
            border-left-color: #0066cc;
            color: #004085;
        }
        
        .alert-success {
            background-color: #f0fff4;
            border-left-color: #28a745;
            color: #155724;
        }
        
        .alert-warning {
            background-color: #fffaf0;
            border-left-color: #ff9800;
            color: #856404;
        }
        
        .alert-danger {
            background-color: #fff5f5;
            border-left-color: #dc3545;
            color: #721c24;
        }
        
        /* Code block */
        .code-box {
            background-color: #f8f8f8;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 24px;
            margin: 24px 0;
            text-align: center;
        }
        
        .code {
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 6px;
            color: #333333;
            font-family: 'Courier New', monospace;
        }
        
        /* Info box */
        .info-box {
            background-color: #f8f8f8;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 20px;
            margin: 24px 0;
        }
        
        .info-box h4 {
            margin: 0 0 12px 0;
            font-size: 16px;
            font-weight: 600;
            color: #333333;
        }
        
        .info-box p {
            margin: 0 0 8px 0;
            font-size: 14px;
            color: #555555;
        }
        
        .info-box p:last-child {
            margin-bottom: 0;
        }
        
        /* List */
        ul, ol {
            margin: 0 0 16px 0;
            padding-left: 24px;
            color: #555555;
        }
        
        li {
            margin-bottom: 8px;
            line-height: 1.6;
        }
        
        /* Divider */
        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 32px 0;
        }
        
        /* Footer */
        .email-footer {
            padding: 32px 40px;
            background-color: #f8f8f8;
            border-top: 1px solid #e0e0e0;
            text-align: center;
        }
        
        .footer-links {
            margin-bottom: 20px;
        }
        
        .footer-links a {
            color: #FF6B35;
            text-decoration: none;
            font-size: 14px;
            margin: 0 12px;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        
        .footer-text {
            font-size: 14px;
            color: #888888;
            line-height: 1.5;
        }
        
        .footer-text strong {
            color: #555555;
            font-weight: 600;
        }
        
        /* Responsive */
        @media screen and (max-width: 600px) {
            .email-content {
                padding: 10px !important;
            }
            
            .email-inner {
                padding: 24px !important;
            }
            
            .email-header {
                padding: 24px !important;
            }
            
            .email-footer {
                padding: 24px !important;
            }
            
            h1 {
                font-size: 22px !important;
            }
            
            h2 {
                font-size: 18px !important;
            }
            
            .code {
                font-size: 24px !important;
                letter-spacing: 4px !important;
            }
            
            .btn {
                display: block !important;
                width: 100% !important;
            }
            
            .logo-img {
                height: 40px !important;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="email-body">
                <!-- Header -->
                <div class="email-header">
                    <div class="logo-container">
                        <img src="http://127.0.0.1:8000/logo_hit.png" alt="Hub Ivoire Tech" class="logo-img">
                    </div>
                    <div class="header-title">Hub Ivoire Tech</div>
                    <div class="header-tagline">Le premier hub d'innovation de Côte d'Ivoire</div>
                </div>
                
                <!-- Content -->
                <div class="email-inner">
                    {{ $slot }}
                </div>
                
                <!-- Footer -->
                <div class="email-footer">
                    <div class="footer-links">
                        <a href="{{ config('app.url') }}">Site web</a>
                        <a href="{{ config('app.url') }}/contact">Contact</a>
                        <a href="{{ config('app.url') }}/privacy">Confidentialité</a>
                    </div>
                    
                    <div class="footer-text">
                        <strong>Hub Ivoire Tech</strong><br>
                        Tour POSTEL 2001 - Plateau, Abidjan<br>
                        Côte d'Ivoire<br><br>
                        
                        <small>© {{ date('Y') }} Hub Ivoire Tech. Tous droits réservés.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>