FROM php:8.2-cli-alpine

WORKDIR /app

# Copy all project files
COPY . /app

# Expose default HTTP port
ENV PORT=8080
EXPOSE 8080

# Start standalone PHP server with Northstar router
CMD php -S 0.0.0.0:${PORT:-8080} tests/router.php
