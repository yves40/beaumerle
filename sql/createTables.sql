USE `bomerle` ;
-- -----------------------------------------------------
-- Table bomerle.users
-- usrstatus 10 inscrit en attente
-- usrstatus 20 inscrit
-- usrstatus 30 suspendu
-- usrstatus 40 supprimé
--
-- usrrole 10 Administrator
-- usrrole 20 Contact
-- -----------------------------------------------------
DROP TABLE IF EXISTS bomerle.users ;
CREATE TABLE IF NOT EXISTS bomerle.users (
  usrid INT(11) NOT NULL AUTO_INCREMENT,
  usremail VARCHAR(128) NOT NULL UNIQUE,
  usrpassword VARCHAR(256) NOT NULL,
  usrpseudo VARCHAR(64) NOT NULL UNIQUE,
  usrstatus INT(11) NOT NULL DEFAULT 10,
  usrrole INT(11) NOT NULL DEFAULT 20,
  usrimage VARCHAR(64) NOT NULL DEFAULT 'defaultuserpicture.png',
  PRIMARY KEY (usrid))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table bomerle.knives
-- knvstatus 10 Vendu
-- knvstatus 20 Disponible internet
-- knvstatus 30 Disponible boutique
-- knvstatus 40 Sur commande
-- -----------------------------------------------------
DROP TABLE IF EXISTS bomerle.knives ;
CREATE TABLE IF NOT EXISTS bomerle.knives (
  knvid INT(11) NOT NULL AUTO_INCREMENT,
  knvlabel VARCHAR(64) NOT NULL UNIQUE,
  knvcollectionid int(11) NOT NULL,
  knvstatus INT(11) NOT NULL DEFAULT 20,
  knvprice FLOAT(7,2) NOT NULL,
  knvdesc VARCHAR(256) NOT NULLs,
  knvcomment VARCHAR(256) DEFAULT '',
  knvmanche VARCHAR(64) NOT NULL,
  knvtotlength int(16),
  knvbladelength int(16),
  knvweight int(16),
  knvimage VARCHAR(128) NOT NULL DEFAULT 'defaultuserpicture.png',
  PRIMARY KEY (knvid)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS bomerle.knivescollections ;
CREATE TABLE IF NOT EXISTS bomerle.knivescollections (
  knvmodelid INT(11) NOT NULL AUTO_INCREMENT,
  knvcollection VARCHAR(64) NOT NULL UNIQUE,
  PRIMARY KEY (knvmodelid))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Foreign Keys
-- -----------------------------------------------------
ALTER TABLE bomerle.knives ADD CONSTRAINT fk_knives_to_knivescollections FOREIGN KEY (knvcollectionid) 
  REFERENCES bomerle.knivescollections(knvmodelid);


