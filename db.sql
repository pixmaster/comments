

CREATE TABLE Comments (
  CommentID int(20) unsigned NOT NULL auto_increment,
  UserID    int(10) unsigned NOT NULL,
  ProductID int(10) unsigned NOT NULL,
  CommentText   text,
  SaleDate      varchar(255),
  StrongPoints  varchar(255),
  WeakPoints    varchar(255),
  Analogs       varchar(255),
  Pic1          varchar(255),
  Pic2          varchar(255),
  Pic3          varchar(255),
  CommentOpen   ENUM ('0','1') default '0',
  CommentDate   datetime,
  PRIMARY KEY  (CommentID),
  KEY (UserID,ProductID)
) TYPE=MyISAM;

CREATE TABLE Users (
  UserID int(20) unsigned NOT NULL auto_increment,
  Login  varchar(255) NOT NULL,
  Pwd    varchar(255) NOT NULL,
  Name   varchar(255),
  Email  varchar(255),
  PRIMARY KEY  (UserID)
) TYPE=MyISAM;

CREATE TABLE Rating (
  RatingID  int(20) unsigned NOT NULL auto_increment,
  UserID    int(20) unsigned NOT NULL,
  ProductID int(11) unsigned NOT NULL,
  Rating   enum('0','1','2','3','4','5') default '0',
  PRIMARY KEY  (RatingID),
  KEY (UserID,ProductID)
) TYPE=MyISAM;
