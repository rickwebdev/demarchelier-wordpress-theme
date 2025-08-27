#!/bin/bash

# WordPress WP-CLI Helper Script
# Usage: ./wp-cli.sh [wp-cli-command]

if [ $# -eq 0 ]; then
    echo "Usage: $0 [wp-cli-command]"
    echo "Examples:"
    echo "  $0 --info"
    echo "  $0 plugin list"
    echo "  $0 user list"
    echo "  $0 core version"
    exit 1
fi

# Run WP-CLI command
docker-compose -f docker-compose-simple.yml run --rm wp-cli wp "$@" 