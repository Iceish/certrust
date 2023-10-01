#!/bin/sh

# https://github.com/Iceish/certrust

ARGC=$#
CMD="$1"

verify_requirements() {
	local count=$1
	if [ "$ARGC" -ne $count ]; then
		echo "error" "This command require \`$count\` argument."
		exit 1
	fi
}

case "$CMD" in
    "init" )
        verify_requirements 1
        echo "Certrust initialization.."
        php artisan config:clear
        php artisan config:cache
        php artisan key:generate
        php artisan migrate:refresh
        echo "🚀 Certrust is ready ! Visit http://localhost/ to get started."
        exit 0
    ;;
    *)
        echo "error" "Command \`$CMD\` not found."
        exit 1
esac


