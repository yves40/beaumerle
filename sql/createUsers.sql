SET AUTOCOMMIT = 0;
START TRANSACTION READ WRITE;

DELETE FROM bomerle.users;

INSERT INTO bomerle.users(usremail, usrpassword, usrpseudo) 
    VALUES ('y@free.fr','yyyyyy','yves77');
INSERT INTO bomerle.users(usremail, usrpassword, usrpseudo, usrrole, usrstatus) 
    VALUES ('ratoon@free.fr','yyyyyy','ratoon77', 10, 20);

COMMIT;

SELECT * FROM bomerle.users;
