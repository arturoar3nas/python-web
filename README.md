# Servicecom Web Config

- [Features](#Usage)
- [Directories](#Usage)
- [Installation](#Usage)
- [Manual installer](#Usage)
- [Usage](#Usage)

## Service Communication Manager
This web config page do the below stuff:
- Set the Wi-Fi Netowork
- Set the Apn for 3g Communication
- Set the Time for scan the main application
- Enable the Bluethoot
- Enable Wi-fi Network
- Enable 3G Communication
- Others

### Installation

You will need the follows tools:

- [FileZilla](https://filezilla-project.org/)
- [Putty](https://putty.org/)

#### Manual installer

First Download and install the below stuff:
```sh
$ sudo apt-get update
$ sudo apt-get install apache2 -y
$ sudo apt-get install php libapache2-mod-php -y
$ sudo chmod 777 /home/pi/servicecom/config.json
```
When you will install apache the default web page is just an HTML file on the filesystem. It is located at  /var/www/html/index.html.

Then you will need remove index.html file 
```sh
$ rm /var/www/html/index.html
```
Download from this Repository https://github.com/arturoar3nas/python-web
the python-web-master.zip file and copy this in the path /var/www/html/ using
FileZilla.
Then you will need uncompress the .zip file 
```sh
$ unzip python-web-master.zip
```
At this point you can acces to the web page through the navigator to the local host direction.
How i know the local host direction? Easy, just type:
```sh
$ hostname -I
```
Then you will look the login page and insert for admin:
User: Admin
Password: Admin

For no admin seasion insert:
User: User
Password: User

For Edit Password and User change the file password.json
```sh
{
  "Admin_User": "admin",
  "Admin_Password": "admin",
  "Regular_User": "user",
  "Regular_Password": "user",
}
```
You also need to do the following things

I use apache2 as an example:
```sh
$ cp /lib/systemd/system/apache2.service /etc/systemd/system/
```
Now we edit the PrivateTmp=true to PrivateTmp=false:
```sh
$ grep PrivateTmp /etc/systemd/system/apache2.service
PrivateTmp=true
```
```sh
$ nano /etc/systemd/system/apache2.service
```
```sh
$ grep PrivateTmp /etc/systemd/system/apache2.service
PrivateTmp=false
```
And at the end, restart the apache2 process:
```sh
$ systemctl restart apache2.service
```
and 
```sh
sudo visudo
```
And copy in the last line
```sh
www-data ALL=NOPASSWD: ALL
```
