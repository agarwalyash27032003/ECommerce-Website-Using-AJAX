# ECommerce-Website-Using-AJAX

# 🛒 E-Commerce Website Using AJAX

An interactive **E-Commerce web application** built using **PHP, MySQL, AJAX, jQuery, HTML, CSS, and Bootstrap**.  
The project focuses on **dynamic CRUD operations without page reload**, providing a smooth user experience.

---

## 🚀 Features

- 📦 Product listing with dynamic data loading
- ➕ Add new products using AJAX
- ✏️ Update products without page refresh
- ❌ Delete products dynamically
- 🔍 Live search functionality
- 🖼️ Product image upload & display
- ⚡ Fast and responsive UI
- 🗄️ MySQL database integration

---

## 🛠️ Tech Stack

| Layer | Technologies |
|-----|-------------|
| Frontend | HTML, CSS, Bootstrap |
| Scripting | JavaScript, jQuery, AJAX |
| Backend | PHP |
| Database | MySQL |
| Server | XAMPP |

---


---

## ⚙️ Setup Instructions

### 1️⃣ Clone Repository
bash

git clone https://github.com/agarwalyash27032003/ECommerce-Website-Using-AJAX.git

### 2️⃣ Move to XAMPP
C:/xampp/htdocs/

### 3️⃣ Start Services

Apache ✅

MySQL ✅

### 4️⃣ Create Database
CREATE DATABASE ajax_1;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(255),
    Description TEXT,
    Price DECIMAL(10,2),
    image VARCHAR(255)
);

### 5️⃣ Update DB Config (dbconnect.php)
$server = "127.0.0.1";
$username = "root";
$password = "";
$database = "ajax_1";
$port = 3307;

### 6️⃣ Run Project
http://localhost/ECommerce-Website-Using-AJAX/
