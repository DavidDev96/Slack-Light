-- DROP database Slack;
-- CREATE database Slack;
-- use Slack;

-- CREATE TABLE User (
--   id INT(11) PRIMARY KEY,
--   userName VARCHAR(20),
--   passwordHash char(40),
--   registered bool,
--   deleted bool
-- );

-- CREATE TABLE Channel (
--   id INT(11) PRIMARY KEY,
--   title VARCHAR(255) NOT NULL,
--   description VARCHAR(255) NOT NULL,
--   CREATEdById INT(11) NOT NULL,
--   deleted bool NOT NULL,
--   markedAsImportant bool NOT NULL,
--   FOREIGN KEY (CREATEdById) REFERENCES User(id)
-- );

-- CREATE TABLE Message (
--   id INT(11) PRIMARY KEY,
--   channelId  INT(11) NOT NULL,
--   content VARCHAR(255) NOT NULL,
--   CREATEdById INT(11) NOT NULL,
--   CREATEdAt timestamp NOT NULL,
--   deleted bool NOT NULL,
--   read bool NOT NULL,
--   PRIMARY KEY (id),
--   -- CONSTRAINT `message_channelId` FOREIGN KEY (`channelId`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
--   -- CONSTRAINT `message_CREATEdById` FOREIGN KEY (`CREATEdById`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
-- );

-- CREATE TABLE Channel_User (
--   id INT(11) PRIMARY KEY,
--   channelId INT(11),
--   userId INT(11),
--   deleted bool,
--   PRIMARY KEY (id),
--   -- CONSTRAINT `channel_user_channelId` FOREIGN KEY (`channelId`) REFERENCES `channel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
-- );
DROP DATABASE slack;
DROP DATABASE Slack;
CREATE DATABASE Slack;
use Slack;

CREATE TABLE User (
    id INT auto_increment PRIMARY KEY,
    userName VARCHAR(30),
    passwordHash char(40),
    registered BOOL, 
    deleted BOOL
);

CREATE TABLE Channel (
    id INT auto_increment PRIMARY KEY,
    channelName VARCHAR(20),
    description VARCHAR(255),
    createdBy INT,
    createdAt DATETIME,
    markedAsImportant BOOL,
    deleted BOOL,
    FOREIGN KEY (createdBy) REFERENCES User(id)
);

CREATE TABLE Message (
    id INT auto_increment PRIMARY KEY,
    channelId INT,
    fromId INT,
    content VARCHAR(100),
    messageTime DATETIME,
    deleted BOOL,
    FOREIGN KEY (channelId) REFERENCES Channel(id),
    FOREIGN KEY (fromId) REFERENCES User(id)
);

CREATE TABLE ChannelUser(
    id INT,
    channelId INT,
    userId INT,
    joinedAt DATETIME,
    deleted BOOL,
    PRIMARY KEY (channelId, id),
    FOREIGN KEY (userId) REFERENCES User(id),
    FOREIGN KEY (channelId) REFERENCES Channel(id)
);
