# Production Deployment Guide — Northstar Renovation

This guide outlines the production deployment workflow, infrastructure requirements, security hardening, performance optimizations, and post-launch verification procedures for the **Northstar Renovation** WordPress website.

---

## 1. Hosting Infrastructure Requirements

| Component | Minimum Specification | Recommended Production Specification |
| :--- | :--- | :--- |
| **Operating System** | Linux (Ubuntu 22.04 LTS / Debian 12) | Ubuntu 24.04 LTS Server |
| **Web Server** | Nginx 1.20+ or Apache 2.4+ with `mod_rewrite` | Nginx 1.24+ with HTTP/2 or HTTP/3 |
| **PHP Runtime** | PHP 8.0 | PHP 8.2 or 8.3 with OPcache enabled |
| **Database** | MySQL 5.7+ / MariaDB 10.4+ | MariaDB 10.11 LTS or MySQL 8.0 |
| **Memory / CPU** | 1 vCPU / 2 GB RAM | 2+ vCPUs / 4 GB RAM with SSD storage |
| **SSL/TLS** | TLS 1.2+ Certificate | Let's Encrypt automated TLS 1.3 |

---

## 2. Server Provisioning & PHP Extensions

Ensure the following PHP modules are installed and enabled on the production server:
```bash
sudo apt update
sudo apt install -y php8.2-fpm php8.2-mysql php8.2-curl php8.2-gd php8.2-mbstring \
                    php8.2-xml php8.2-xmlrpc php8.2-zip php8.2-opcache php8.2-intl \
                    php8.2-imagick php8.2-redis
```

### Recommended PHP Configuration (`/etc/php/8.2/fpm/php.ini`):
```ini
upload_max_filesize = 64M
post_max_size = 64M
memory_limit = 256M
max_execution_time = 180
max_input_vars = 3000
expose_php = Off

; OPcache performance tuning
opcache.enable = 1
opcache.memory_consumption = 128
opcache.interned_strings_buffer = 16
opcache.max_accelerated_files = 10000
opcache.revalidate_freq = 2
opcache.fast_shutdown = 1
```

---

## 3. Directory Layout & File Permissions

Deploy the theme and companion plugin into their respective paths:
- Theme: `/var/www/html/wp-content/themes/northstar-renovation/`
- Plugin: `/var/www/html/wp-content/plugins/northstar-site-core/`

### Applying Strict Security Permissions:
```bash
# Assign web server ownership
sudo chown -R www-data:www-data /var/www/html

# Directories: 755 (read, write, execute by owner; read/execute by others)
sudo find /var/www/html -type d -exec chmod 755 {} \;

# Files: 644 (read, write by owner; read-only by others)
sudo find /var/www/html -type f -exec chmod 644 {} \;

# Lock down wp-config.php (read-only for owner/group)
sudo chmod 600 /var/www/html/wp-config.php
```

---

## 4. `wp-config.php` Production Hardening

Add the following security definitions to `wp-config.php` above the `/* That's all, stop editing! */` line:

```php
// Force SSL for administration
define( 'FORCE_SSL_ADMIN', true );

// Disable in-dashboard theme and plugin file editor
define( 'DISALLOW_FILE_EDIT', true );

// Prevent untrusted plugin and core updates from web UI if managed via CI/CD
// define( 'DISALLOW_FILE_MODS', true );

// Turn off public debug display; log errors privately
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Empty trash automatically every 14 days
define( 'EMPTY_TRASH_DAYS', 14 );

// Limit post revisions to prevent database bloat
define( 'WP_POST_REVISIONS', 5 );

// Use a custom database table prefix (set during installation)
$table_prefix = 'ns_prod_';
```

---

## 5. Web Server Configuration (Nginx)

Below is an optimized, production-ready Nginx server block:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name northstarrenovation.com www.northstarrenovation.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name northstarrenovation.com www.northstarrenovation.com;

    root /var/www/html;
    index index.php index.html;

    # SSL Certificates (managed via Certbot)
    ssl_certificate /etc/letsencrypt/live/northstarrenovation.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/northstarrenovation.com/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;

    # Security Headers
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;

    # Gzip Compression
    gzip on;
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_types text/plain text/css text/xml application/json application/javascript application/rss+xml application/atom+xml image/svg+xml;

    # Block access to hidden files (.git, .env, etc.)
    location ~ /\. {
        deny all;
        access_log off;
        log_not_found off;
    }

    # Block access to xmlrpc.php to prevent brute-force attacks
    location = /xmlrpc.php {
        deny all;
        access_log off;
        log_not_found off;
    }

    # Static Assets Caching (1 year)
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|webp|svg|woff2|woff|ttf)$ {
        expires 365d;
        add_header Cache-Control "public, no-transform";
        access_log off;
    }

    # Standard WordPress Permalinks
    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    # PHP-FPM FastCGI Handler
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

---

## 6. Email & Transactional SMTP Setup

In production, relying on the host server's local `sendmail` / `mail()` binary often causes notification emails to end up in spam folders.

### Setup Instructions:
1. **Choose a Transactional SMTP Provider**:
   - SendGrid, Postmark, Amazon SES, or Brevo (Sendinblue).
2. **Install an SMTP Plugin**:
   - Recommended: **WP Mail SMTP** or **Post SMTP**.
3. **Configure DNS Records** on the domain registrar / Cloudflare:
   - **SPF Record**: `v=spf1 include:sendgrid.net ~all`
   - **DKIM Key**: Add CNAME records provided by your SMTP provider.
   - **DMARC Record**: `v=DMARC1; p=quarantine; rua=mailto:dmarc-reports@northstarrenovation.com`
4. **Test Delivery**:
   - Navigate to the Contact page and submit a consultation request. Verify delivery to the administration inbox.

---

## 7. Migration via WP-CLI

When migrating a staged database to production:

```bash
# Export staged database
wp db export staging-backup.sql

# Import on production
wp db import staging-backup.sql

# Update URLs safely across serialized options and metadata
wp search-replace 'http://127.0.0.1:8080' 'https://northstarrenovation.com' --all-tables

# Flush rewrite rules
wp rewrite flush --hard

# Flush WordPress cache
wp cache flush
```

---

## 8. Backup & Disaster Recovery Strategy

1. **Daily Database Backup**:
   Automated cron job generating encrypted, compressed SQL dumps:
   ```bash
   0 2 * * * /usr/local/bin/wp db export --path=/var/www/html /backups/db-$(date +\%F).sql.gz
   ```
2. **Weekly Uploads Backup**:
   Rsync `/var/www/html/wp-content/uploads` to off-site cloud storage (AWS S3, Google Cloud Storage, or Cloudflare R2).
3. **Restoration Verification**:
   Quarterly drills to test restoring backups into an isolated staging environment.

---

## 9. Pre-Launch Checklist

- [ ] All 50 Playwright tests passing cleanly.
- [ ] Custom post types and project taxonomy registered and populated.
- [ ] SSL certificate active with automatic renewal configured.
- [ ] Permalinks set to `/%postname%/`.
- [ ] Static homepage set to **Home** and blog posts set to **Insights**.
- [ ] Primary navigation menu assigned to the **Primary Navigation** theme location.
- [ ] SMTP email notifications tested and receiving inquiries.
- [ ] Google Search Console and Bing Webmaster Tools verified.
- [ ] XML sitemap generated (`/wp-sitemap.xml`).
- [ ] Demo disclaimers reviewed and replaced with genuine company details.
- [ ] 404 error page verified and functioning.
