# CloudPanel Production Deployment Quick Reference

### 1. Requirements on CloudPanel:
- **Site Type**: PHP Site
- **PHP Version**: 8.2
- **Document Root**: `/home/{user}/htdocs/{domain}`

### 2. Database Setup:
1. Create Database & User in CloudPanel Databases.
2. In phpMyAdmin, import `database.sql` (generated in project root).
3. In CloudPanel -> Site -> PHP Settings -> Environment Variables, add:
   ```env
   DB_HOST=127.0.0.1
   DB_NAME=your_db_name
   DB_USER=your_db_user
   DB_PASS=your_db_password
   ```
   *(Or copy `config.example.php` to `config.php` and set them there).*

### 3. Permissions:
Make sure uploads folder is writable:
```bash
chmod -R 775 img/
```

### 4. Nginx Vhost:
Increase upload limit to avoid HTTP 413 on image uploads:
```nginx
client_max_body_size 20M;
```

### 5. Security Cleanup:
- Change default admin password (`admin`/`admin`) in `user` table.
- Delete `database.sql` and maintenance scripts (`repair_and_populate.php`, `check_records_again.php`) from the live server.
