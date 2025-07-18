<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de candidature</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .success-box {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }
        .success-box .icon {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #495057;
        }
        .value {
            color: #6c757d;
        }
        .next-steps {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
            font-size: 14px;
            color: #6c757d;
        }
        .contact-info {
            margin: 15px 0;
        }
        .contact-info a {
            color: #28a745;
            text-decoration: none;
        }
        .specialty-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 8px;
        }
        .specialty-tag {
            background: #e9ecef;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 Candidature Expert Reçue</h1>
            <p>Hub Ivoire Tech</p>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $expert->name }}</strong>,</p>
            
            <p>Votre candidature pour devenir expert au <strong>Hub Ivoire Tech</strong> a été reçue avec succès.</p>

            <div class="success-box">
                <div class="icon">🎯</div>
                <strong>Candidature enregistrée !</strong>
                @if($expert->id)
                    <br>Référence : <strong>#EXP{{ str_pad($expert->id, 4, '0', STR_PAD_LEFT) }}</strong>
                @endif
            </div>

            <div class="details">
                <h3 style="margin-top: 0; color: #495057;">📋 Récapitulatif</h3>
                
                <div class="detail-row">
                    <span class="label">Email</span>
                    <span class="value">{{ $expert->email }}</span>
                </div>
                
                @if($expert->phone)
                <div class="detail-row">
                    <span class="label">Téléphone</span>
                    <span class="value">{{ $expert->phone }}</span>
                </div>
                @endif
                
                @if($expert->specialties && is_array($expert->specialties) && count($expert->specialties) > 0)
                <div class="detail-row">
                    <span class="label">Spécialités</span>
                    <div class="specialty-list">
                        @foreach($expert->specialties as $specialty)
                            <span class="specialty-tag">{{ ucfirst(str_replace('_', ' ', $specialty)) }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($expert->intervention_frequency)
                <div class="detail-row">
                    <span class="label">Fréquence</span>
                    <span class="value">{{ ucfirst($expert->intervention_frequency) }}</span>
                </div>
                @endif
            </div>

            <div class="next-steps">
                <h3 style="margin-top: 0; color: #856404;">🔄 Prochaines étapes</h3>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li><strong>Évaluation</strong> - Analyse de votre profil sous 5-7 jours</li>
                    <li><strong>Validation</strong> - Vérification de vos compétences</li>
                    <li><strong>Intégration</strong> - Inscription dans notre pool d'experts</li>
                </ul>
            </div>

            <p>Nous vous remercions pour votre volonté de partager votre expertise.</p>
            
            <p>Cordialement,<br>
            <strong>L'équipe Hub Ivoire Tech</strong></p>
        </div>

        <div class="footer">
            <div class="contact-info">
                <strong>Hub Ivoire Tech</strong><br>
            </div>
            
            <div class="contact-info">
                📧 <a href="mailto:hello@hubivoiretech.ci">hello@hubivoiretech.ci</a><br>
                📞 +225 0704853848<br>
                🌐 <a href="https://hubivoiretech.ci">hubivoiretech.ci</a>
            </div>
            
            <div class="contact-info">
                📍 Tour POSTEL 2001, Mezzanine et 13e étage<br>
                Plateau - Abidjan, Côte d'Ivoire
            </div>
            
            <hr style="margin: 15px 0; border: none; border-top: 1px solid #dee2e6;">
            <p style="font-size: 12px; margin: 0;">
                Email automatique - Ne pas répondre<br>
                Pour toute question : <a href="mailto:hello@hubivoiretech.ci">hello@hubivoiretech.ci</a>
            </p>
        </div>
    </div>
</body>
</html>