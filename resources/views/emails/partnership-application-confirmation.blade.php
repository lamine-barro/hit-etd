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
            background: linear-gradient(135deg, #6f42c1 0%, #8e44ad 100%);
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
            background: #f3e5f5;
            border: 1px solid #e1bee7;
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
        .message-box {
            background: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-style: italic;
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
            color: #6f42c1;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🤝 Demande de Partenariat Reçue</h1>
            <p>Hub Ivoire Tech</p>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $partnership->representative_name }}</strong>,</p>
            
            <p>Votre demande de partenariat avec le <strong>Hub Ivoire Tech</strong> a été reçue avec succès.</p>

            <div class="success-box">
                <div class="icon">🚀</div>
                <strong>Demande enregistrée !</strong>
                @if($partnership->id)
                    <br>Référence : <strong>#PART{{ str_pad($partnership->id, 4, '0', STR_PAD_LEFT) }}</strong>
                @endif
            </div>

            <div class="details">
                <h3 style="margin-top: 0; color: #495057;">📋 Récapitulatif</h3>
                
                <div class="detail-row">
                    <span class="label">Type de partenariat</span>
                    <span class="value">{{ $partnership->partnership_type ? ucfirst($partnership->partnership_type) : 'Non spécifié' }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Organisation</span>
                    <span class="value">{{ $partnership->organization_name }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="label">Email</span>
                    <span class="value">{{ $partnership->email }}</span>
                </div>
                
                @if($partnership->phone)
                <div class="detail-row">
                    <span class="label">Téléphone</span>
                    <span class="value">{{ $partnership->phone }}</span>
                </div>
                @endif
            </div>

            @if($partnership->message)
            <div class="message-box">
                <strong>💬 Votre message :</strong><br>
                {{ $partnership->message }}
            </div>
            @endif

            <div class="next-steps">
                <h3 style="margin-top: 0; color: #856404;">🔄 Prochaines étapes</h3>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li><strong>Analyse</strong> - Étude de votre proposition sous 7-10 jours</li>
                    <li><strong>Discussion</strong> - Échange sur les modalités de collaboration</li>
                    <li><strong>Formalisation</strong> - Signature d'un accord de partenariat</li>
                </ul>
            </div>

            <p>Nous sommes ravis de votre intérêt pour collaborer avec notre écosystème.</p>
            
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