# Group2Final
Repository for Group 2 of the Final Project

# Link to Deployment:
http://138.197.129.215/Group2Final/login.php



## Deployment Notes

   The RADs software system was developed and tested on FreeBSD 11.0-RELEASE.  That said, it will work in any environment with mysql57, php56, and apache24, and appropriate modules, but the details for such a deployment are not listed here.


### Operating System


   FreeBSD was chosen for its reliability, security, and predictability in updates and releases.  It is a proven solution as shown by its use by companies such as Netflix and Yahoo, incidentally accounting for more than a third of all internet traffic in 2015 in north america. (www.applieinsider.com) 

### Database and Webserver


   mysql and apache, again, were chosen as they are proven solutions and offer functionality in terms load balancing and high availability for future growth.  This functionality is not yet implemented.


### Butt Services Provider


   For development and testing DigitalOcean was used, but any will do.


### Step-by-Step Setup


   Get to your root shell.  This is on you.


Update and upgrade the operating system and install pkg if you do not want to compile ports from source.  The commands are as follows:

	freebsd-update fetch
	freebsd-update install
	pkg
	pkg update
	pkg upgrade

To at any time se what installed:

	pkg info

Install a text editor, git, and other packages:

	pkg install nano git apache24 mysql57-server php56 php56-json php56-mysql php56-mysqli php56-pdo php56-pdo_mysql php56-session mod_php56


Services in FreeBSD are started and stopped like in post-systemd linux.  For example “service apache24 restart” will restart.  Services to be started on boot are in the file “/etc/rc.conf”.  Do the following:
Add “ apache24_enable=”YES” “ to /etc/rc.conf
Add “ mysql_enable=”YES” “ to /etc/rc.conf
You will now be able to start the services, or reboot to start the services.
Run to create a php config file:

	cp /usr/local/etc/php.ini-production /usr/local/etc/php.ini


Add php functionality to apache configuration
Add the following to /usr/local/etc/apache24/Includes/php.conf


	<IfModule dir_module>
	    DirectoryIndex index.php index.html
	   <FilesMatch "\.php$">
	        SetHandler application/x-httpd-php
	    </FilesMatch>
	    <FilesMatch "\.phps$">
	        SetHandler application/x-httpd-php-source
	    </FilesMatch>
	</IfModule>


Restart apache

	service apache24 restart


On the first start of mysql, it creates the hidden file in root’s home directory called “.mysql_secret”.  You can find this with ll.  cat it to see the preset password.  You will use this to log in to the mysql shell.

Log into the mysql shell with “ mysql -u root -p ”.  Enter or paste the password from before.  Now you may, and should, choose to change the password.  Create a database “db” and source the .sql provided in the github repository.  The default credentials in the application for testing are “root”:””

Navigate to /usr/local/www/apache24/data/ and git clone the github repository.  The application will now be running.
