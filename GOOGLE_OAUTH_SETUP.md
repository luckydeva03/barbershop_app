# Google OAuth Setup Guide

## Overview
This guide will help you set up Google OAuth authentication for the Backoffice Haircut application.

## Step 1: Create Google Cloud Project

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Click on "New Project" or select an existing project
3. Give your project a name (e.g., "Backoffice Haircut")
4. Click "Create"

## Step 2: Create OAuth 2.0 Credentials

1. Go to "APIs & Services" > "Credentials"
2. Click "Create Credentials" > "OAuth client ID"
3. If prompted, configure the OAuth consent screen:
   - Choose "External" user type
   - Fill in required fields:
     - App name: "Backoffice Haircut"
     - User support email: your email
     - Developer contact email: your email
   - Add scopes: email, profile
   - Save and continue

4. For OAuth client ID:
   - Application type: "Web application"
   - Name: "Backoffice Haircut Web Client"
   - Authorized JavaScript origins: 
     ```
     http://localhost
     http://127.0.0.1:8000
     ```
   - Authorized redirect URIs:
     ```
     http://localhost/auth/google/callback
     http://127.0.0.1:8000/auth/google/callback
     ```
   - Click "Create"

## Step 3: Update Environment Configuration

1. Copy the Client ID and Client Secret from Google Cloud Console
2. Update your `.env` file:

```env
# Google OAuth Configuration
GOOGLE_CLIENT_ID=your-actual-google-client-id
GOOGLE_CLIENT_SECRET=your-actual-google-client-secret
GOOGLE_REDIRECT_URI=http://localhost/auth/google/callback
```

## Step 4: Test the Integration

1. Clear Laravel cache:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. Visit the login page and test Google OAuth:
   - Go to `/login`
   - Click "Continue with Google"
   - Complete the OAuth flow

## Features Implemented

✅ **Google OAuth Login/Register**: Users can authenticate using their Google account  
✅ **Profile Photo Sync**: User's Google profile photo is automatically synced  
✅ **Account Linking**: Existing users can link their Google account  
✅ **Provider Badge**: Dashboard shows when user is logged in via Google  
✅ **Fallback Avatar**: Default avatar shown if no Google photo available  

## Security Notes

- Keep your Client Secret secure
- Never commit actual credentials to version control
- Use environment variables for all sensitive configuration
- Consider using HTTPS in production

## Troubleshooting

### Common Issues:

1. **Redirect URI mismatch**: Ensure the redirect URI in Google Console matches exactly
2. **Invalid client**: Double-check your Client ID and Secret
3. **Cache issues**: Clear Laravel config cache after updating .env

### Debug Steps:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Verify .env configuration
3. Ensure database migration has run
4. Test with fresh browser session

## Production Deployment

When deploying to production:

1. Update redirect URIs in Google Console to include production domain
2. Update `.env` with production URLs
3. Ensure HTTPS is configured
4. Update `GOOGLE_REDIRECT_URI` to production callback URL
