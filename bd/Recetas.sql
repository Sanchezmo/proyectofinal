
CREATE DATABASE IF NOT EXISTS Recetas;
USE Recetas;
DROP TABLE IF EXISTS Recipes;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Users;
CREATE TABLE Categories
(      
    CategoryID INTEGER PRIMARY KEY AUTO_INCREMENT,
    CategoryName VARCHAR(50),
    Description VARCHAR(255)
);
CREATE TABLE Recipes(
    RecipeID INTEGER PRIMARY KEY AUTO_INCREMENT,
    RecipeName VARCHAR(50),
    Recipe VARCHAR(255),
    Imagen VARCHAR(100),
    Extension VARCHAR(30),
    CategoryID INTEGER,
    OwnerID INTEGER,
    Premium VARCHAR(2),
    votos INT(10),
	FOREIGN KEY (CategoryID) REFERENCES Categories (CategoryID)ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (OwnerID) REFERENCES Users (CustomerID)ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE Users(      
    CustomerID INTEGER PRIMARY KEY AUTO_INCREMENT,
    CustomerName VARCHAR(50),
    Premium VARCHAR(2),
    Admin VARCHAR(2),
    Email VARCHAR(25),
    Pass VARCHAR(25)
    
);
INSERT INTO Users (CustomerName, Email, Pass,Admin,Premium) VALUES("admin", "admin@admin.com", "admin","SI","SI");
INSERT INTO Users (CustomerName, Email, Pass,Admin,Premium) VALUES("user", "user@admin.com", "user","NO","NO");
INSERT INTO Users (CustomerName, Email, Pass,Admin,Premium) VALUES("userpremium", "userpremium@admin.com", "user","NO","SI");
INSERT INTO Categories (CategoryName, Description) VALUES("Cocina Española","Platos tipicos de España");
INSERT INTO Recipes (RecipeName,Recipe,Imagen,Extension,CategoryID,Premium)VALUES ("Tortilla de patata","Se frien patatas y luego se baten huevos , se mezcla y a la sarten","vacio","vacio",1,"NO");
