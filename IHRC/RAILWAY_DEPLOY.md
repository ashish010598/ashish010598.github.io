# Railway Deployment Guide

## Steps to Deploy:

1. **Push to GitHub:**

   ```bash
   git add .
   git commit -m "Add PHP admin panel"
   git push origin main
   ```

2. **Connect to Railway:**

   - Visit: https://railway.app
   - Connect your GitHub repository
   - Deploy automatically

3. **Environment Variables:**
   - Set PHP_VERSION=8.0
   - PORT will be set automatically

## Access:

- Your site will be available at: `https://your-app.railway.app`
- Admin panel: `https://your-app.railway.app/admin/login.php`
