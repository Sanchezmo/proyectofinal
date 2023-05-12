
CREATE DATABASE IF NOT EXISTS Recetas;
USE Recetas;
DROP TABLE IF EXISTS Votos;
DROP TABLE IF EXISTS Coments;
DROP TABLE IF EXISTS Recipes;
DROP TABLE IF EXISTS LogrosUser;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Media;
DROP TABLE IF EXISTS Logros;
DROP TABLE IF EXISTS Users;


CREATE TABLE Categories(      
    CategoryID INTEGER PRIMARY KEY AUTO_INCREMENT,
    CategoryName VARCHAR(50),
    Description VARCHAR(255)
);
CREATE TABLE Users(      
    CustomerID INTEGER PRIMARY KEY AUTO_INCREMENT,
    CustomerName VARCHAR(50),
    Premium VARCHAR(2),
    Admin VARCHAR(2),
    Email VARCHAR(25),
    Pass VARCHAR(25)
    
);
CREATE TABLE Logros(      
    LogroID INTEGER PRIMARY KEY AUTO_INCREMENT,
    Logro VARCHAR(100),
    LogroDescription VARCHAR(250)
);
CREATE TABLE Media(
    MediaID INTEGER PRIMARY KEY AUTO_INCREMENT,
    MediaPath VARCHAR(250),
    MediaSize INTEGER,
    MediaName VARCHAR(100),
    Extension VARCHAR(100),
    OwnerID INTEGER,
    FOREIGN KEY (OwnerID) REFERENCES Users (CustomerID)ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Recipes(
    RecipeID INTEGER PRIMARY KEY AUTO_INCREMENT,
    RecipeName VARCHAR(50),
    Recipe VARCHAR(255),
    MediaID INTEGER,
    CategoryID INTEGER,
    OwnerID INTEGER,
    Premium VARCHAR(2),
	FOREIGN KEY (CategoryID) REFERENCES Categories (CategoryID)ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (MediaID) REFERENCES Media (MediaID)ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (OwnerID) REFERENCES Users (CustomerID)ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Coments(      
    ComentID INTEGER PRIMARY KEY AUTO_INCREMENT,
    Coment VARCHAR(50),
    OwnerID INTEGER,
    RecipeID INTEGER,
    FOREIGN KEY (RecipeID) REFERENCES Recipes (RecipeID)ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (OwnerID) REFERENCES Users (CustomerID)ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE LogrosUser(      
    LogroUserID INTEGER PRIMARY KEY AUTO_INCREMENT,
    OwnerID INTEGER,
    LogroID INTEGER,
    FOREIGN KEY (OwnerID) REFERENCES Users (CustomerID)ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (LogroID) REFERENCES Logros (LogroID)ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Votos(
    VotoID INTEGER PRIMARY KEY AUTO_INCREMENT,
    OwnerID INTEGER,
    RecipeID INTEGER,
    FOREIGN KEY (OwnerID) REFERENCES Users (CustomerID)ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (RecipeID) REFERENCES Recipes (RecipeID)ON DELETE CASCADE ON UPDATE CASCADE

);


INSERT INTO Users (CustomerName, Email, Pass,Admin,Premium) VALUES("admin", "admin@admin.com", "admin","SI","SI");
INSERT INTO Users (CustomerName, Email, Pass,Admin,Premium) VALUES("user", "user@admin.com", "user","NO","NO");
INSERT INTO Users (CustomerName, Email, Pass,Admin,Premium) VALUES("userpremium", "userpremium@admin.com", "user","NO","SI");
INSERT INTO Categories (CategoryName, Description) VALUES("Cocina Española","Platos tipicos de España");
INSERT INTO Media(MediaPath ,MediaSize,MediaName, Extension,OwnerID) VALUES("../uploadssalchicha.jpg",15555000,"uploadssalchicha","jpg",1);
INSERT INTO Recipes (RecipeName,Recipe,MediaID,CategoryID,Premium,OwnerID)VALUES ("Tortilla de patata","Se frien patatas y luego se baten huevos , se mezcla y a la sarten",1,1,"NO",1);
INSERT INTO Logros (Logro,LogroDescription)VALUES("Participativo","Participa aportando 3 recetas");
INSERT INTO Logros (Logro,LogroDescription)VALUES(" Muy Participativo","Participa aportando 10 recetas");
INSERT INTO Logros (Logro,LogroDescription)VALUES("Dios culinario","Participa aportando 50 recetas");
INSERT INTO Logros (Logro,LogroDescription)VALUES("Buen aporte","Recibe 1 voto con tu receta");
INSERT INTO Logros (Logro,LogroDescription)VALUES("Muy rico","Recibe 5 voto con tu receta");
INSERT INTO Logros (Logro,LogroDescription)VALUES("Tu sí que vales","Recibe 50 voto con tu receta");