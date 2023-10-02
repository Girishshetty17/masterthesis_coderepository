#!/bin/bash
sudo apt-get update
sudo apt install apache2 -y
sudo apt install unzip
sudo systemctl enable apache2
cd /var/www/html
sudo rm -rf index.html
sudo wget https://retrodiner.s3.amazonaws.com/retrodiner.zip
sudo unzip retrodiner.zip
sudo rm -rf retrodiner.zip
sudo mv retrodiner/* .
sudo systemctl start apache2
sudo apt install php libapache2-mod-php php-mysql -y
sudo apt install mysql-server -y