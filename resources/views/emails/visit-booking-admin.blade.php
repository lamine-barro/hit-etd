<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande de visite</title>
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
        .alert-box {
            background: linear-gradient(135deg, #FFF3E0 0%, #FFE0B2 100%);
            border: 2px solid #FFB74D;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }
        .alert-box .icon {
            font-size: 32px;
            margin-bottom: 12px;
            display: block;
        }
        .alert-box h3 {
            margin: 0 0 8px 0;
            color: #E65100;
            font-size: 18px;
        }
        .alert-box p {
            margin: 0;
            color: #BF360C;
            font-size: 14px;
        }
        .visitor-info {
            background: #e3f2fd;
            border: 2px solid #bbdefb;
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
        }
        .visitor-info h3 {
            margin: 0 0 20px 0;
            color: #1976d2;
            font-size: 18px;
            text-align: center;
            border-bottom: 2px solid #bbdefb;
            padding-bottom: 10px;
        }
        .visit-details {
            background: #fff3e0;
            border: 2px solid #ffcc02;
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
        }
        .visit-details h3 {
            margin: 0 0 20px 0;
            color: #ff8f00;
            font-size: 18px;
            text-align: center;
            border-bottom: 2px solid #ffcc02;
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
        .message-box {
            background: #f8f9fa;
            border-left: 4px solid #FF6B00;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            font-style: italic;
        }
        .message-box h4 {
            margin: 0 0 10px 0;
            color: #FF6B00;
            font-size: 16px;
        }
        .action-box {
            background: linear-gradient(135deg, #FFF8E1 0%, #FFECB3 100%);
            border: 2px solid #FFCC02;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }
        .action-box h3 {
            margin: 0 0 15px 0;
            color: #FF8F00;
        }
        .action-button {
            display: inline-block;
            background: #FF6B00;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 10px;
            transition: background-color 0.3s;
        }
        .action-button:hover {
            background: #E55100;
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
                <h1 style="color:#ffffff;">🔔 Nouvelle Demande de Visite</h1>
                <p>Administration - Hub Ivoire Tech</p>
            </div>

            <div class="content" style="padding:40px 40px; text-align:left;">
                <div class="greeting">
                    <p><strong>Équipe administrative,</strong></p>
                    <p>Une nouvelle demande de visite du campus a été soumise et nécessite votre attention.</p>
                </div>

                <div class="alert-box">
                    <span class="icon">⚡</span>
                    <h3>Action requise !</h3>
                    <p>Nouvelle demande à traiter</p>
                </div>

                <div class="visitor-info">
                    <h3>👤 Informations du visiteur</h3>
                    
                    <div class="detail-row">
                        <span class="label">Nom complet</span>
                        <span class="value">{{ $name }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="label">Email</span>
                        <span class="value">{{ $email }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="label">Téléphone</span>
                        <span class="value">{{ $phone }}</span>
                    </div>
                </div>

                <div class="visit-details">
                    <h3>📅 Détails de la visite</h3>
                    
                    <div class="detail-row">
                        <span class="label">Date souhaitée</span>
                        <span class="value">{{ $date }}</span>
                    </div>
                    
                    <div class="detail-row">
                        <span class="label">Heure souhaitée</span>
                        <span class="value">{{ $time ?? 'Non spécifiée' }}</span>
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

                @if($message)
                <div class="message-box">
                    <h4>💬 Message du visiteur :</h4>
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="action-box">
                    <h3>🎯 Actions à effectuer</h3>
                    <p>Veuillez traiter cette demande dans les plus brefs délais :</p>
                    <ul style="text-align: left; max-width: 400px; margin: 15px auto;">
                        <li>Vérifier la disponibilité du créneau</li>
                        <li>Confirmer ou proposer une alternative</li>
                        <li>Préparer la visite personnalisée</li>
                        <li>Contacter le visiteur sous 3 jours ouvrés</li>
                    </ul>
                </div>
            </div>

            <div class="footer" style="padding:30px 40px; background:#2C2C2C; color:white; text-align:center;">
                <h4>Hub Ivoire Tech - Administration</h4>
                
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
                    Email automatique - Système de gestion des visites<br>
                    Hub Ivoire Tech - Campus Management
                </p>
            </div>
        </div>
    </div>
</body>
</html>
