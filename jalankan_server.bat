@echo off
echo Menjalankan Server CMS ppi-web...
start http://localhost:8000/admin
c:\xampp\php\php.exe artisan serve
pause
