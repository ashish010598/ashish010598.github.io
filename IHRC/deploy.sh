#!/bin/bash

# IHRC Deployment Script for Railway

echo "🚀 Deploying IHRC Team Management System to Railway..."

# Check if git is initialized
if [ ! -d ".git" ]; then
    echo "📦 Initializing git repository..."
    git init
    git add .
    git commit -m "Initial commit: IHRC Team Management System"
fi

# Check if Railway CLI is installed
if ! command -v railway &> /dev/null; then
    echo "❌ Railway CLI not found. Please install it first:"
    echo "   npm install -g @railway/cli"
    echo "   or visit: https://railway.app/cli"
    exit 1
fi

# Login to Railway (if not already logged in)
echo "🔐 Checking Railway authentication..."
railway login

# Create new project or link existing
echo "📁 Setting up Railway project..."
railway link

# Add environment variables
echo "⚙️  Setting environment variables..."
railway variables set PHP_VERSION=8.0

# Deploy to Railway
echo "🚀 Deploying to Railway..."
railway up

echo "✅ Deployment complete!"
echo ""
echo "📝 Your application will be available at:"
echo "   https://your-app.up.railway.app"
echo ""
echo "🔐 Admin panel access:"
echo "   URL: https://your-app.up.railway.app/admin/login.php"
echo "   Username: admin"
echo "   Password: ihrc2025"
echo ""
echo "📋 Next steps:"
echo "   1. Update your team page links to point to the new domain"
echo "   2. Test the admin panel functionality"
echo "   3. Update any hardcoded URLs in your code"
