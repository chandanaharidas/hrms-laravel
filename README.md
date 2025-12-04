

📌 HRMS – Human Resource Management System (Laravel)

The Human Resource Management System (HRMS) is a web-based application built using Laravel. It helps organisations manage employees, attendance, leaves, communication, and HR operations efficiently.

This project supports two user roles:

Admin (HR)

Employee



---

🚀 Features

👨‍💼 Admin Features

Admin Login

Dashboard with employee and activity overview

Add new employee

View employee list

Full Employee CRUD operations (Add, Edit, Update, Delete)

Add and manage Job Posts

View all Job Posts

View employee attendance

Modify / correct attendance entries

View leave applications submitted by employees

Approve / Reject leave requests

Receive messages from employees

Change Password



---

👨‍💻 Employee Features

Employee Login

Update personal profile

Mark daily attendance

Apply for leave

Send message to Admin / HR

View status of leave applications

Change Password



---

🏗️ Tech Stack

Laravel

PHP

MySQL

Blade Templates

Ajax

Javacsript

jQuery

HTML/CSS/Bootstrap

XAMPP/LAMPP (local environment)



---

⚙️ Installation Steps

Follow these steps to run the project on your local system:

1️⃣ Clone the repository

git clone https://github.com/chandanaharidas/hrms-laravel.git

2️⃣ Navigate into the project folder

cd hrms-laravel

3️⃣ Install dependencies

composer install
npm install

4️⃣ Create .env file

cp .env.example .env

5️⃣ Generate Application Key

php artisan key:generate

6️⃣ Configure database

Open .env and update:

DB_DATABASE=your_db_name
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password

7️⃣ Run migrations (if you are using migrations)

php artisan migrate

8️⃣ Start the server

php artisan serve

Your app will run at:
👉 http://localhost:8000


---

🧪 Login Credentials (Demo)

Admin Login: 
Email:admin@hrms.com
Password:admin123


Employee Login:
Employees do not have a fixed username/email.
When Admin creates a new employee, the employee's email ID is the company email assigned by the Admin.
The default password for all new employees is:
Password:123456

Employee can then log in using:
Email:<employee_company_email>
Password:123456
After logging in, the employee can change their password.


---

📁 Project Modules

Employee Module

Admin Module

Attendance Module

Leave Module

Messaging Module

Job Posting Module

Authentication Module (Login / Logout / Password Update)



---

📸 Screenshots
<img width="1366" height="768" alt="Screenshot from 2025-12-04 12-57-24" src="https://github.com/user-attachments/assets/5aeda044-7871-4869-838b-c08e65bb5733" />




---

📝 Author

Chandana Haridas



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
