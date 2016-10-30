DROP TABLE IF EXISTS permissiongroup;
DROP TABLE IF EXISTS permission;
DROP TABLE IF EXISTS files;
DROP TABLE IF EXISTS user;

CREATE TABLE user
	(
	userid int AUTO_INCREMENT, 
	username varchar(255),
	hashedpassword varchar(255),
	usertypeid int,
	activeuserflag int,
	PRIMARY KEY (userid)
	);

CREATE TABLE permissiongroup
	(
	id int AUTO_INCREMENT, 
	permissionid int,
	PRIMARY KEY (id)
	);

CREATE TABLE permission
	(
	id int AUTO_INCREMENT, 
	permission_name int,
	PRIMARY KEY (id)
	);

CREATE TABLE files
	(
	path varchar(100),
	userid int REFERENCES user(userid),
	date datetime
	);
