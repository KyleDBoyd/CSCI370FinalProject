/* Kyle Boyd
Elliot Wyman
CSCI 370
Final Project */

/* Drop Tables Before Creating */

drop table user;
drop table photographer;
drop table group;
drop table album;
drop table photo;
drop table location;
drop table userHasPhoto;
drop table userPermissionsPhoto;
drop table photographerTakePhoto;
drop table photographerFrequentLocation;
drop table photoTakenAtLocation;
drop table userCreateAlbum;
drop table groupHasUser;
drop table groupHasPermissionAlbum;
drop table groupHasPermissionPhoto;
drop table albumHasPhoto;

create table user (
    userId TEXT primary key,
    password TEXT,
    name TEXT,
    dateJoined NUMERIC,
    gender TEXT,
    profilePicData TEXT, 
    favoritePhotoType TEXT,
    favoriteGenre TEXT,
    country TEXT
);

create table photographer (
    photographerID TEXT,
    level TEXT,
    favLocation TEXT,
    FOREIGN KEY(photographerID) REFERENCES user(userID)    
);

create table group (
    groupID INTEGER primary key AUTOINCREMENT,
    name TEXT,
    leader TEXT,
    type TEXT,
    size INTEGER,
    groupPictureData TEXT
);

create table album (
    albumId INTEGER AUTOINCREMENT,
    type TEXT,
    name TEXT,
    dateCreated NUMERIC
);

create table photo (
    photoID INTEGER AUTOINCREMENT,
    type TEXT,
    genre TEXT,
    name TEXT,
    date NUMERIC,
    imgType TEXT,
    imgData TEXT
);

create table location (
    locationId INTEGER AUTOINCREMENT,
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
    userID INTEGER,
    photoId INTEGER,
    FOREIGN KEY(userID) REFERENCES user(userID),  
    FOREIGN KEY(photoID) REFERENCES photo(photoID)   
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
)

create table photoTakenAtLocation (
    photoId INTEGER,
    locationID INTEGER,
    FOREIGN KEY(photoID) REFERENCES photo(photoID),
    FOREIGN KEY(locationID) REFERENCES location(locationID)
);

create table userCreateAlbum (
    userID INTEGER,
    albumID INTEGER,
    FOREIGN KEY(userID) REFERENCES user(userID),
    FOREIGN KEY(albumID) REFERENCES album(albumID)
);

create table groupHasUser (
    groupID INTEGER,
    userID INTEGER,
    FOREIGN KEY(userID) REFERENCES user(userID),
    FOREIGN KEY(groupID) REFERENCES group(groupID)
);

create table groupHasPermissionAlbum (
    groupID INTEGER,
    albumID INTEGER,
    FOREIGN KEY(groupID) REFERENCES group(groupID),
    FOREIGN KEY(albumID) REFERENCES album(albumID)
);

create table groupHasPermissionPhoto (
    photoId INTEGER,
    groupID INTEGER,
    FOREIGN KEY(photoID) REFERENCES photo(photoID),
    FOREIGN KEY(groupID) REFERENCES group(groupID)
);

create table albumHasPhoto (
    albumID INTEGER,
    groupID INTEGER,
    FOREIGN KEY(albumID) REFERENCES album(albumID),
    FOREIGN KEY(groupID) REFERENCES group(groupID)
);
