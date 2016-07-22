
CREATE USER 'mk'@'localhost' IDENTIFIED BY 'b&ip8yourpasswordverysecurised&l'; 
GRANT USAGE ON *.* TO 'mk'@'localhost'; 
CREATE DATABASE IF NOT EXISTS mk ; 
GRANT ALL PRIVILEGES ON mk.* TO mk@'localhost';

