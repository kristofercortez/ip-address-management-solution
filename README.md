# Instructions

---

## Install Tools

Download and install the following tools:

- **Xampp** from https://www.apachefriends.org/xampp-files/8.1.4/xampp-osx-8.1.4-1-installer.dmg
- **Composer** from https://getcomposer.org/Composer-Setup.exe

---

## Clone and Setup

1. Run **Xampp** and start **Apache** and **MySQL**
2. Go to C:\xampp\htdocs and open git bash or any git emulator
3. Clone the project from 'https://github.com/kristofercortez/ip-address-management-solution.git' and checkout **master** branch
4. Go to C:\xampp\apache\conf\extra\ and open **httpd-vhosts.conf**
5. Add the following:
   
   `<VirtualHost *:80>
      DocumentRoot "C:/xampp/htdocs/ip-address-management-solution/public"
      ServerName ip-address-management-solution.local
   </VirtualHost>`

6. Open and Run **Notepad** as administrator
7. Click file and open
8. Locate and open your local hosts file from C:\Windows\System32\drivers\etc
9. Add the following:

   `127.0.0.1		ip-address-management-solution.local`

10. Restart Xampp **apache server**
11. Open git bash to repo directory
12. Run **composer install**
13. Run **yarn install**
14. Run **yarn dev**
15. Run the following to create database and tables.
    - Run **php bin/console doctrine:database:create**
    - Run **php bin/console doctrine:migrations:migrate**
16. To generate a user. Run **php bin/console doctrine:fixtures:load**
    - username: admin, password: admin
17. You can now access the site
    - App http://ip-address-management-solution.local/
    - DB http://localhost/phpmyadmin/ 
