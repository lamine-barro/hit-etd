# Instructions de Déploiement - HubIvoireTech

## 📋 Prérequis
- Serveur VPS Ubuntu 24.04
- Accès SSH root
- Domaine configuré (hubivoiretech.ci)

## 🚀 Étapes de Déploiement

### 1. Connexion au serveur
```bash
ssh root@180.149.198.147
# Mot de passe: iEGEx5gy2BA
```

### 2. Télécharger et exécuter le script de déploiement

Option A - Copier le script directement:
```bash
# Créer le fichier sur le serveur
nano /root/deploy.sh

# Copier le contenu du fichier deploy-vps.sh
# Sauvegarder (Ctrl+X, puis Y, puis Enter)

# Rendre le script exécutable
chmod +x /root/deploy.sh

# Exécuter le script
./deploy.sh
```

Option B - Transférer depuis votre machine locale:
```bash
# Depuis votre machine locale
scp deploy-vps.sh root@180.149.198.147:/root/deploy.sh

# Se connecter au serveur
ssh root@180.149.198.147

# Rendre exécutable et lancer
chmod +x /root/deploy.sh
./deploy.sh
```

### 3. Mise à jour DNS Cloudflare

⚠️ **IMPORTANT**: Avant de lancer le script, mettez à jour les DNS dans Cloudflare:

1. Connectez-vous à [Cloudflare Dashboard](https://dash.cloudflare.com)
2. Sélectionnez le domaine `hubivoiretech.ci`
3. Allez dans **DNS** > **Records**
4. Modifiez ces enregistrements:

| Type | Name | Content (Actuel) | Content (Nouveau) | Proxy |
|------|------|-----------------|-------------------|--------|
| A | hubivoiretech.ci | 185.158.133.1 | **180.149.198.147** | DNS only |
| A | www | 185.158.133.1 | **180.149.198.147** | DNS only |

**Note**: Désactivez le proxy Cloudflare (DNS only) pendant la configuration initiale.

### 4. Post-Installation

Une fois le script terminé:

1. **Vérifier le site**
   - Attendez 5-10 minutes pour la propagation DNS
   - Visitez https://hubivoiretech.ci

2. **Sauvegarder les informations**
   - Le script affichera les informations de la base de données
   - Sauvegardez-les dans un endroit sécurisé

3. **Activer le proxy Cloudflare** (optionnel)
   - Une fois le site fonctionnel
   - Retournez dans Cloudflare DNS
   - Activez le proxy (icône cloud orange) pour les enregistrements A

## 🔧 Commandes Utiles

### Logs et Débogage
```bash
# Logs Nginx
tail -f /var/log/nginx/error.log

# Logs Laravel
tail -f /var/www/hubivoiretech/storage/logs/laravel.log

# Logs des workers
tail -f /var/www/hubivoiretech/storage/logs/worker.log

# Status des services
systemctl status nginx
systemctl status php8.2-fpm
systemctl status postgresql
systemctl status redis
supervisorctl status
```

### Maintenance
```bash
cd /var/www/hubivoiretech

# Mettre à jour le code
git pull origin main
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Relancer les migrations
php artisan migrate --force

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Recréer les caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Redémarrer les workers
supervisorctl restart hubivoiretech-worker:*
```

### Backup Base de Données
```bash
# Créer un backup
pg_dump -U hubivoiretech_user hubivoiretech_db > backup_$(date +%Y%m%d).sql

# Restaurer un backup
psql -U hubivoiretech_user hubivoiretech_db < backup_20250827.sql
```

## 🔐 Sécurité

### Après le déploiement:

1. **Changer le mot de passe root SSH**
```bash
passwd
```

2. **Créer un utilisateur non-root** (recommandé)
```bash
adduser deploy
usermod -aG sudo deploy
```

3. **Configurer les clés SSH** (optionnel mais recommandé)
```bash
# Sur votre machine locale
ssh-keygen -t rsa -b 4096
ssh-copy-id root@180.149.198.147
```

4. **Désactiver l'accès root SSH** (après avoir créé un autre utilisateur)
```bash
nano /etc/ssh/sshd_config
# Changer: PermitRootLogin no
systemctl restart sshd
```

## ⚠️ Troubleshooting

### Problème SSL/HTTPS
Si Certbot échoue:
```bash
# Vérifier que les DNS pointent bien vers le serveur
dig hubivoiretech.ci
dig www.hubivoiretech.ci

# Réessayer manuellement
certbot --nginx -d hubivoiretech.ci -d www.hubivoiretech.ci
```

### Erreur 502 Bad Gateway
```bash
# Vérifier PHP-FPM
systemctl restart php8.2-fpm
systemctl status php8.2-fpm

# Vérifier les permissions
chown -R www-data:www-data /var/www/hubivoiretech
```

### Base de données inaccessible
```bash
# Vérifier PostgreSQL
systemctl status postgresql
sudo -u postgres psql

# Vérifier la connexion
psql -U hubivoiretech_user -d hubivoiretech_db -h localhost
```

## 📞 Support

En cas de problème:
1. Consultez les logs (voir section Logs et Débogage)
2. Vérifiez les services (nginx, php-fpm, postgresql, redis)
3. Assurez-vous que les DNS sont correctement configurés