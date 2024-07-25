Cara-EcommerceWebsite
Cara-EcommerceWebsite is a PHP-based e-commerce website project designed to provide a complete online shopping experience. This README will guide you through the steps to set up the project on your local machine using XAMPP.
Prerequisites
Before you begin, ensure you have the following software installed on your system:

XAMPP
Installation
Follow these steps to set up the Cara-EcommerceWebsite on your local machine:

Download XAMPP:

Go to the XAMPP download page.
Download the version suitable for your operating system.
Follow the installation instructions provided on the website.
Clone the Repository:

Open a terminal or command prompt.
Clone the repository using the following command
git clone :  https://github.com/nhatminh122004/Cara-EcommerceWebsite.git
Alternatively, you can download the repository as a ZIP file and extract it.
Move to XAMPP's htdocs Directory:

Copy the cloned repository folder Cara-EcommerceWebsite to your XAMPP installation directory. By default, the path is:
C:\xampp\htdocs\
Configuration
Start XAMPP:

Open the XAMPP Control Panel.
Start the Apache and MySQL modules.
Configure PHP Settings:

Ensure that your php.ini file is configured correctly.
You might need to enable some extensions like mysqli. To do this, find the following line in php.ini and remove the semicolon at the beginning: 
extension=mysqli
Database Setup
Create the Database:

Open your web browser and go to http://localhost/phpmyadmin.
Click on the "Databases" tab.
Create a new database named eccommershop.
Import the SQL File:

While still in phpMyAdmin, ensure the eccommershop database is selected.
Click on the "Import" tab.
Click on "Choose File" and select the eccommershop.sql file located in the Cara-EcommerceWebsite directory.
Click on "Go" to import the database.
Running the Project
Access the Project:

Open your web browser.
Go to http://localhost/Cara-EcommerceWebsite.
Explore the Website:

You should now see the homepage of Cara-EcommerceWebsite.
You can navigate through the website, browse products, add items to the cart, and proceed to checkout.
