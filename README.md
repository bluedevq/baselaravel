## Project Information
```
- Laravel: 8.x
- Apache: 2.4
- PHP: 7.4 
- MySQL: 8.x
- Composer: 2.1.x
```

## Installer
```
0. clone project, setting virtual host, create database
1. run: composer install 
2. run and change setting config: cp .env.example .env (change setting APP_URL, DB, MAIL ...)
3. run: php artisan key:generate
4. clear cache: php artisan optimize:clear
5. create storage link: php artisan storage:link
6. run migrate: php artisan migrate
```

## Add the ec2-user user to the apache group and set permission folder and file project
```
sudo usermod -a -G apache ec2-user
sudo chown -R ec2-user:apache /var/www
sudo chmod 2775 /var/www && find /var/www -type d -exec sudo chmod 2775 {} \;
sudo find /var/www -type f -exec sudo chmod 0664 {} \;
```

## Permission log and cache folder
```
sudo chmod -R 755 bootstrap/cache
sudo chmod -R 755 storage
```

## Clear cache and restart queue
```
sudo -u apache php artisan optimize:clear 
sudo -u apache php artisan queue:restart
```

## Cron 
- Zip file logs: 
  ```
  sudo -u apache php artisan zip_log
  sudo -u apache php artisan zip_log month
  ```
- Dump database (mysql, postgresql)
  ```
  sudo -u apache php artisan dump_db
  ```
