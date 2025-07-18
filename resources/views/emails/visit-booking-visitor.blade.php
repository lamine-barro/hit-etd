<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de demande de visite</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .email-wrapper {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 40px;
            box-sizing: border-box;
        }
        .container {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }
        .header {
            background: linear-gradient(135deg, #FF6B00 0%, #E55100 100%);
            color: white;
            padding: 40px 40px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .header p {
            margin: 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 40px;
            text-align: left;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
        }
        .success-box {
            background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%);
            border: 2px solid #FFB74D;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }
        .success-box .icon {
            font-size: 32px;
            margin-bottom: 12px;
            display: block;
        }
        .success-box h3 {
            margin: 0 0 8px 0;
            color: #E65100;
            font-size: 18px;
        }
        .success-box p {
            margin: 0;
            color: #BF360C;
            font-size: 14px;
        }
        .details {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
        }
        .details h3 {
            margin: 0 0 20px 0;
            color: #FF6B00;
            font-size: 18px;
            text-align: center;
            border-bottom: 2px solid #FFE0B2;
            padding-bottom: 10px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 12px 0;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #495057;
            flex: 1;
        }
        .value {
            color: #6c757d;
            flex: 2;
            text-align: right;
        }
        .spaces-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: flex-end;
        }
        .space-tag {
            background: #FF6B00;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .next-steps {
            background: linear-gradient(135deg, #FFF8E1 0%, #FFECB3 100%);
            border: 2px solid #FFCC02;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
        }
        .next-steps h3 {
            margin: 0 0 15px 0;
            color: #FF8F00;
            text-align: center;
        }
        .next-steps ul {
            margin: 15px 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin: 8px 0;
            color: #E65100;
        }
        .reminder {
            background: #FFF3E0;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            border-left: 4px solid #FF6B00;
        }
        .signature {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .footer {
            background: #2C2C2C;
            color: white;
            padding: 30px 40px;
            text-align: center;
        }
        .footer h4 {
            margin: 0 0 15px 0;
            color: #FF6B00;
            font-size: 18px;
        }
        .contact-info {
            margin: 15px 0;
            font-size: 14px;
        }
        .contact-info a {
            color: #FF6B00;
            text-decoration: none;
        }
        .contact-info a:hover {
            color: #FFB74D;
        }
        .footer hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #444;
        }
        .footer-note {
            font-size: 12px;
            opacity: 0.8;
            margin: 0;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .email-wrapper {
                padding: 20px 20px;
            }
            .content {
                padding: 30px 30px;
            }
            .header {
                padding: 30px 30px;
            }
            .footer {
                padding: 30px 30px;
            }
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
            }
            .value {
                text-align: left;
                margin-top: 5px;
            }
            .spaces-list {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper" style="padding:40px 40px;">
        <div class="container">
            <div class="header" style="padding:40px 40px; background: linear-gradient(135deg, #FF6B00 0%, #E55100 100%); color: white; text-align:center;">
                <h1 style="color:#ffffff;">🏢 Demande de Visite Reçue</h1>
                <p>Hub Ivoire Tech</p>
            </div>

            <div class="content" style="padding:40px 40px; text-align:left;">
                <div class="greeting">
                    <p>Bonjour <strong>{{ $name }}</strong>,</p>
                    <p>Votre demande de visite du <strong>Hub Ivoire Tech</strong> a été reçue avec succès.</p>
                </div>

                <div class="success-box">
                    <span class="icon">📅</span>
                    <h3>Demande enregistrée !</h3>
                    <p>Nous vous contacterons sous 3 jours ouvrés</p>
                </div>

                <div class="details">
                    <h3>📋 Récapitulatif de votre demande</h3>
                    
                    <div class="detail-row">
                        <span class="label">Date souhaitée</span>
                        <span class="value">{{ $date }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="label">Heure souhaitée</span>
                        <span class="value">{{ $time }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="label">Objet de la visite</span>
                        <span class="value">{{ ucfirst($purpose) }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="label">Espaces à visiter</span>
                        <div class="spaces-list">
                            @foreach($spaces as $space)
                                <span class="space-tag">{{ ucfirst($space) }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="next-steps">
                    <h3>🔄 Prochaines étapes</h3>
                    <ul>
                        <li><strong>Confirmation</strong> - Validation de votre créneau sous 3 jours ouvrés</li>
                        <li><strong>Préparation</strong> - Organisation de votre visite personnalisée</li>
                        <li><strong>Accueil</strong> - Découverte de nos espaces et de notre écosystème</li>
                    </ul>
                    
                    <div class="reminder">
                        <strong>⏰ Rappel :</strong> Les visites nécessitent un préavis de 72h minimum et se font uniquement sur rendez-vous (mardi et jeudi).
                    </div>
                </div>

                <div class="signature">
                    <p>Merci pour votre intérêt à découvrir notre campus !</p>
                    
                    <p><strong>L'équipe Hub Ivoire Tech</strong></p>
                </div>
            </div>

            <div class="footer" style="padding:30px 40px; background:#2C2C2C; color:white; text-align:center;">
                <h4>Hub Ivoire Tech</h4>
                
                <div class="contact-info">
                    📧 <a href="mailto:hello@hubivoiretech.ci">hello@hubivoiretech.ci</a><br>
                    📞 +225 0704853848<br>
                    🌐 <a href="https://hubivoiretech.ci">hubivoiretech.ci</a>
                </div>
                
                <div class="contact-info">
                    📍 Tour POSTEL 2001, Mezzanine et 13e étage<br>
                    Plateau - Abidjan, Côte d'Ivoire
                </div>
                
                <hr>
                <p class="footer-note">
                    Email automatique - Ne pas répondre<br>
                    Pour toute question : <a href="mailto:hello@hubivoiretech.ci">hello@hubivoiretech.ci</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
