# Quirx

A YouTube-like video sharing platform built with PHP and MySQL.

## Features

- 🎥 **Video Upload & Streaming** - Upload and watch videos with thumbnail support
- 👤 **User Management** - Registration, login, profile management with avatars
- 🔍 **Search & Discovery** - Search videos by title, tags, and content
- ⭐ **Rating System** - Star ratings and view tracking
- 📊 **Admin Dashboard** - User and content management
- 🏷️ **Video Tags** - Categorize and organize content
- 📧 **Email Integration** - Password reset via PHPMailer
- 📱 **Responsive Design** - Mobile-friendly interface

## Tech Stack

- **Backend**: PHP with PDO (MySQL)
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **Email**: PHPMailer
- **Dependencies**: Composer

## Quick Start

1. **Clone the repository**

   ```bash
   git clone https://github.com/kuldp18/quirx.git
   cd quirx
   ```

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Setup database**

   - Create MySQL database named `quirx_2`
   - Import database schema (check includes/db_handler.inc.php for connection details)

4. **Configure environment**

   - Update database credentials in `includes/db_handler.inc.php`
   - Ensure uploads directory has write permissions

5. **Run locally**
   - Place in your web server directory (e.g., xampp/htdocs)
   - Access via `http://localhost/quirx`

## Project Structure

```
quirx/
├── assets/          # Static assets (images, icons)
├── controllers/     # Form processing logic
├── css/            # Stylesheets
├── includes/       # Core PHP includes and components
├── js/             # JavaScript files
├── models/         # Database interaction layer
├── pages/          # Application pages
├── uploads/        # User-generated content (videos, thumbnails, profiles)
├── views/          # View templates and components
└── vendor/         # Composer dependencies
```

## License

Created by Kuldeep Solanki (kuldeepsolanki1854@gmail.com)
