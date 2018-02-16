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

CREATE TABLE Kalam (
  KalamId INT PRIMARY KEY,
  AreaId  INT,
  Number  INT,
  CONSTRAINT FOREIGN KEY (AreaId) REFERENCES Area (AreaId),
  INDEX (Number)
)
  ENGINE = INNODB;

CREATE TABLE User (
  UserId   INT PRIMARY KEY,
  Username VARCHAR(255),
  Password TEXT,
  KalamId  INT,
  CONSTRAINT FOREIGN KEY (KalamId) REFERENCES Kalam (KalamId)
)
  ENGINE = INNODB;

CREATE TABLE Vote (
  VoteId        INT PRIMARY KEY AUTO_INCREMENT,
  KalamNumber   INT,
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
  Name          VARCHAR(255),
  CONSTRAINT FOREIGN KEY (KalamId) REFERENCES Kalam (KalamId),
  CONSTRAINT FOREIGN KEY (ElectorListId) REFERENCES ElectorList (ElectorListId),
  INDEX (NUMBER)
)
  ENGINE = INNODB;

CREATE TABLE ElectorListResult (
  ElectorListResultId INT PRIMARY KEY AUTO_INCREMENT,
  ElectorListId    INT,
  kalamId           INT,
  Votes             INT,
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

