# 🌍 Travel WITH ME — Dynamic Tourism & Travel Booking CMS

[![PHP Version](https://img.shields.io/badge/PHP-8.0%2B%20%7C%208.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

> A modern, responsive travel agency portal and full-featured Content Management System (CMS) built with PHP and MySQL. Designed for tour operators, travel agencies, and booking management with an intuitive admin dashboard and front-end in-context editing.

---

## 📑 Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
  - [Frontend Experience](#1-frontend-experience)
  - [Admin Dashboard & CMS](#2-admin-dashboard--cms)
  - [Live In-Context Editing](#3-live-in-context-editing)
- [Tech Stack](#-tech-stack)
- [Directory Structure](#-directory-structure)
- [Prerequisites](#-prerequisites)
- [Installation & Setup](#-installation--setup)
  - [Local Development (WampServer / XAMPP)](#local-development-wampserver--xampp)
  - [Default Administrator Credentials](#default-administrator-credentials)
- [Configuration & Environment](#-configuration--environment)
- [Database Schema](#-database-schema)
- [Production Deployment (CloudPanel / Nginx)](#-production-deployment-cloudpanel--nginx)
- [Recommended `.gitignore`](#-recommended-gitignore)
- [Security Checklist](#-security-checklist)
- [Git Quick-Start Commands](#-git-quick-start-commands)
- [License](#-license)

---

## 🌟 Overview

**Travel WITH ME** is a full-stack web application tailored for travel agencies and tour operators. It combines a visually compelling, mobile-responsive customer-facing website with a robust administrative control panel. 

The site features dynamic navigation menus, tour package showcases, holiday deals, cultural highlights, and an interactive reservation/inquiry booking modal. From the admin dashboard, operators can manage all website content, upload media, and track customer inquiries and bookings with real-time status updates.

---

## 🚀 Key Features

### 1. Frontend Experience
- **Dynamic Content Delivery**: All sections (Hero, Featured destinations, Holiday packages, Tours, Culture, Services, About Us) are driven dynamically from MySQL.
- **Hierarchical Navigation Menu**: Multi-level navigation support with parent/child submenu rendering and dynamic sorting.
- **Interactive Tour Booking Modal**: Built-in modal allowing visitors to submit reservation inquiries for specific tours, specify traveler counts, and select departure dates.
- **AJAX & Fallback Inquiry Submissions**: Asynchronous inquiry and booking submissions with instant user feedback and email format validation.
- **Responsive & Modern Design**: Clean typography (Montserrat, Playfair Display, Plus Jakarta Sans), sticky header navigation, mobile drawer menu, and CSS transitions.

### 2. Admin Dashboard & CMS
- **Session Authentication**: Secure administrative login and logout with protected route guards.
- **Dashboard Metrics**: Real-time counter cards showing total navigation items, available tours, holiday packages, total inquiries, and new unread customer requests.
- **Inquiry & Booking Lifecycle Management**:
  - Filter inquiries by status (`New`, `Pending`, `Confirmed`, `Cancelled`) and inquiry type.
  - One-click status badge updates without page reloading.
  - Delete inquiries with prompt confirmation.
- **Comprehensive Section CRUD**:
  - **Navigation Menus**: Add, reorder, edit, and delete navigation items.
  - **Hero / Home Banner**: Update headlines, subheadings, call-to-actions, and button links.
  - **Featured Cards & Holidays**: Manage highlights, image uploads, prices, and itineraries.
  - **Popular Tours**: Manage tour names, destinations, featured badges, and imagery.
  - **Cultural Spotlight**: Showcase cultural heritage, regional highlights, and read-more links.
  - **About & Leadership Team**: Manage company history and team member profiles.
  - **Services**: Manage travel offerings (flight bookings, hotel stays, certified guides).
  - **Contact Information**: Manage office locations, telephone numbers, and email addresses.
- **Image Upload Management**: Image upload support with automatic file naming, upload directory handling, and dashboard thumbnail previews.

### 3. Live In-Context Editing
- When logged in as an administrator, browsing the public website reveals a floating **Admin Bar** at the top of the viewport.
- Hovering over editable sections activates dashed border highlights and instant **"Change [Section]"** quick-edit buttons that route directly to the corresponding admin panel page.

---

## 🛠️ Tech Stack

| Layer | Technologies Used |
| :--- | :--- |
| **Frontend** | HTML5, CSS3 (Flexbox/Grid), JavaScript (Vanilla ES6+), Boxicons, Remixicon 4.2 |
| **Typography** | Google Fonts (*Montserrat*, *Playfair Display*, *Plus Jakarta Sans*) |
| **Backend** | PHP 8.0+ (PHP 8.2 recommended), Procedural & Object-Oriented MySQLi |
| **Database** | MySQL 8.0+ / MariaDB (utf8mb4 encoding, foreign keys, auto-timestamps) |
| **Admin UI** | Bootstrap 5.3.2, Remixicon, Custom Dashboard CSS |
| **Web Server** | Apache (WampServer, XAMPP, Laragon) or Nginx + PHP-FPM (CloudPanel, VPS) |

---

## 📁 Directory Structure

```plaintext
Travel Site/
├── admin/                     # Administrative Control Panel
│   ├── images/                # Admin-specific assets & icons
│   ├── inc/                   # Admin includes (header, footer, DB connection)
│   │   ├── conn.php           # Core DB connection layer with auto-environment detection
│   │   ├── header.php         # Admin dashboard navigation & sidebar
│   │   └── footer.php         # Admin footer scripts
│   ├── dashboard.php          # Main admin analytics & overview dashboard
│   ├── inquiries.php          # Customer bookings & inquiries management
│   ├── inquiry_status.php     # AJAX status toggle handler (New, Confirmed, etc.)
│   ├── inquiry_delete.php     # Inquiry deletion processor
│   ├── login.php              # Administrator authentication form
│   ├── logout.php             # Session destruction & sign-out
│   ├── menu.php               # Nav menu management (CRUD)
│   ├── home.php               # Hero section content management
│   ├── tour.php               # Tour package management
│   ├── holiday.php            # Holiday package management
│   ├── culture.php            # Culture highlight section management
│   ├── feature.php            # Features section management
│   ├── about_table.php        # About page & team members management
│   ├── service_table.php      # Services section management
│   └── contact_table.php      # Contact details management
├── css/                       # Public stylesheets
│   ├── style.css              # Core website layout & theme styling
│   ├── animations.css         # Keyframe animation effects
│   ├── boxicons.css           # Boxicons icons
│   └── boxicons.min.css       # Minified icon pack
├── img/                       # Uploaded site images, banners, and tour media
├── inc/                       # Public reusable templates & components
│   ├── admin_panel.php        # Live front-end admin bar & quick-edit controls
│   ├── booking_modal.php      # Reservation & booking modal dialog
│   ├── header.php             # Public responsive navigation header
│   └── footer.php             # Public footer & social links
├── js/                        # Public client-side scripts
│   └── script.js              # Sticky navbar, mobile menu toggle, interactions
├── .gitattributes             # Git line-ending configuration
├── about.php                  # Public "About Us" & team page
├── contact.php                # Public "Contact Us" & interactive contact form
├── service.php                # Public "Services" offerings page
├── index.php                  # Public Home landing page
├── submit_inquiry.php         # Inquiry & booking submission processor (AJAX / POST)
├── config.example.php         # Production database configuration template
├── config.php                 # Local / Production database credentials (gitignored)
├── database.sql               # MySQL database dump (tables schema & seed data)
├── DEPLOYMENT.md              # CloudPanel production deployment reference
└── README.md                  # Project documentation
```

---

## 💻 Prerequisites

Ensure your development or production environment meets the following specifications:

- **PHP**: `8.0` or higher (`8.2` recommended) with the following extensions enabled:
  - `mysqli`
  - `session`
  - `fileinfo`
  - `json`
- **Database**: MySQL `5.7` / `8.0+` or MariaDB `10.4+`
- **Web Server**: 
  - Local: [WampServer](https://www.wampserver.com/), [XAMPP](https://www.apachefriends.org/), or [Laragon](https://laragon.org/)
  - Production: [CloudPanel](https://www.cloudpanel.io/), Nginx, or Apache on Linux

---

## ⚙️ Installation & Setup

### Local Development (WampServer / XAMPP)

1. **Clone the Repository**:
   Clone this project into your local web server's root folder (`www` for WampServer, `htdocs` for XAMPP):
   ```bash
   cd c:/wamp64/www/
   git clone <your-repository-url> "Travel Site"
   cd "Travel Site"
   ```

2. **Create the Database**:
   - Open **phpMyAdmin** (`http://localhost/phpmyadmin/`) or your preferred MySQL client.
   - Create a new database named `traveldb` with collation `utf8mb4_unicode_ci`:
     ```sql
     CREATE DATABASE `traveldb` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
     ```

3. **Import Database Schema & Sample Data**:
   - In phpMyAdmin, select `traveldb` and click **Import**.
   - Choose `database.sql` from the root of this project and click **Import**.
   - *Alternatively, via CLI:*
     ```bash
     mysql -u root -p traveldb < database.sql
     ```

4. **Verify Database Configuration**:
   The connection script (`admin/inc/conn.php`) automatically detects local environments (`localhost` / `127.0.0.1`) and uses default credentials:
   - Host: `127.0.0.1`
   - User: `root`
   - Password: `""` (blank)
   - Database: `traveldb`

   If your local MySQL uses a custom password or port, copy `config.example.php` to `config.php`:
   ```bash
   cp config.example.php config.php
   ```
   Edit `config.php` with your local credentials.

5. **Set Upload Directory Permissions**:
   Ensure the `img/` directory is writable for file uploads:
   - **Linux / macOS**: `chmod -R 775 img/`
   - **Windows**: Verify that your web server process has write access to the `img/` directory.

6. **Launch the Application**:
   - Public Website: [`http://localhost/Travel Site/`](http://localhost/Travel Site/)
   - Admin Panel: [`http://localhost/Travel Site/admin/login.php`](http://localhost/Travel Site/admin/login.php)

---

### 🔑 Default Administrator Credentials

| Portal | URL | Username | Password |
| :--- | :--- | :--- | :--- |
| **Admin Login** | `http://localhost/Travel Site/admin/login.php` | `admin` | `admin` |

> ⚠️ **IMPORTANT SECURITY NOTICE**: Immediately change the default admin password in the `user` database table before deploying to any public or staging server!

---

## 🔧 Configuration & Environment

The database connection layer (`admin/inc/conn.php`) supports two modes:

### 1. Automatic Localhost Fallback
When running on `localhost`, `127.0.0.1`, or via CLI, `conn.php` automatically connects using standard local defaults (`root` without password to `traveldb`).

### 2. Custom Config File (`config.php`)
Copy `config.example.php` to `config.php` to define specific credentials:

```php
<?php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'traveldb');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_secure_password');
define('DB_PORT', 3306);
```

### 3. Environment Variables (CloudPanel / Docker / CI)
You can also define credentials via system environment variables:
- `DB_HOST`
- `DB_NAME`
- `DB_USER`
- `DB_PASS`
- `DB_PORT`

---

## 🗄️ Database Schema

The database consists of 11 relational tables:

| Table | Purpose |
| :--- | :--- |
| `user` | Administrator accounts and authentication credentials. |
| `inquiries` | Customer booking requests and contact inquiries with status flags. |
| `menu` | Dynamic navbar menu items with hierarchy (`menu_parent`) and ordering (`menu_order`). |
| `home` | Hero banner headings, descriptive text, and primary CTA buttons. |
| `tour` | Tour packages, destinations, thumbnails, and preview badges. |
| `holiday` | Holiday packages, pricing, durations, and itineraries. |
| `culture` | Cultural spotlight articles, images, and read-more actions. |
| `feature` | Highlighted selling points and feature icons displayed on the homepage. |
| `about` | Company narrative, background information, and team member profiles. |
| `service` | Offerings catalog (Flight Booking, Hotel Reservation, Travel Guides). |
| `contact` | Agency phone numbers, email addresses, and physical office locations. |

---

## 🌐 Production Deployment (CloudPanel / Nginx)

For full step-by-step instructions, see [`DEPLOYMENT.md`](DEPLOYMENT.md).

### Quick Reference:
1. **Site Type**: PHP Site (PHP 8.2).
2. **Document Root**: `/home/{user}/htdocs/{domain}`.
3. **Database Setup**:
   - Create Database & User in CloudPanel Databases.
   - Import `database.sql` via phpMyAdmin.
   - Set environment variables in CloudPanel:
     ```env
     DB_HOST=127.0.0.1
     DB_NAME=your_db_name
     DB_USER=your_db_user
     DB_PASS=your_db_password
     ```
4. **Permissions**:
   ```bash
   chmod -R 775 img/
   chown -R {user}:{user} /home/{user}/htdocs/{domain}
   ```
5. **Nginx Client Max Body Size**:
   In CloudPanel -> Vhost Settings, add inside the `server { ... }` block to allow image uploads:
   ```nginx
   client_max_body_size 20M;
   ```

---

## 🛡️ Recommended `.gitignore`

To prevent sensitive credentials and temporary files from being committed to Git, ensure your `.gitignore` contains:

```gitignore
# Database & sensitive credentials
config.php

# Operating system files
.DS_Store
Thumbs.db
desktop.ini

# IDE & Editor folders
.vscode/
.idea/
*.sublime-project
*.sublime-workspace

# Temporary & debug files
*.log
db_test.php
0.26.0

# Maintenance scripts (do not expose in public production repos)
repair_and_populate.php
check_records_again.php
insert_single.php
```

---

## 🔒 Security Checklist

Before pushing to production:
- [ ] Change the default `admin` password in the `user` table.
- [ ] Ensure `config.php` contains production credentials and is not publicly readable.
- [ ] Remove or restrict access to temporary test scripts (`db_test.php`, `repair_and_populate.php`).
- [ ] Restrict direct web access to `.sql` files via web server configuration.
- [ ] Ensure `client_max_body_size` is appropriately capped in Nginx / Apache.
- [ ] Verify that directory indexing is disabled on the web server (`Options -Indexes` in Apache).

---

## 📦 Git Quick-Start Commands

To stage and commit this project to your Git repository:

```bash
# Check status
git status

# Add all files (or add README.md)
git add README.md

# Commit changes
git commit -m "docs: add comprehensive project README"

# Push to your remote repository
git push origin main
```

---

## 📄 License

This project is licensed under the [MIT License](LICENSE) — feel free to customize and use it for personal and commercial projects.

---

### 👨‍💻 Developed by
**Full Stack Web Development Team**  
*Crafted for high performance, intuitive content management, and seamless travel experiences.*

