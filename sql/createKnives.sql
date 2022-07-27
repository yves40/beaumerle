SET AUTOCOMMIT = 0;
START TRANSACTION READ WRITE;

DELETE FROM bomerle.knives;

INSERT INTO bomerle.knives(
  knvlabel,
  knvcollectionid,
  knvstatus,
  knvprice,
  knvdesc,
  knvmanche,
  knvtotlength,
  knvbladelength,
  knvweight
) 
VALUES (
  'RAHAN100', 1, 20, 400, 
  'Acier 14C28N forgé par maitre Yoda',
  'Chêne breton de la forêt des druides',
  180, 90, 345
);

INSERT INTO bomerle.knives SET
  knvlabel = 'RAHAN101',
  knvcollectionid = 2,
  knvstatus = 20,
  knvprice = 450,
  knvdesc = 'Acier 14C28N forgé par maitre Ratoon Von Courpières',
  knvmanche = 'Mitre en laiton et plaquette en ébène',
  knvtotlength = 190,
  knvbladelength = 90,
  knvweight = 300
;
INSERT INTO bomerle.knives SET
  knvlabel = 'RAHAN102',
  knvcollectionid = 3,
  knvstatus = 20,
  knvprice = 450,
  knvdesc = 'Acier 293PK forgé par Darth Vador',
  knvmanche = 'Mitre en laiton et plaquette en ébène',
  knvtotlength = 190,
  knvbladelength = 90,
  knvweight = 300
;
INSERT INTO bomerle.knives SET
  knvlabel = 'RAMBO103',
  knvcollectionid = 4,
  knvstatus = 20,
  knvprice = 450,
  knvdesc = 'Lame Acieropération spéciale forgé par Rambo',
  knvmanche = 'Mitre en laiton et plaquette en ébène',
  knvtotlength = 210,
  knvbladelength = 100,
  knvweight = 500
;

COMMIT;
