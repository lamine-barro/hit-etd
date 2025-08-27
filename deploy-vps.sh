#!/bin/bash

# Script de déploiement pour HubIvoireTech
# Serveur: 180.149.198.147
# Domaine: hubivoiretech.ci

set -e  # Arrêter en cas d'erreur

echo "========================================="
echo "   Déploiement de HubIvoireTech"
echo "========================================="

# Variables de configuration
SERVER_IP="180.149.198.147"
SERVER_USER="root"
DOMAIN="hubivoiretech.ci"
DB_NAME="hubivoiretech_db"
DB_USER="hubivoiretech_user"
DB_PASSWORD=$(openssl rand -base64 32)
APP_PATH="/var/www/hubivoiretech"

# Étape 1: Mise à jour du système
echo ""
echo "📦 Étape 1: Mise à jour du système..."
apt update && apt upgrade -y

# Étape 2: Installation des prérequis
echo ""
echo "📦 Étape 2: Installation des prérequis..."
apt install -y software-properties-common curl git unzip

# Installation PHP 8.2
echo "Installing PHP 8.2..."
add-apt-repository ppa:ondrej/php -y
apt update
apt install -y php8.2-fpm php8.2-cli php8.2-common php8.2-pgsql php8.2-mbstring \
    php8.2-xml php8.2-curl php8.2-zip php8.2-gd php8.2-bcmath php8.2-intl php8.2-redis

# Installation Composer
echo "Installing Composer..."
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

# Installation Node.js 20
echo "Installing Node.js..."
curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt install -y nodejs

# Installation PostgreSQL
echo "Installing PostgreSQL..."
apt install -y postgresql postgresql-contrib

# Installation Nginx
echo "Installing Nginx..."
apt install -y nginx

# Installation Redis
echo "Installing Redis..."
apt install -y redis-server

# Installation Supervisor
echo "Installing Supervisor..."
apt install -y supervisor

# Étape 3: Configuration PostgreSQL
echo ""
echo "🗄️ Étape 3: Configuration PostgreSQL..."
sudo -u postgres psql <<EOF
CREATE USER $DB_USER WITH PASSWORD '$DB_PASSWORD';
CREATE DATABASE $DB_NAME OWNER $DB_USER;
GRANT ALL PRIVILEGES ON DATABASE $DB_NAME TO $DB_USER;
\q
EOF

# Étape 4: Cloner le projet
echo ""
echo "📂 Étape 4: Clonage du projet..."
if [ -d "$APP_PATH" ]; then
    rm -rf $APP_PATH
fi
git clone https://github.com/lamine-barro/hit-etd.git $APP_PATH
cd $APP_PATH

# Étape 5: Configuration du fichier .env
echo ""
echo "⚙️ Étape 5: Configuration du fichier .env..."
cp .env.example .env

cat > .env <<EOF
APP_NAME=HubIvoireTech
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://$DOMAIN

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=$DB_NAME
DB_USERNAME=$DB_USER
DB_PASSWORD=$DB_PASSWORD

BROADCAST_DRIVER=log
CACHE_DRIVER=redis
FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=resend
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=noreply@hubivoiretech.ci
MAIL_FROM_NAME="HubIvoireTech"

RESEND_KEY=re_2KNEy36B_7W54edKUsuEgenn8EP8rQ7uG

MAPBOX_ACCESS_TOKEN=pk.eyJ1IjoibGFtaW5lYmFycm8iLCJhIjoiY20zZHMzOW9zMDc5dzJsczgwdWVoZ2NqYyJ9.3baMsQ3_mpKlnBdHCeu0kg

OPENAI_API_KEY=sk-proj-7D1V9xcN0N3IOfAan1GwMVR7pYcNFcNuHjosfgYKtmTBmjUS4I_SlwmyFH-

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="\${APP_NAME}"
VITE_PUSHER_APP_KEY="\${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="\${PUSHER_HOST}"
VITE_PUSHER_PORT="\${PUSHER_PORT}"
VITE_PUSHER_SCHEME="\${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="\${PUSHER_APP_CLUSTER}"
EOF

# Étape 6: Installation des dépendances
echo ""
echo "📦 Étape 6: Installation des dépendances..."
composer install --optimize-autoloader --no-dev
npm install

# Générer la clé d'application
php artisan key:generate

# Étape 7: Migrations et seeders
echo ""
echo "🗄️ Étape 7: Exécution des migrations..."
php artisan migrate --force
php artisan db:seed --force

# Étape 8: Compilation des assets
echo ""
echo "🎨 Étape 8: Compilation des assets..."
npm run build

# Étape 9: Configuration Nginx
echo ""
echo "🌐 Étape 9: Configuration Nginx..."
cat > /etc/nginx/sites-available/$DOMAIN <<EOF
server {
    listen 80;
    listen [::]:80;
    server_name $DOMAIN www.$DOMAIN;
    root $APP_PATH/public;

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    client_max_body_size 100M;
}
EOF

# Activer le site
ln -sf /etc/nginx/sites-available/$DOMAIN /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# Test de la configuration Nginx
nginx -t
systemctl reload nginx

# Étape 10: Installation SSL avec Certbot
echo ""
echo "🔒 Étape 10: Configuration SSL..."
apt install -y certbot python3-certbot-nginx
certbot --nginx -d $DOMAIN -d www.$DOMAIN --non-interactive --agree-tos --email noreply@$DOMAIN --redirect

# Étape 11: Permissions
echo ""
echo "🔐 Étape 11: Configuration des permissions..."
chown -R www-data:www-data $APP_PATH
chmod -R 755 $APP_PATH
chmod -R 775 $APP_PATH/storage
chmod -R 775 $APP_PATH/bootstrap/cache

# Étape 12: Configuration Supervisor pour les queues
echo ""
echo "⚙️ Étape 12: Configuration Supervisor..."
cat > /etc/supervisor/conf.d/hubivoiretech-worker.conf <<EOF
[program:hubivoiretech-worker]
process_name=%(program_name)s_%(process_num)02d
command=php $APP_PATH/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=$APP_PATH/storage/logs/worker.log
stopwaitsecs=3600
EOF

supervisorctl reread
supervisorctl update
supervisorctl start hubivoiretech-worker:*

# Étape 13: Optimisation Laravel
echo ""
echo "⚡ Étape 13: Optimisation Laravel..."
cd $APP_PATH
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan optimize

# Étape 14: Configuration Cron pour Laravel Scheduler
echo ""
echo "⏰ Étape 14: Configuration du scheduler..."
(crontab -l 2>/dev/null; echo "* * * * * cd $APP_PATH && php artisan schedule:run >> /dev/null 2>&1") | crontab -

# Configuration du firewall
echo ""
echo "🔥 Configuration du firewall..."
ufw allow 22
ufw allow 80
ufw allow 443
ufw --force enable

echo ""
echo "========================================="
echo "   ✅ Déploiement terminé avec succès!"
echo "========================================="
echo ""
echo "📝 Informations importantes:"
echo "   URL: https://$DOMAIN"
echo "   Chemin: $APP_PATH"
echo "   Base de données: $DB_NAME"
echo "   Utilisateur DB: $DB_USER"
echo "   Mot de passe DB: $DB_PASSWORD"
echo ""
echo "⚠️  IMPORTANT: Sauvegardez ces informations!"
echo ""
echo "📋 Prochaines étapes:"
echo "   1. Mettre à jour les DNS Cloudflare:"
echo "      - Pointer $DOMAIN vers $SERVER_IP"
echo "      - Pointer www.$DOMAIN vers $SERVER_IP"
echo "   2. Vérifier le site: https://$DOMAIN"
echo ""