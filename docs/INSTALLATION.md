# Installation & Setup Guide — Northstar Renovation

This document explains how to set up, install, and configure the **Northstar Renovation** custom theme (`northstar-renovation`) and companion plugin (`northstar-site-core`) in any standard WordPress environment.

---

## 1. System Requirements

- **PHP**: 8.0 or higher (8.1 / 8.2 recommended)
- **WordPress**: 6.0 or higher (Tested up to WordPress 6.7)
- **Database**: MySQL 5.7+ or MariaDB 10.4+
- **Web Server**: Apache with `mod_rewrite` enabled or Nginx
- **HTTPS**: Required in production for secure transmission of quote requests

---

## 2. Local Development Setup Options

### Option A: LocalWP (Recommended for Freelance Clients & Designers)
1. Download and install [LocalWP](https://localwp.com/).
2. Create a new site (e.g., `northstar-renovation.local`) using PHP 8.1+ and Nginx/Apache.
3. Open the site folder: `app/public/wp-content/`.
4. Copy `northstar-renovation` into `app/public/wp-content/themes/`.
5. Copy `northstar-site-core` into `app/public/wp-content/plugins/`.
6. Start the site from the LocalWP interface.

### Option B: Docker / Docker Compose
You can mount the theme and plugin directories directly into a standard WordPress container:
```yaml
services:
  wordpress:
    image: wordpress:6.7-php8.2-apache
    ports:
      - "8080:80"
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_USER: wp_user
      WORDPRESS_DB_PASSWORD: wp_password
      WORDPRESS_DB_NAME: northstar_db
    volumes:
      - ./wordpress/wp-content/themes/northstar-renovation:/var/www/html/wp-content/themes/northstar-renovation
      - ./wordpress/wp-content/plugins/northstar-site-core:/var/www/html/wp-content/plugins/northstar-site-core
  db:
    image: mariadb:10.11
    environment:
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_DATABASE: northstar_db
      MYSQL_USER: wp_user
      MYSQL_PASSWORD: wp_password
    volumes:
      - db_data:/var/lib/mysql
volumes:
  db_data:
```

### Option C: Built-in Verification Test Harness (Included in Repository)
For rapid verification without setting up MySQL:
```bash
# Using containerized PHP 8.1
podman run --name ns-web-server -d --net=host \
  -v $(pwd):/workspace -w /workspace northstar-php \
  php -S 127.0.0.1:8080 tests/router.php

# Visit in browser
http://127.0.0.1:8080/
```

---

## 3. Theme & Plugin Installation Steps

### Step 1: Install the Companion Plugin
1. Log into your WordPress administrative dashboard (`/wp-admin`).
2. Navigate to **Plugins > Installed Plugins**.
3. Locate **Northstar Renovation Site Core** and click **Activate**.
4. *Effect*: Registers custom post types (`northstar_project`, `northstar_service`, `northstar_testimonial`), custom taxonomy (`project_category`), meta fields, and server-side quote submission endpoints.

### Step 2: Install and Activate the Theme
1. Navigate to **Appearance > Themes**.
2. Locate **Northstar Renovation** and click **Activate**.
3. *Effect*: Activates the architectural editorial theme, custom Gutenberg color palette, font styles, and responsive layouts.

---

## 4. Essential WordPress Configuration

### 1. Configure Permalinks
1. Navigate to **Settings > Permalinks**.
2. Select **Post name** (`/%postname%/`).
3. Click **Save Changes**. This flushes rewrite rules for the custom post types.

### 2. Configure Homepage & Blog Pages
1. Navigate to **Pages > Add New Page**:
   - Create a page named **Home** and publish it.
   - Create a page named **Insights** (or **Blog**) and publish it.
   - Create a page named **Services** (Assign Template: **Services**).
   - Create a page named **Portfolio** (Assign Template: **Portfolio**).
   - Create a page named **About** (Assign Template: **About**).
   - Create a page named **FAQ** (Assign Template: **FAQ**).
   - Create a page named **Contact** (Assign Template: **Contact & Quote Request**).
2. Navigate to **Settings > Reading**:
   - Set **Your homepage displays** to **A static page**.
   - **Homepage**: Select **Home**.
   - **Posts page**: Select **Insights**.
   - Click **Save Changes**.

### 3. Build the Primary Navigation Menu
1. Navigate to **Appearance > Menus**.
2. Create a new menu named `Primary Menu`.
3. Add the following pages:
   - Home
   - Services
   - Portfolio
   - About
   - Insights
   - FAQ
   - Contact
4. Under **Menu Settings**, check **Primary Navigation**.
5. Click **Save Menu**.

---

## 5. Contact Form & SMTP Configuration

The contact form dispatches notification emails using WordPress's native `wp_mail()` function:
- **Default Recipient**: The WordPress administration email (`Settings > General > Administration Email Address`).
- **Custom Recipient Filter**: You can customize the recipient via PHP:
  ```php
  add_filter( 'northstar_consultation_recipient', function( $email ) {
      return 'custom-inquiries@yourdomain.com';
  });
  ```

### Production SMTP Setup
For reliable delivery in production (preventing emails from being flagged by spam filters):
1. Install an SMTP plugin such as **WP Mail SMTP** or **Post SMTP**.
2. Configure your transactional email provider (SendGrid, Brevo, Postmark, Amazon SES, or Google Workspace).
3. Ensure DNS records (**SPF**, **DKIM**, and **DMARC**) are verified for your domain.

---

## 6. Replacing Demonstration Content for Client Delivery

All demonstration projects, reviews, personnel, and disclaimers are designed for seamless replacement:
1. **Projects**: Add real renovation case studies via **Projects > Add New Project**. Upload high-resolution imagery and select the appropriate `project_category`.
2. **Services**: Customize descriptions via **Services > Edit Service** or the page template.
3. **Testimonials**: Add verified client reviews in **Testimonials (Demo) > Add New**.
4. **Site Logo & Identity**: Configure via **Appearance > Customize > Site Identity**.
5. **Demonstration Disclaimer**: Once verified commercial information is populated, remove or edit the demonstration notice box in `footer.php`.
