1. go to server and take a pull in replica first
2. Test the entire site on replica first
3. If all features working fine then go to root directory cd ~
4. then run shell script /.golive.sh
5. then go to main root folder cd /var/www/html
6. then clear cache using belwo commands
    php artisan cache:clear
    php artisan config:cache
    php artisan config:clear
7. then test all features in live. 
# Energeios
