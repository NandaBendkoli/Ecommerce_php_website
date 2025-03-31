# E-Commerce Website (PHP & MySQL)

This is a fully functional e-commerce website built using PHP and MySQL. It includes both user and admin functionalities, allowing users to browse, search, and purchase products while providing the admin with tools to manage the platform.

## Features

### User Features:
- **User Registration & Login** - Secure authentication system.
- **Product Browsing** - View categories and search for products.
- **Shopping Cart** - Add, update, and remove items from the cart.
- **Checkout & Payment** - Process payments and order confirmation.
- **User Profile Management** - Edit account details, track orders, and manage payments.
- **Order History** - View previous purchases.

### Admin Features:
- **Admin Authentication** - Secure login and logout system.
- **Manage Products** - Add, edit, and delete products.
- **Manage Categories & Brands** - Organize products efficiently.
- **Order Management** - View and process customer orders.
- **User Management** - View and manage registered users.
- **Payment Management** - Track and manage transactions.


## Technologies Used
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP
- **Database:** MySQL

## Installation & Setup
1. Clone the repository:
git clone -> https://github.com/NandaBendkoli/Ecommerce_php_website

2.Move to the project directory:   
   cd e-commerce-php
   
3.Import the database:
Create a database in MySQL.
Import the provided database.sql file.   

4.Configure the database:
Update database credentials in includes/connect.php:
$conn = mysqli_connect('localhost', 'root', '', 'mystore');

5.Run the project:
Start a local server (XAMPP ).
Place the project in the htdocs folder (using XAMPP).
Access the website at http://localhost/E-commerce-php/.

## Usage
Users can register, log in, browse products, add items to their cart, and place orders.
Admins can log in to manage products, categories, orders, and users.











