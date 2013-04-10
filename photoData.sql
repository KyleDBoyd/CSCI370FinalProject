/* 
Kyle Boyd
Elliot Wyman
CSCI 370
Final Project 

Populate Tables 
*/

INSERT INTO user VALUES('bob','b','bob',10,'male','sports','canada');
INSERT INTO user VALUES('chad47','c','chad',10,'male','beaches','russia');
INSERT INTO user VALUES('jane','j','jane',10,'female','sports','canada');
INSERT INTO user VALUES('kyle','k','kyle',10,'male','black and white','japan');
INSERT INTO user VALUES('george','g','george',10,'male','I hate pictures','china');
INSERT INTO user VALUES('alizah','l','alizah',10,'female','I love everything','india');
INSERT INTO user VALUES('elliot','w','elliot',10,'male','Beer Pictures!','germany');

INSERT INTO photographer VALUES('alizah','professional','water');
INSERT INTO photographer VALUES('chad47','amateur','city');
INSERT INTO photographer VALUES('george','amateur','town');
INSERT INTO photographer VALUES('bob','amateur','farm');

INSERT INTO photoGroup VALUES(1,'bestGroupEver','bob',1);
INSERT INTO photoGroup VALUES(2,'Group1','chad47',1);
INSERT INTO photoGroup VALUES(3,'Photographers','george',1);

INSERT INTO album VALUES(1,'beach','myBeachAlbum',5);
INSERT INTO album VALUES(2,'citypics','myCityAlbum',5);
INSERT INTO album VALUES(3,'town','myTownAlbum',5);

INSERT INTO photo VALUES(1,'photo1','beach',5,'images/photo1.jpg');
INSERT INTO photo VALUES(2,'photo2','beach',5,'images/photo2.jpg');
INSERT INTO photo VALUES(3,'photo3','beach',5,'images/photo3.jpg');
INSERT INTO photo VALUES(4,'photo4','beach',5,'images/photo4.jpg');
INSERT INTO photo VALUES(5,'photo5','beach',5,'images/photo5.jpg');
INSERT INTO photo VALUES(6,'photo6','beach',5,'images/photo6.jpg');
INSERT INTO photo VALUES(7,'photo7','beach',5,'images/photo7.jpg');
INSERT INTO photo VALUES(8,'photo8','beach',5,'images/photo8.jpg');
INSERT INTO photo VALUES(9,'photo9','beach',5,'images/photo9.jpg');
INSERT INTO photo VALUES(10,'photo10','beach',5,'images/photo10.jpg');
INSERT INTO photo VALUES(11,'photo11','beach',5,'images/photo11.jpg');
INSERT INTO photo VALUES(12,'photo12','beach',5,'images/photo12.jpg');
INSERT INTO photo VALUES(13,'photo13','beach',5,'images/photo13.jpg');
INSERT INTO photo VALUES(14,'photo14','beach',5,'images/photo14.jpg');
INSERT INTO photo VALUES(15,'photo15','beach',5,'images/photo15.jpg');
INSERT INTO photo VALUES(16,'photo16','beach',5,'images/photo16.jpg');
INSERT INTO photo VALUES(17,'photo17','beach',5,'images/photo17.jpg');
INSERT INTO photo VALUES(18,'photo18','beach',5,'images/photo18.jpg');
INSERT INTO photo VALUES(19,'photo19','beach',5,'images/photo19.jpg');
INSERT INTO photo VALUES(20,'photo20','beach',5,'images/photo20.jpg');
INSERT INTO photo VALUES(21,'photo21','beach',5,'images/photo21.jpg');
INSERT INTO photo VALUES(22,'photo22','beach',5,'images/photo22.jpg');
INSERT INTO photo VALUES(23,'photo23','beach',5,'images/photo23.jpg');

INSERT INTO location VALUES(1,'water','911 fake st','japan');
INSERT INTO location VALUES(2,'city','9451 fake st','canada');
INSERT INTO location VALUES(3,'town','91451 fake st','japan');
INSERT INTO location VALUES(4,'farm','9123 fake st','russia');
INSERT INTO location VALUES(5,'school','9123 kangaroo st','australia');
INSERT INTO location VALUES(6,'church','9123 nottingham st','england');
INSERT INTO location VALUES(7,'mall','9123 xiao st','china');
INSERT INTO location VALUES(8,'museum','9123 french st','france');
INSERT INTO location VALUES(9,'mountains','9123 mountain st','russia');

INSERT INTO userHasPhoto VALUES('bob',1);
INSERT INTO userHasPhoto VALUES('bob',2);
INSERT INTO userHasPhoto VALUES('bob',3);
INSERT INTO userHasPhoto VALUES('bob',4);
INSERT INTO userHasPhoto VALUES('bob',5);
INSERT INTO userHasPhoto VALUES('bob',6);
INSERT INTO userHasPhoto VALUES('bob',7);
INSERT INTO userHasPhoto VALUES('chad47',12);
INSERT INTO userHasPhoto VALUES('chad47',4);
INSERT INTO userHasPhoto VALUES('chad47',17);
INSERT INTO userHasPhoto VALUES('chad47',18);
INSERT INTO userHasPhoto VALUES('chad47',19);
INSERT INTO userHasPhoto VALUES('george',20);
INSERT INTO userHasPhoto VALUES('george',11);
INSERT INTO userHasPhoto VALUES('george',23);
INSERT INTO userHasPhoto VALUES('george',18);
INSERT INTO userHasPhoto VALUES('george',14);
INSERT INTO userHasPhoto VALUES('george',13);
INSERT INTO userHasPhoto VALUES('jane',11);
INSERT INTO userHasPhoto VALUES('jane',10);
INSERT INTO userHasPhoto VALUES('jane',19);

