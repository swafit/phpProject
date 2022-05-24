CREATE TABLE users (
  usersId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  fullName varchar(128)NOT NULL,
  usersName varchar(128) NOT NULL,
  usersEmail varchar(128) NOT NULL,
  twoFactorEnabled BOOLEAN DEFAULT FALSE,
  twoFactorCodeSecret varchar(255),
  usersPwd varchar(128) NOT NULL
);