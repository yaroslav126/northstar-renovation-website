# Northstar Renovation — Production Deployment Guide

This guide details the procedure for packaging, staging, and deploying the **Northstar Renovation** custom WordPress theme and companion plugin to a production hosting environment.

---

## 1. Hosting Environment Prerequisites

- **Server**: Nginx or Apache (with `mod_rewrite` enabled).
- **PHP Version**: PHP 8.1 or PHP 8.2 (with `curl`, `mbstring`, `xml`, `gd`, `zip`, and `pdo_mysql` extensions).
- **Database**: MySQL 8.0+ or MariaDB 10.5+.
- **WordPress**: WordPress 6.4+ (Full Site Editing and Gutenberg block engine enabled).
- **HTTPS**: Mandatory SSL/TLS certificate (Let's Encrypt or commercial TLS 1.3).
- **Memory Limit**: Minimum 256MB PHP memory limit (`WP_MEMORY_LIMIT = '256M'`).

---

## 2. Directory Architecture & Artifact Mapping

Upload the theme and plugin folders to the WordPress installation target:

```text
wp-content/
├── themes/
│   └── northstar-renovation/        <-- Active Custom Theme
└── plugins/
    └── northstar-site-core/         <-- Active Companion Plugin
```

### Git / Version Control Integration
To maintain the repository with standard WordPress configurations, ensure `.gitignore` excludes sensitive files (`wp-config.php`, `.env`, `/uploads/`, core `/wp-admin/`, and `/wp-includes/`).

---

## 3. Step-by-Step Production Deployment

### Step A: Deploy Companion Plugin First
1. Compress or SFTP upload `wordpress/wp-content/plugins/northstar-site-core/` to `/wp-content/plugins/`.
2. Navigate to WordPress Admin &rarr; **Plugins**.
3. Locate **Northstar Site Core** and click **Activate**.
4. Confirm Custom Post Types (`Projects`, `Services`, `Testimonials`) appear in the admin sidebar.

### Step B: Deploy Custom Theme
1. Upload `wordpress/wp-content/themes/northstar-renovation/` to `/wp-content/themes/`.
2. Navigate to WordPress Admin &rarr; **Appearance &rarr; Themes**.
3. Activate **Northstar Renovation**.
4. Navigate to **Settings &rarr; Permalinks** and ensure **Post name** (`/%postname%/`) is selected, then click **Save Changes** to flush rewrite rules.

### Step C: Configure Static Front Page & Blog Index
1. Go to **Settings &rarr; Reading**.
2. Select **A static page (select below)**:
   - **Homepage**: Select "Home" (assigned to default Front Page template).
   - **Posts page**: Select "Journal / Renovation Insights".
3. Click **Save Changes**.

### Step D: Setup Primary Navigation Menu
1. Go to **Appearance &rarr; Menus**.
2. Create a new menu named `Primary Menu`.
3. Add links:
   - Services (`/services/`)
   - Portfolio (`/portfolio/`)
   - About Us (`/about/`)
   - Process & FAQ (`/faq/`)
   - Journal (`/blog/`)
   - Contact (`/contact/`)
4. Under **Menu Settings &rarr; Display location**, check **Primary Navigation**.
5. Save the menu.

### Step E: Configure Production Email (SMTP)
The companion plugin dispatches consultation quote requests to the site administrator email via `wp_mail()`. To prevent emails landing in spam:
1. Install an enterprise SMTP plugin (e.g. WP Mail SMTP or FluentSMTP).
2. Configure credentials with an authenticated transactional email service (SendGrid, Postmark, AWS SES, or Google Workspace SMTP).
3. Send a test message through the Contact page form and verify delivery to the project director's inbox.

---

## 4. Production Hardening & Performance Optimization

### HTTP Cache Headers & Static Asset Compression
Add the following directives to Nginx or Apache configuration:

```nginx
# Nginx Asset Caching
location ~* \.(css|js|svg|png|jpg|jpeg|gif|ico|woff2)$ {
    expires 1y;
    add_header Cache-Control "public, no-transform, immutable";
    access_log off;
}
```

### Security Headers
Ensure the following HTTP response headers are set:
```http
X-Frame-Options: SAMEORIGIN
X-Content-Type-Options: nosniff
Referrer-Policy: strict-origin-when-cross-origin
Permissions-Policy: geolocation=(), camera=(), microphone=()
```

### Content Delivery Network (CDN) & Asset Minification
1. Point DNS through Cloudflare or CloudFront with HTTP/3 and Brotli compression enabled.
2. The theme styles (`style.css`) and script (`assets/js/main.js`) are written with modern zero-dependency vanilla code, requiring no complex build pipeline to run at 60fps.
3. For enterprise production scale, minify CSS and JS files using standard tools (e.g., `esbuild` or `terser`).
