# 💇‍♂️ Backoffice Haircut Management System

> **⚠️ IMPORTANT NOTICE / PEMBERITAHUAN PENTING**  
> 🔒 **This repository is for DEMONSTRATION/PORTFOLIO purposes only**  
> 🚫 **Repository ini hanya untuk tujuan DEMONSTRASI/PORTOFOLIO**  
> ❌ **NOT FOR COMMERCIAL USE - Redistribution, modification, or commercial use is PROHIBITED**  
> ❌ **BUKAN UNTUK KOMERSIAL - Dilarang redistribusi, modifikasi, atau penggunaan komersial**  
> 📧 **Contact owner for licensing: [your-email@example.com]**

A modern, comprehensive Laravel-based management system for haircut and beauty salon businesses. This application provides a complete solution for managing customers, services, loyalty programs, and business operations with advanced security features and Google OAuth integration.

## ✨ Key Features

### 🔐 Authentication & Security
- **Dual Authentication System**: Separate admin and customer login systems
- **Google OAuth Integration**: Seamless login with Google accounts and profile photo sync
- **Multi-Guard Protection**: Role-based access control with Laravel policies
- **Advanced Security**: Rate limiting, CSRF protection, and comprehensive audit logging
- **Password Security**: Bcrypt hashing with configurable rounds

### 👥 Customer Management
- **Customer Portal**: Self-service dashboard with profile management
- **Google Login**: Quick registration and login using Google accounts
- **Profile Sync**: Automatic profile photo synchronization from Google
- **Account Linking**: Connect existing accounts with Google OAuth
- **Reward Points System**: Earn, track, and redeem loyalty points
- **Service History**: Complete transaction and appointment history

### 🏪 Store & Service Management
- **Store Directory**: Comprehensive store listings with location details
- **Service Booking**: WhatsApp integration for appointment scheduling
- **Review System**: Customer feedback and rating management
- **Promotional Codes**: Create and manage discount campaigns
- **Point Rewards**: Flexible reward point system

### 🛡️ Admin Dashboard
- **Real-time Analytics**: Business insights and performance metrics
- **User Management**: Complete customer lifecycle management
- **Content Management**: Store, service, and promotion administration
- **Security Monitoring**: Activity tracking and threat detection
- **Report Generation**: Comprehensive business reporting

### 🎨 Modern UI/UX
- **Responsive Design**: Mobile-first approach with Bootstrap 5
- **Clean Interface**: Professional admin and customer portals
- **Interactive Elements**: Dynamic forms with Choices.js and DataTables
- **Consistent Branding**: Unified design system across all modules

## 🛠️ Technical Stack

## 🛠️ Technical Stack

### Backend
- **Framework**: Laravel 11.45.1 (Latest LTS)
- **Language**: PHP 8.2+
- **Database**: MySQL 8.0+ / SQLite support
- **Authentication**: Laravel Sanctum + OAuth (Google)
- **Security**: Multi-guard auth, rate limiting, CSRF protection
- **Package Manager**: Composer 2.0+

### Frontend
- **CSS Framework**: Bootstrap 5 + Tailwind CSS
- **JavaScript**: Vanilla JS with modern ES6+ features
- **UI Components**: Choices.js, DataTables, Perfect Scrollbar
- **Icons**: Feather Icons, Bootstrap Icons
- **Build Tool**: Vite (HMR enabled)

### Third-Party Integrations
- **Google OAuth**: Laravel Socialite for authentication
- **WhatsApp API**: Business messaging integration
- **Google Maps**: Location services (configured)

### Development Tools
- **Package Manager**: npm/yarn
- **Build System**: Vite with hot reload
- **Code Quality**: Laravel best practices
- **Version Control**: Git with semantic commits

## 📋 Requirements

- PHP 8.2 or higher
- Composer 2.0+
- Node.js 16+ and npm
- MySQL 8.0+ or SQLite
- Web server (Apache/Nginx)

## ⚡ Quick Installation

### 1. Clone Repository
```bash
git clone <repository-url> backoffice_haircut
cd backoffice_haircut
```

### 2. Install Dependencies
```bash
# PHP dependencies
composer install

# Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=backoffice_haircut
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Database Setup
```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed
```

### 6. Build Assets
```bash
# Development build
npm run dev

# Production build
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## 👤 Default Accounts

### Admin Account
- **Email**: admin@haircut.com
- **Password**: password123

### Test User Account
- **Email**: user@example.com
- **Password**: password123

## 🔧 Configuration

### Rate Limiting
Configure rate limits in `app/Http/Kernel.php`:
- Admin login: 5 attempts per minute
- User actions: 120 requests per minute
- Code redemption: 3 attempts per 10 minutes

### Session Security
```env
SESSION_ENCRYPT=true
SESSION_LIFETIME=60
SESSION_EXPIRE_ON_CLOSE=true
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
```

## 📚 API Documentation

### Authentication Endpoints
```
POST /admin/login - Admin authentication
POST /user/login - User authentication
POST /logout - Logout (both guards)
```

### User Management (Admin)
```
GET /admin/users - List all users
POST /admin/users - Create new user
PUT /admin/users/{id} - Update user
DELETE /admin/users/{id} - Soft delete user
```

### Point System
```
GET /admin/points/{user} - Get user points
POST /admin/points/add - Add points to user
POST /admin/points/deduct - Deduct points from user
GET /user/points - Get current user points
```

### Code Management
```
GET /admin/codes - List all codes
POST /admin/codes - Create new code
PUT /admin/codes/{id} - Update code
DELETE /admin/codes/{id} - Delete code
POST /user/redeem - Redeem code
```

## 🧪 Testing

### Run Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run with coverage
php artisan test --coverage
```

### Test Database
Tests use SQLite in-memory database by default. Configure in `phpunit.xml`.

## 🚀 Deployment

### Production Setup
1. **Server Requirements**: Ensure PHP 8.2+, MySQL, and web server
2. **Dependencies**: Run `composer install --no-dev --optimize-autoloader`
3. **Environment**: Set `APP_ENV=production` and `APP_DEBUG=false`
4. **Cache**: Run optimization commands:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
5. **Assets**: Build production assets with `npm run build`
6. **Security**: Configure HTTPS and secure headers

### Maintenance Commands
```bash
# Clear expired codes
php artisan app:cleanup-expired-codes

# Clear application cache
php artisan cache:clear

# Generate sitemap (if needed)
php artisan sitemap:generate
```

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Policies/            # Authorization policies
│   ├── Providers/           # Service providers
│   └── Helper/              # Helper classes
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   └── web.php             # Web routes
└── public/                 # Public assets
```

## 🔒 Security

Please review `SECURITY.md` for detailed security guidelines and best practices.

### Security Features
- Rate limiting on sensitive endpoints
- CSRF protection on all forms
- Input validation and sanitization
- SQL injection prevention
- Secure session management
- Audit logging for admin actions

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation
- Use meaningful commit messages

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Contact the development team
- Check the documentation

## 🏗️ Roadmap

- [ ] API versioning
- [ ] Advanced analytics dashboard
- [ ] Mobile app integration
- [ ] Email notifications
- [ ] Advanced reporting features
- [ ] Multi-language support

---

**Built with ❤️ using Laravel**

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
