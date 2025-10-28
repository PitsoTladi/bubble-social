# Bubble social media


A social networking platform built with fun in mind :smiley:, it is designed to connect users, share updates, and foster community engagement. 

## Table of Contents

1. [Project Overview](#project-overview)  
2. [Features](#features)
3.  [Prerequisites](#prerequisites)
4. [Installation](#installation)  
5. [Architecture](#architecture)  
6. [Folder Structure](#folder-structure)  
7. [How to Run](#how-to-run)  
8. [Usage](#usage)  


## Project Overview

**Bubble Social** is a full-stack social media web application where users can:  

- Create  profiles  
- Share posts with text, images, and links  
- Follow other users and engage with their content  
- Experience a responsive design optimized for desktop and mobile  

The project uses **PHP** for the backend, **MySQL** for the database, and **HTML/CSS/JavaScript**

## Features

- **User Authentication**: Sign up, login, and manage user sessions  
- **Profile Management**: Add profile pictures, bio, and personal information  
- **Post System**: Create, edit, delete, and view posts  

## Prerequisites

Before installing and running the project, make sure you have the following installed:  

- **PHP** (version 7.4 or higher)   
- **Web Server** (Anginx or XAmmp)  
- **Git** (to clone the repository)  
- **Web Browser** (Chrome, Firefox, or Edge) 

## Installation
1. initialize a  local reprository on C:\xampp\htdocs using commands:
 ```bash
git init C:\xampp\htdocs
```

2. Clone the project using:
```bash
git clone https://github.com/PitsoTladi/bubble-social.git
```

<h2 align="center">OR</h2>
3. Download .zip file in reprository

## Architecture
Bubble Social follows a traditional LAMP-style architecture:

- Frontend: HTML, CSS, JavaScript

- Backend: PHP

- Database: MySQL

- Server: Apache or built-in PHP server for development

## Folder Structure
<details>
  <summary>📁 bubble-social</summary>

```plaintext
bubble-social/
├── backend/
│   ├── Auth/
│   ├── Pages/
|   ├── Sql
│   └── Includes/
├── cover img/
├── frontend/
│   ├── css/
│   ├── js/
├── parefenelia/
├── pp pics/
├── uploads/
└── test.html
```
</details> 

## How to Run
1. Unzip the project in C:\xampp\htdocs.
2. Open Xampp and start mysql and apache.
3. Open mySql admin panel using
   ```bash
   http://localhost/phpmyadmin/
   ```
4. Create a new database and name it bubble_data
5. Go to the import tab of the database and paste the bubble_data.sql file from C:\xampp\htdocs\bubble-social\backend\auth\sql.
6. Go to your web browser and open
7. ```bash
   http://localhost/bubble-social/backend/pages/bubble-welcome.php
   ```
    
7. Create an account

## Usage

**After launching the app, users can:**

- Sign Up / Log In
- Create a new account or log in to an existing one.
- Manage Profile
- Create Posts
- Add new posts with text, images, or links.
- Interact with other users.
- View other users’ posts
- Explore feeds and stay updated with the community


