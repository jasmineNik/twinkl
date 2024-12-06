1. Clone the repo 
    git clone https://github.com/jasmineNik/twinkl.git
2. Copy .env.example file to .env
    cp .env.example .env
3. Uncomment the follwoing fields in .env file and add your creds 
    MYSQL_HOST
    MYSQL_ROOT_PASSWORD
    MYSQL_DATABASE
    MYSQL_USER
    MYSQL_PASSWORD 
    PMA_HOST=${MYSQL_HOST}
    PMA_USE
    PMA_PASSWORD=${MYSQL_ROOT_PASSWORD}
4. Run docker compose build
5. Run docker compose up -d
6. Enter docker exec -it TwinklServer bash
7. Run composer install
8. Genetare the key 
   php artisan key:generate
9. Run migrations 
    php artisan migrate
10. Run database seeding 
    php artisan db:seed
11. The phpmyadmin could be found in http://localhost:8009 
12. For requesting please use http://localhost:8008/api
13. Add your creds for email sending in .env file
