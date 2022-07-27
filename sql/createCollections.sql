SET AUTOCOMMIT = 0;
START TRANSACTION READ WRITE;

DELETE FROM bomerle.knivescollections;

INSERT INTO bomerle.knivescollections( knvcollection ) 
    VALUES ('Cuisine');
INSERT INTO bomerle.knivescollections( knvcollection ) 
    VALUES ('Chasse');
INSERT INTO bomerle.knivescollections( knvcollection ) 
    VALUES ('Sport');
INSERT INTO bomerle.knivescollections( knvcollection ) 
    VALUES ('Pliant');

COMMIT;

SELECT * FROM bomerle.knivescollections;
