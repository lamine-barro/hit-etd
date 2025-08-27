#!/bin/bash

# Script pour mettre à jour les DNS Cloudflare
# À exécuter depuis votre machine locale avec votre API Cloudflare

echo "========================================="
echo "   Mise à jour DNS Cloudflare"
echo "========================================="

# Configuration
DOMAIN="hubivoiretech.ci"
NEW_IP="180.149.198.147"

echo ""
echo "⚠️  Actions requises dans Cloudflare:"
echo ""
echo "1. Connectez-vous à Cloudflare Dashboard"
echo "2. Allez dans DNS > Records pour $DOMAIN"
echo "3. Mettez à jour les enregistrements suivants:"
echo ""
echo "   Type A - hubivoiretech.ci"
echo "   • Remplacer: 185.158.133.1"
echo "   • Par: $NEW_IP"
echo "   • Proxy: Désactivé (DNS only) pour la configuration initiale"
echo ""
echo "   Type A - www"
echo "   • Remplacer: 185.158.133.1"
echo "   • Par: $NEW_IP"
echo "   • Proxy: Désactivé (DNS only) pour la configuration initiale"
echo ""
echo "4. Après vérification que le site fonctionne, vous pourrez activer le proxy Cloudflare"
echo ""
echo "========================================="