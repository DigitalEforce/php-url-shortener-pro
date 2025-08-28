# 🚀 PHP Professional URL Shortener

A professional PHP URL shortener with a secure admin dashboard and analytics. Built with Bootstrap 5 for a modern, responsive UI. Easily shorten URLs, track clicks, and manage statistics.

---

## Features

- Shorten URLs using `/r/shortcode` format
- Admin dashboard with authentication
- Track clicks by date, IP, user-agent, and country
- Click analytics with chart visualization (Chart.js)
- Database-driven (MySQL) with clean structure (`app/`, `api/`, `public/`)
- Optional QR code generation
- Responsive UI for desktop and mobile

---

## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/DigitalEforce/php-url-shortener-pro.git
   ```

2. **Import the database** via phpMyAdmin or MySQL CLI.

3. **Configure database connection** in `app/config.php`:
   ```php
   $host = "localhost";
   $dbname = "url_shortener";
   $username = "root";
   $password = "";
   ```

4. **Optional:** `.htaccess` for clean URLs:
   ```apache
   RewriteEngine On
   RewriteBase /php-url-shortener-pro/public/
   RewriteRule ^r/([a-zA-Z0-9]+)$ redirect.php?c=$1 [L,QSA]
   RewriteRule ^$ index.php [L]
   ```

5. **Access the project**:
   - Public: `http://localhost/php-url-shortener-pro/public/`
   - Admin: `http://localhost/php-url-shortener-pro/public/admin/login.php`

---

## Public Usage

1. Visit homepage.  
2. Enter the long URL.  
3. Click **Shorten URL**.  
4. Copy the generated short URL, e.g., `http://localhost/php-url-shortener-pro/public/r/abc123`.

---

## Admin Dashboard

- **Login URL:** `http://localhost/php-url-shortener-pro/public/admin/login.php`  
- **Username:** `admin`  
- **Password:** `admin123`

**Admin Features**:
- View all shortened URLs
- Track total clicks per URL
- Detailed analytics (Chart.js)
- Logout functionality

---

## Analytics

- View total clicks per URL
- Clicks over time chart
- IP, country, and user-agent per click
- Summary cards for Total URLs & Total Clicks

---

## Screenshots

- Homepage: `public/assets/screenshots/homepage.png`
- Admin Dashboard: `public/assets/screenshots/admin-dashboard.png`

---

## Contribution

We welcome contributions!

1. Fork the repository
2. Clone your fork locally
3. Create a branch: `git checkout -b feature-name`
4. Make changes
5. Commit changes: `git commit -m "Add feature"`
6. Push branch: `git push origin feature-name`
7. Open a Pull Request

See `CONTRIBUTING.md` for full guidelines.

---

## About Me

I am [Naveed](https://github.com/DigitalEforce), a passionate PHP developer. I specialize in creating modern, secure, and professional web applications using PHP, MySQL, and Bootstrap.

Check my GitHub for more projects: [https://github.com/DigitalEforce](https://github.com/DigitalEforce)

---

## License

MIT License
