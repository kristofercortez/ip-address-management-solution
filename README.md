# Instructions

---

## Install Tools

Download and install the following tools:

- **Xampp** from https://www.apachefriends.org/xampp-files/8.1.4/xampp-windows-x64-8.1.4-1-VS16-installer.exe
- **Composer** from https://getcomposer.org/Composer-Setup.exe
- **Git** from https://github.com/git-for-windows/git/releases/download/v2.35.1.windows.2/Git-2.35.1.2-64-bit.exe
- **Node JS** from https://nodejs.org/dist/v16.14.2/node-v16.14.2-x64.msi
- **Yarn** from https://classic.yarnpkg.com/latest.msi
---

## Clone and Setup

1. Run **Xampp** and start **Apache** and **MySQL**
2. Open git bash or any git emulator then go to C:\xampp\htdocs by running **cd /c/xampp/htdocs/**
3. Run the following command to clone the project from 'https://github.com/kristofercortez/ip-address-management-solution.git'

   `git clone https://github.com/kristofercortez/ip-address-management-solution.git`

4. Go to C:\xampp\apache\conf\extra\ and open **httpd-vhosts.conf**
5. Add the following:
   
   `<VirtualHost *:80>
      DocumentRoot "C:/xampp/htdocs/ip-address-management-solution/public"
      ServerName ip-address-management-solution.local
   </VirtualHost>`

6. Open and Run **Notepad** as administrator
7. Click **file** and **open**
8. Locate and open your local **hosts** file from **C:\Windows\System32\drivers\etc** (On the lower right corner, change file type to **All file**)
9. Add the following:

   `127.0.0.1		ip-address-management-solution.local`

10. Restart(stop and start) Xampp **apache server**
11. Open git bash to cloned repository directory
12. Run the following command:
    - **composer install**
    - **yarn install**
    - **yarn dev**
15. Run the following to create database and tables.
    - **php bin/console doctrine:database:create**
    - **php bin/console doctrine:migrations:migrate**
16. To generate a user, run **php bin/console doctrine:fixtures:load**
17. You can now access the site
    - App http://ip-address-management-solution.local/
    Username: **admin**, Password: **admin**
    - DB http://localhost/phpmyadmin/ 
