# Machine Monitoring System

### Deployment steps
1. Set production environment variables
2. Run `composer install --optimize-autoloader --no-dev`

### How To Use?
1. First Before Running, Type Comand "php artisan machine:monitor --setup"
2. To Adding Manualy Data use "php artisan machine:monitor --add-reading {mechine_id}
3. To Adding readings mechine for randomly data use "php artisan machine:monitor --simulate {count} ->default 10
4. To Check Status (Report) use "php artisan machine:monitor --status"
5. If U Confiusing Use The Comand "php artisan machine:monitor --help"

**Built with ❤️ using Laravel Framework**
