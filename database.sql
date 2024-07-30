CREATE DATABASE form;
USE form;

CREATE TABLE uporabnik(
  id int PRIMARY KEY AUTO_INCREMENT,
  ime nvarchar(20) NOT NULL UNIQUE,
  email nvarchar(20) NOT NULL UNIQUE,
  geslo nvarchar(32) NOT NULL,
  admin boolean default false,
  profileImage nvarchar(500) default 'notFound.png',
  disabled boolean default false
);

CREATE TABLE post(
  id int PRIMARY KEY AUTO_INCREMENT,
  naslov nvarchar(100) NOT NULL,
  vsebina nvarchar(10000) NOT NULL,
  slika nvarchar(500),
  likes int default 0,
  disslikes int DEFAULT 0,
  komentarji int DEFAULT 0,
  avtor int,
  FOREIGN KEY(avtor) REFERENCES uporabnik(id),
  cas TIME DEFAULT now(),
  datum DATE default CURRENT_DATE
);

CREATE TABLE komentar(
  id int PRIMARY KEY AUTO_INCREMENT,
  autor int,
  FOREIGN KEY (autor) REFERENCES uporabnik(id),
  targetPost int,
  FOREIGN KEY (targetPost) REFERENCES post(id),
  vsebina nvarchar(1000) NOT NULL
);

CREATE TABLE plike(
  postID int,
  autorID int,
  FOREIGN KEY(postID) REFERENCES post(id),
  FOREIGN KEY(autorID) REFERENCES uporabnik(id),
  kind nvarchar(10)
);

INSERT INTO uporabnik(ime, email, geslo, admin) VALUES (
  'Admin', 'Adminmail@gmail.com', 'admin', true
);

