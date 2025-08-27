#!/bin/bash

echo "🔄 Restarting WordPress with increased upload limits..."

# Stop existing containers
echo "📦 Stopping existing containers..."
docker-compose down

# Remove existing WordPress container to ensure new config is applied
echo "🧹 Removing existing WordPress container..."
docker-compose rm -f wordpress

# Start containers with new configuration
echo "🚀 Starting containers with new upload limits..."
docker-compose up -d

# Wait for WordPress to be ready
echo "⏳ Waiting for WordPress to be ready..."
sleep 10

# Check if WordPress is running
if docker-compose ps | grep -q "wordpress.*Up"; then
    echo "✅ WordPress is running with increased upload limits!"
    echo "🌐 Access your site at: http://localhost:8000"
    echo ""
    echo "📋 New upload limits:"
    echo "   - Maximum file size: 64MB"
    echo "   - Maximum post size: 64MB"
    echo "   - Memory limit: 256MB"
    echo "   - Execution time: 300 seconds"
    echo ""
    echo "📸 You should now be able to upload your large images (menu_hero.jpg, wine.JPG)"
else
    echo "❌ WordPress failed to start. Check the logs:"
    docker-compose logs wordpress
fi 