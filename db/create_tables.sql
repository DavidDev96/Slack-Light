DROP DATABASE Slack;
CREATE DATABASE Slack;
use Slack;

CREATE TABLE User (
    id INT auto_increment PRIMARY KEY,
    userName VARCHAR(30),
    passwordHash char(80),
    deleted BOOL
);

CREATE TABLE Channel (
    id INT auto_increment PRIMARY KEY,
    channelName VARCHAR(20),
    description VARCHAR(255),
    createdBy INT,
    createdAt DATETIME,
    deleted BOOL,
    FOREIGN KEY (createdBy) REFERENCES User(id)
);

CREATE TABLE Message (
    id INT auto_increment PRIMARY KEY,
    channelId INT,
    createdBy VARCHAR(30),
    content VARCHAR(100),
    title VARCHAR(30),
    createdAt DATETIME,
    isEdited BOOL,
    deleted BOOL,
    FOREIGN KEY (channelId) REFERENCES Channel(id),
    FOREIGN KEY (fromId) REFERENCES User(id)
);

CREATE TABLE ImportantMessage (
    id INT auto_increment PRIMARY KEY,
    messageId INT,
    markedById INT,
    FOREIGN KEY (messageId) REFERENCES Message(id)
);

CREATE TABEL ReadMessage (
    id INT auto_increment PRIMARY KEY,
    messageId INT,
    readById INT,
    FOREIGN KEY (messageId) REFERENCES Message(id)
    FOREIGN KEY (readById) REFERENCES User(id)
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
