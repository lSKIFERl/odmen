CREATE TABLE cappapride (
    id int(10) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128) ,
    login varchar(128) ,
    password varchar(128) ,
    email varchar(32) ,
    birth text(128) ,
    sex varchar(8) ,
    limbs int(4) ,
    sverh text(128) ,
    bio text(128) ,
    consent varchar(8) ,
    PRIMARY KEY (id)
);