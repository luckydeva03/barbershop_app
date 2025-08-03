# Security Guidelines - Backoffice Haircut

## Implemented Security Measures

### 1. Authentication & Authorization
- **Multi-Guard Authentication**: Separate guards for admin and user authentication
- **Policy-Based Authorization**: Role-based access control using Laravel policies
- **Session Security**: 
  - Session encryption enabled
  - Secure cookie settings
  - Short session lifetime (60 minutes)
  - Session invalidation on logout

### 2. Password Security
- **Hashed Passwords**: All passwords are automatically hashed using bcrypt
- **Strong Password Requirements**: Minimum 8 characters (implement in validation)
- **Rate Limiting**: Login attempts are limited to prevent brute force attacks

### 3. Rate Limiting
- **Login Protection**: 5 attempts per minute for admin login
- **API Endpoints**: Various rate limits based on sensitivity:
  - Redeem codes: 3 attempts per 10 minutes
  - Reviews: 10 attempts per hour
  - Point management: 30 attempts per minute (admin only)

### 4. Data Protection
- **Mass Assignment Protection**: All models use `$fillable` and `$guarded`
- **Soft Deletes**: Critical data is soft deleted for audit trails
- **Input Validation**: Form Request classes for all user inputs
- **CSRF Protection**: Enabled for all state-changing operations

### 5. Database Security
- **SQL Injection Prevention**: Using Eloquent ORM and prepared statements
- **Database Indexes**: Proper indexing for performance and security
- **Foreign Key Constraints**: Maintain data integrity

### 6. Error Handling
- **Secure Error Messages**: Generic error messages in production
- **Comprehensive Logging**: All security events are logged
- **Exception Handling**: Specific exception types for better error management

### 7. Business Logic Security
- **Point System Integrity**: 
  - Transaction-based point operations
  - Balance validation before deductions
  - Audit trail for all point changes
- **Code Redemption Security**:
  - Expiration date validation
  - Usage limit enforcement
  - Rate limiting for redemption attempts

## Security Configuration

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
SESSION_ENCRYPT=true
SESSION_LIFETIME=60
SESSION_EXPIRE_ON_CLOSE=true
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
```

### Rate Limiting Rules
- Admin login: 5 attempts per minute
- User actions: 120 requests per minute
- Redeem codes: 3 attempts per 10 minutes
- Reviews: 10 submissions per hour
- OAuth: 10 attempts per minute

## Security Best Practices

### For Developers
1. **Never expose sensitive data** in error messages
2. **Always validate input** using Form Request classes
3. **Use policies** for authorization checks
4. **Log security events** for monitoring
5. **Keep dependencies updated** regularly

### For Deployment
1. **Use HTTPS** in production
2. **Set secure headers** (CSP, HSTS, etc.)
3. **Regular database backups**
4. **Monitor logs** for suspicious activities
5. **Update secrets** regularly

### For Maintenance
1. **Run `php artisan app:cleanup-expired-codes`** regularly
2. **Monitor failed login attempts**
3. **Review audit logs** periodically
4. **Update dependencies** with `composer audit`

## Security Monitoring

### Log Files to Monitor
- `storage/logs/laravel.log` - Application errors and security events
- Web server access logs - Failed requests and suspicious patterns
- Database logs - Unusual query patterns

### Alerts to Setup
- Multiple failed login attempts from same IP
- Unusual point transactions
- Mass redemption attempts
- Database errors or timeouts

## Incident Response

### In Case of Security Breach
1. **Immediately change** all passwords and API keys
2. **Review recent logs** for attack patterns
3. **Invalidate all sessions**: `php artisan session:clear`
4. **Update security configurations**
5. **Notify affected users** if necessary

### Recovery Steps
1. **Backup current state**
2. **Run security audit**: `composer audit`
3. **Update all dependencies**
4. **Review and strengthen weak points**
5. **Implement additional monitoring**

## Security Checklist

- [ ] HTTPS enabled in production
- [ ] Environment variables secured
- [ ] Rate limiting configured
- [ ] CSRF protection enabled
- [ ] Input validation implemented
- [ ] Error handling secured
- [ ] Logging configured
- [ ] Session security enabled
- [ ] Database security hardened
- [ ] Regular security updates scheduled

## Contact

For security issues, please contact the development team immediately.
Do not disclose security vulnerabilities publicly.
