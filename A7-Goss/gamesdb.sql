create database if not exists gamesdb;
use gamesdb;

drop table if exists game;

create table game (
	gameID int,
    title varchar(40),
    genre varchar(25),
    company varchar(40),
    releaseDate Date,
    playerNum int,
    primary key (gameID)
);

insert into game values (1, "Bloodborne", "RPG", "From Software", "2015-03-15", 1);
insert into game values (2, "Hollow Knight", "Metroidvania", "Team Cherry", "2017-02-24", 1);
insert into game values (3, "EldenRing", "RPG", "From Software", "2022-02-25", 1);
insert into game values (4, "Overwatch 2", "FPS", "Blizzard", "2022-10-04", 10);
insert into game values (5, "Yakuza 0", "Action-Adventure", "Sega", "2015-03-12", 1);
insert into game values (6, "Doom 2016", "FPS", "Bethesda", "2016-05-13", 1);
insert into game values (7, "Metal Gear Rising: Revengance", "Action-Adventure", "Platinum Games", "2013-02-19", 1);
insert into game values (8, "Call of Duty: Black ops", "FPS", "Activision", "2010-11-9", 12);
insert into game values (9, "GTA: San Andreas", "Action-Adventure", "Rockstar Games", "2004-10-26", 1);
insert into game values (10, "Apex Legends", "Battle Royal", "Respawn Entertainment", "2019-02-04", 60);
insert into game values (11, "Frost Punk", "Strategy", "11 bit studios", "2018-04-24", 1);
insert into game values (12, "It takes two", "Adventure", "Hazelight Studios", "2021-03-25", 2);
insert into game values (13, "Dark Souls", "RPG", "From Software", "2011-09-22", 1);
insert into game values (14, "Rocket League", "Sports", "Psyonix", "2015-07-7", 8);
insert into game values (15, "Zelda: Ocarina of Time", "Action-Adventure", "Nintendo", "1998-11-21", 1);
insert into game values (16, "Halo 2", "FPS", "Bungie Inc.", "2004-11-09", 4);
insert into game values (17, "League of Legends", "Strategy", "Riot Games", "2009-10-27", 10);
insert into game values (18, "Team Fortess 2", "FPS", "Valve Corp", "2007-10-10", 12);
insert into game values (19, "Atelier Ryza", "RPG", "Gust", "2019-09-26", 1);
insert into game values (20, "Witcher 3: Wild Hunt", "Action-Adventure", "From Software", "2015-05-18", 1);
insert into game values (21, "God of War 2018", "Action-Adventure", "Santa Monica Studio", "2018-04-20", 1);
insert into game values (22, "Overcooked", "Strategy", "The Label", "2016-08-03", 4);

