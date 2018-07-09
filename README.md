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

##  Features

This default web page is located at  /var/www/html directory.
Navigate to this directory in a terminal window and copy the python-web.tar file 

## Directories

```sh
/var/www $ 
├───  html
│   ├─── src
│   └───...
```

### Installation

You will need the follows tools:

- [FileZilla](https://filezilla-project.org/)
- [Putty](https://putty.org/)

#### Manual installer
```sh
$ sudo apt-get update
$ sudo apt-get install apache2 -y
$ sudo apt-get install php libapache2-mod-php -y
$ sudo chmod 777 /home/pi/servicecom/config.json
$ sudo tar -xvf python-web.tar
```
