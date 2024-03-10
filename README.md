# Organizing application
This application helps you organize all your stuff.

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Requirements](#requirements)
- [How to setup database](#how-to-setup-database)
  - [Import database](#import-database)
  - [Add users](#add-users)
- [License](#license)

## Introduction
A mobile friendly webapplication, that can help you remember where your stuff is at. This project started out when my basement was full of boxes and I wanted a way to find out where a specific item was. It is still in development, so not everything is working
properly yet, and the namings might be a bit off.

## Features
- Mobile friendly.
- Web-based and accessible from everywhere (when portforwarding). 
- Simple and intuitive layout.
- Easy to add, edit and remove items/boxes.

## Requirements
- Server to host the application.
- Database.

## How to setup database
### Import database
Im using phpMyAdmin but this should be the same for the majority of SQL management systems.
1. In phpMyAdmin click on the import button at the top menu.
2. Select the file `Database_Schema_Script.sql` in the Database Schema Script folder.
3. Press the import button, and the database should be imported.

### Add users
At this moment the only way to add users is to add them manually in the database.
The program uses MD5 Hash when logging in, so make sure that your password in the database is encoded before inserting a user in the table.
Use this query `INSERT INTO 'user' ('id', 'username', 'name', 'password') VALUES ('YOUR_ID', 'YOUR_USERNAME', 'YOUR_NAME', 'YOUR_PASSWORD');` and replace `YOUR_xxx` with what you like.

## License
[License](./LICENSE.md)
