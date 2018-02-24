CREATE TABLE Daaira (
  DaairaId INT PRIMARY KEY,
  Name     VARCHAR(255)
)
  ENGINE = INNODB;


CREATE TABLE Area (
  AreaId   INT PRIMARY KEY,
  DaairaId INT,
  Name     VARCHAR(255),
  CONSTRAINT FOREIGN KEY (DaairaId) REFERENCES Daaira (DaairaId)
)
  ENGINE = INNODB;

CREATE TABLE AdministrativeArea (
  AdministrativeAreaId INT PRIMARY KEY,
  DaairaId             INT,
  Name                 VARCHAR(255),
  CONSTRAINT FOREIGN KEY (DaairaId) REFERENCES Daaira (DaairaId)
)
  ENGINE = INNODB;

CREATE TABLE Location
(
  LocationId           INT PRIMARY KEY,
  AdministrativeAreaId INT,
  Name                 VARCHAR(255),
  CONSTRAINT FOREIGN KEY (AdministrativeAreaId) REFERENCES AdministrativeArea (AdministrativeAreaId)
)
  ENGINE = INNODB;

CREATE TABLE Kalam (
  KalamId    INT PRIMARY KEY,
  LocationId INT,
  Number     INT,
  CONSTRAINT FOREIGN KEY (LocationId) REFERENCES Location (LocationId),
  INDEX (Number)
)
  ENGINE = INNODB;

CREATE TABLE User (
  UserId   INT PRIMARY KEY,
  Username VARCHAR(255),
  Password TEXT,
  KalamId  INT,
  Type     INT,
  PlaceId  INT,
  CONSTRAINT FOREIGN KEY (KalamId) REFERENCES Kalam (KalamId)
)
  ENGINE = INNODB;

CREATE TABLE Vote (
  VoteId        INT PRIMARY KEY AUTO_INCREMENT,
  KalamId       INT,
  ElectorNumber INT
)
  ENGINE = INNODB;

CREATE TABLE ElectorList (
  ElectorListId INT PRIMARY KEY,
  Name          VARCHAR(255),
  Color         VARCHAR(255)
)
  ENGINE = INNODB;

CREATE TABLE Candidate (
  CandidateId   INT PRIMARY KEY,
  ElectorListId INT,
  KalamId       INT,
  Number        INT,
  DaairaId      INT,
  Name          VARCHAR(255),
  CONSTRAINT FOREIGN KEY (KalamId) REFERENCES Kalam (KalamId),
  CONSTRAINT FOREIGN KEY (ElectorListId) REFERENCES ElectorList (ElectorListId),
  INDEX (NUMBER)
)
  ENGINE = INNODB;

CREATE TABLE ElectorListResult (
  ElectorListResultId INT PRIMARY KEY AUTO_INCREMENT,
  ElectorListId       INT,
  kalamId             INT,
  Votes               INT,
  CONSTRAINT FOREIGN KEY (ElectorListId) REFERENCES ElectorList (ElectorListId),
  CONSTRAINT FOREIGN KEY (kalamId) REFERENCES Kalam (KalamId)
)
  ENGINE = INNODB;

CREATE TABLE CandidateResult (
  CandidateResultId   INT PRIMARY KEY AUTO_INCREMENT,
  ElectorListResultId INT,
  CandidateId         INT,
  Votes               INT,
  CONSTRAINT FOREIGN KEY (ElectorListResultId) REFERENCES ElectorListResult (ElectorListResultId),
  CONSTRAINT FOREIGN KEY (CandidateId) REFERENCES Candidate (CandidateId)
)
  ENGINE = INNODB;

