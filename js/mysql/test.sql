-- Active: 1781179135193@@127.0.0.1@3306@world
SHOW TABLES;
SELECT * FROM city;
SELECT * FROM country;  
SELECT * FROM country WHERE NAME = 'netherlands';
SELECT * FROM country WHERE NAME = 'netherlands' OR NAME = 'italy';

SHOW tables;

SELECT code, name FROM country;


SELECT * FROM city WHERE CountryCode = 'NLD';

SELECT * FROM country WHERE continent = 'Africa';

SELECT * FROM countrylanguage WHERE language = 'english' AND isofficial = 'T';


SELECT name  FROM country ORDER BY LifeExpectancy ASC LIMIT 10;

SELECT name FROM country WHERE Continent = 'Africa' ORDER BY Population ASC LIMIT 10;

SELECT name FROM city ORDER BY Population DESC LIMIT 10;

SELECT * from countrylanguage;

SELECT Language, ROUND(SUM((c.Population * cl.Percentage) / 100)) AS TotalSpeakers
FROM countrylanguage cl
JOIN country c ON cl.CountryCode = c.Code
GROUP BY cl.Language
ORDER BY TotalSpeakers ASC
LIMIT 10;

