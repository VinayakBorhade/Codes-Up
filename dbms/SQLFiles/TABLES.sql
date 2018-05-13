/*Schema of all 5 Tables used-*/

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    dp_ext varchar(10)
);
CREATE TABLE following(
 user_id INT,
 follower_id INT);
CREATE TABLE repositories_table(
 id INT PRIMARY KEY AUTO_INCREMENT,
 name VARCHAR(100),
 tags VARCHAR(100),
 description VARCHAR(100),
 username VARCHAR(50)
);
CREATE TABLE history_repositories_table(
 id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 activity VARCHAR(100),
 dt VARCHAR(100),
 username VARCHAR(50)
);
CREATE TABLE upload_data(
 id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 file_name VARCHAR(200),
 file_size VARCHAR(200),
 file_type VARCHAR(200),
 user_id VARCHAR(50),
 repo_name VARCHAR(50)
);
