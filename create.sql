create table resource (
	id integer unsigned not null auto_increment,
	name varchar(255),
	firstname varchar(255),
	alias varchar(30),
	efficiency integer,
	available boolean,
	primary key (id)
);

