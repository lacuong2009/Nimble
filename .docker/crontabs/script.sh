#!/bin/bash
/usr/local/bin/php /app/artisan schedule:run >> /app/storage/logs/cron.log 2>&1