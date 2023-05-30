# Project GYM with Laravel MVC
<hr>
FTP Transfer file untuk preview di website : </br>
---------------------------------------------</br>
Host Name : files.000webhost.com </br>
Port      : 21 </br>
Username  : gymmvc </br>
password  : GYMmvc@123</br>
<hr>
Spesification :</br>
PHP       : 8.0</br>
Laravel   : v10.1.1</br>
Database  : MySQL 10.5.16-MariaDB</br>
---------:: LOKAL KOMPUTER ::-----------------------------------</br>
&emsp;&emsp;&emsp;&emsp; Host      : localhost</br>
&emsp;&emsp;&emsp;&emsp; DBname    : gymmvc</br>
&emsp;&emsp;&emsp;&emsp; Username  : root</br>
&emsp;&emsp;&emsp;&emsp; Password  : </br>
&emsp;&emsp;&emsp;&emsp; Server charset: UTF-8 Unicode (utf8)</br>
<hr>
---------:: PERSIAPAN ::----------------------------------------</br>
Langkah :</br>
1. Clone Repository Github (https://github.com/shienji/GYMmvc.git)</br>
2. copy-paste .env.example ditempat yang sama</br>
&emsp;&emsp;ganti dengan nama .env</br>
&emsp;&emsp;Ubah konfigurasi seperti catatan diatas.</br>
3. Buka Terminal </br>
&emsp;&emsp;Ketikkan Kode Berikut : </br>
&emsp;&emsp;-> Composer install </br>
&emsp;&emsp;-> php artisan migrate:fresh --seed </br>
4. Test aplikasi dengan menjalankan perintah : </br>
&emsp;&emsp;-> php artisan serve </br>
5. Jalankan Web Browser (chrome,mozilla) </br>
&emsp;&emsp;Buka alamat Berikut : </br>
&emsp;&emsp;-> http://localhost:8000/ </br> 

---------:: Reconfigure apache ::----------------------------------------</br>
1. sudo chgrp -R www-data /var/www/html/GYMmvc </br>
2. sudo chmod -R 775 /var/www/html/GYMmvc/storage </br>
3. cd /etc/apache2/sites-available </br>
4. sudo nano gymmvc.conf </br>
&emsp;&emsp;copy paste kode berikut : 
&emsp;&emsp;<VirtualHost *:80> </br>
&emsp;&emsp;&emsp;ServerName thedomain.com </br>
&emsp;&emsp;&emsp;ServerAdmin webmaster@thedomain.com </br>
&emsp;&emsp;&emsp;DocumentRoot /var/www/html/example/public </br>
            </br>
&emsp;&emsp;&emsp;<Directory /var/www/html/example> </br>
&emsp;&emsp;&emsp;&emsp;AllowOverride All </br>
&emsp;&emsp;&emsp;</Directory> </br>
&emsp;&emsp;&emsp;ErrorLog ${APACHE_LOG_DIR}/error.log </br>
&emsp;&emsp;&emsp;CustomLog ${APACHE_LOG_DIR}/access.log combined </br>
&emsp;&emsp;</VirtualHost> </br>
5. sudo a2dissite 000-default.conf </br>
6. sudo a2ensite gymmvc </br>
7. sudo a2enmod rewrite </br>
8. sudo systemctl restart apache2 </br>