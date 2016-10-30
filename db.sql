DROP TABLE IF EXISTS permissiongroup;
DROP TABLE IF EXISTS permission;
DROP TABLE IF EXISTS files;
DROP TABLE IF EXISTS user;

CREATE TABLE user
	(
	id int AUTO_INCREMENT, 
	username varchar(255),
	hashedpassword varchar(255),
	usertypeid int,
	activeuserflag int,
	PRIMARY KEY (id)
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
	groupid int,
	path varchar(100),
	userid int REFERENCES user(id),
	date datetime,
	private BOOLEAN,
	PRIMARY KEY (groupid)
	);