INSERT INTO userPermissionsPhoto VALUES('bob',1);
INSERT INTO userPermissionsPhoto VALUES('bob',2);
INSERT INTO userPermissionsPhoto VALUES('bob',3);
INSERT INTO userPermissionsPhoto VALUES('bob',4);
INSERT INTO userPermissionsPhoto VALUES('bob',5);
INSERT INTO userPermissionsPhoto VALUES('bob',6);
INSERT INTO userPermissionsPhoto VALUES('bob',7);
INSERT INTO userPermissionsPhoto VALUES('chad47',12);
INSERT INTO userPermissionsPhoto VALUES('chad47',4);
INSERT INTO userPermissionsPhoto VALUES('chad47',17);
INSERT INTO userPermissionsPhoto VALUES('chad47',18);
INSERT INTO userPermissionsPhoto VALUES('chad47',19);
INSERT INTO userPermissionsPhoto VALUES('george',20);
INSERT INTO userPermissionsPhoto VALUES('george',11);
INSERT INTO userPermissionsPhoto VALUES('george',23);
INSERT INTO userPermissionsPhoto VALUES('george',18);
INSERT INTO userPermissionsPhoto VALUES('george',14);
INSERT INTO userPermissionsPhoto VALUES('george',13);
INSERT INTO userPermissionsPhoto VALUES('jane',11);
INSERT INTO userPermissionsPhoto VALUES('jane',10);
INSERT INTO userPermissionsPhoto VALUES('jane',19);

INSERT INTO userCreateAlbum VALUES('bob',1);
INSERT INTO userCreateAlbum VALUES('jane',2);
INSERT INTO userCreateAlbum VALUES('chad47',3);

INSERT INTO userPermissionsAlbum VALUES('bob',1);
INSERT INTO userPermissionsAlbum VALUES('jane',2);
INSERT INTO userPermissionsAlbum VALUES('chad47',3);
    
INSERT INTO groupHasUser VALUES (1,'bob');
INSERT INTO groupHasUser VALUES (1,'chad47');
INSERT INTO groupHasUser VALUES (1,'kyle');
INSERT INTO groupHasUser VALUES (2,'chad47');
INSERT INTO groupHasUser VALUES (3,'george');
INSERT INTO groupHasUser VALUES (3,'jane');

INSERT INTO groupHasPermissionAlbum VALUES (2,3);
INSERT INTO groupHasPermissionAlbum VALUES (1,3);
INSERT INTO groupHasPermissionAlbum VALUES (1,1);
INSERT INTO groupHasPermissionAlbum VALUES (3,2);

INSERT INTO groupHasPermissionPhoto VALUES (1,1);
INSERT INTO groupHasPermissionPhoto VALUES (2,1);
INSERT INTO groupHasPermissionPhoto VALUES (4,1);
INSERT INTO groupHasPermissionPhoto VALUES (5,1);
INSERT INTO groupHasPermissionPhoto VALUES (6,1);
INSERT INTO groupHasPermissionPhoto VALUES (2,2);
INSERT INTO groupHasPermissionPhoto VALUES (4,2);
INSERT INTO groupHasPermissionPhoto VALUES (11,2);
INSERT INTO groupHasPermissionPhoto VALUES (15,2);
INSERT INTO groupHasPermissionPhoto VALUES (17,2);
INSERT INTO groupHasPermissionPhoto VALUES (18,2);
INSERT INTO groupHasPermissionPhoto VALUES (19,2);
INSERT INTO groupHasPermissionPhoto VALUES (20,2);
INSERT INTO groupHasPermissionPhoto VALUES (21,2);
INSERT INTO groupHasPermissionPhoto VALUES (23,2);
INSERT INTO groupHasPermissionPhoto VALUES (1,3);
INSERT INTO groupHasPermissionPhoto VALUES (2,3);
INSERT INTO groupHasPermissionPhoto VALUES (4,3);
INSERT INTO groupHasPermissionPhoto VALUES (5,3);
INSERT INTO groupHasPermissionPhoto VALUES (12,3);
INSERT INTO groupHasPermissionPhoto VALUES (13,3);

INSERT INTO albumHasPhoto VALUES (1,1);
INSERT INTO albumHasPhoto VALUES (1,2);
INSERT INTO albumHasPhoto VALUES (1,4);
INSERT INTO albumHasPhoto VALUES (1,5);
INSERT INTO albumHasPhoto VALUES (1,6);
INSERT INTO albumHasPhoto VALUES (2,2);
INSERT INTO albumHasPhoto VALUES (2,4);
INSERT INTO albumHasPhoto VALUES (2,11);
INSERT INTO albumHasPhoto VALUES (2,15);
INSERT INTO albumHasPhoto VALUES (2,17);
INSERT INTO albumHasPhoto VALUES (2,18);
INSERT INTO albumHasPhoto VALUES (2,19);
INSERT INTO albumHasPhoto VALUES (2,20);
INSERT INTO albumHasPhoto VALUES (2,21);
INSERT INTO albumHasPhoto VALUES (2,22);
INSERT INTO albumHasPhoto VALUES (3,1);
INSERT INTO albumHasPhoto VALUES (3,2);
INSERT INTO albumHasPhoto VALUES (3,4);
INSERT INTO albumHasPhoto VALUES (3,5);
INSERT INTO albumHasPhoto VALUES (3,12);
INSERT INTO albumHasPhoto VALUES (3,14);



