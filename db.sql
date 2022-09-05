CREATE TABLE IF NOT EXISTS tbl_login (
    email varchar(50) PRIMARY KEY,
    password varchar(10) NOT NULL,
    type varchar(8) NOT NULL,
    status boolean NOT NULL DEFAULT 1
);

INSERT INTO tbl_login (
    email,password,type,status ) 
VALUES ('admin@site.com','nigga123','admin',1);

CREATE TABLE IF NOT EXISTS tbl_customer (
    customer_id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(50) NOT NULL,
    customer_fname varchar(15) NOT NULL,
    customer_lname varchar(15) NOT NULL,
    customer_district varchar(18) NOT NULL,
    customer_pincode varchar(6) NOT NULL,
    customer_city varchar(20) NOT NULL,
    customer_house_name varchar(20) NOT NULL,
    customer_phone varchar(10) NOT NULL,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (email) REFERENCES tbl_login(email)
);

CREATE TABLE IF NOT EXISTS tbl_staff (
    staff_id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(50) NOT NULL,
    staff_fname varchar(15) NOT NULL,
    staff_lname varchar(15) NOT NULL,
    staff_district varchar(18) NOT NULL,
    staff_pincode varchar(6) NOT NULL,
    staff_city varchar(20) NOT NULL,
    staff_house_name varchar(20) NOT NULL,
    staff_phone varchar(10) NOT NULL,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (email) REFERENCES tbl_login(email)
);
