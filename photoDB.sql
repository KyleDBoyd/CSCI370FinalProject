/* Kyle Boyd
Elliot Wyman
CSCI 370
Final Project */

/* Drop Tables Before Creating */

drop table if exists user;
drop table if exists photographer;
drop table if exists photoGroup;
drop table if exists album;
drop table if exists photo;
drop table if exists location;
drop table if exists userHasPhoto;
drop table if exists userPermissionsPhoto;
drop table if exists userPermissionsAlbum;
drop table if exists photographerTakePhoto;
drop table if exists photographerFrequentLocation;
drop table if exists photoTakenAtLocation;
drop table if exists userCreateAlbum;
drop table if exists groupHasUser;
drop table if exists groupHasPermissionAlbum;
drop table if exists groupHasPermissionPhoto;
drop table if exists albumHasPhoto;

create table user (
    userID TEXT primary key,
    password TEXT,
    name TEXT,
    dateJoined NUMERIC,
    gender TEXT,
    profilePicData TEXT, 
    favoriteGenre TEXT,
    country TEXT
);

create table photographer (
    photographerID TEXT,
    level TEXT,
    favLocation TEXT,
    FOREIGN KEY(photographerID) REFERENCES user(userID)    
);

create table photoGroup (
    groupID INTEGER primary key AUTOINCREMENT,
    name TEXT,
    leader TEXT,
    size INTEGER
);

create table album (
    albumID INTEGER primary key AUTOINCREMENT,
    type TEXT,
    name TEXT,
    dateCreated NUMERIC
);

create table photo (
    photoID INTEGER primary key AUTOINCREMENT,
    genre TEXT,
    name TEXT,
    date NUMERIC,
    imgName TEXT,
    imgType TEXT,
    imgPath TEXT,
    imgSize INTEGER   
);

create table location (
    locationId INTEGER primary key AUTOINCREMENT,
    type TEXT,
    address TEXT,
    country TEXT
);

create table userHasPhoto (
    userID INTEGER,
    photoId INTEGER,
    FOREIGN KEY(userID) REFERENCES user(userID),  
    FOREIGN KEY(photoID) REFERENCES photo(photoID)   
);

create table userPermissionsPhoto (
    userID TEXT,
    photoId INTEGER,
    FOREIGN KEY(userID) REFERENCES user(userID),  
    FOREIGN KEY(photoID) REFERENCES photo(photoID)   
);
create table userPermissionsAlbum (
    userID TEXT,
    albumID INTEGER,
    FOREIGN KEY(userID) REFERENCES user(userID),  
    FOREIGN KEY(albumID) REFERENCES album(albumID)   
);

create table photographerTakePhoto (
    photoId INTEGER,
    photographerID INTEGER,
    FOREIGN KEY(photoID) REFERENCES photo(photoID),
    FOREIGN KEY(photographerID) REFERENCES photographer(photographerID)
);

create table photographerFrequentLocation (
    photographerID INTEGER,
    locationID INTEGER,
    FOREIGN KEY(photographerID) REFERENCES photographer(photographerID),
    FOREIGN KEY(locationID) REFERENCES location(locationID)
);

create table photoTakenAtLocation (
    photoId INTEGER,
    locationID INTEGER,
    FOREIGN KEY(photoID) REFERENCES photo(photoID),
    FOREIGN KEY(locationID) REFERENCES location(locationID)
);

create table userCreateAlbum (
    userID TEXT,
    albumID INTEGER,
    FOREIGN KEY(userID) REFERENCES user(userID),
    FOREIGN KEY(albumID) REFERENCES album(albumID)
);

create table groupHasUser (
    groupID INTEGER,
    userID TEXT,
    FOREIGN KEY(userID) REFERENCES user(userID),
    FOREIGN KEY(groupID) REFERENCES photoGroup(groupID)
);

create table groupHasPermissionAlbum (
    groupID INTEGER,
    albumID INTEGER,
    FOREIGN KEY(groupID) REFERENCES photoGroup(groupID),
    FOREIGN KEY(albumID) REFERENCES album(albumID)
);

create table groupHasPermissionPhoto (
    photoId INTEGER,
    groupID INTEGER,
    FOREIGN KEY(photoID) REFERENCES photo(photoID),
    FOREIGN KEY(groupID) REFERENCES photoGroup(groupID)
);

create table albumHasPhoto (
    albumID INTEGER,
    groupID INTEGER,
    FOREIGN KEY(albumID) REFERENCES album(albumID),
    FOREIGN KEY(groupID) REFERENCES photoGroup(groupID)
);
