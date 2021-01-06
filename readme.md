
## About Project

MVC structural CRM consists of:-
- 1 admin, 2 Team leaders and 4 Sales agents.
- Admin can assign leads to TeamLeaders and TeamLeaders can assign to Agents in a hierarchy structure.
- Agents can add an activity to the lead.
- Only Team Leaders receive a notification when a lead is assigned to them.
- Notifications will be Laravel Mail notification from the admin to the team leader and you can change it as you wish. 

## How to run the project

- Open the project code and update .env file as follows:
```
DB_DATABASE=ecc
DB_USERNAME=YOUR USERNAME
DB_PASSWORD=YOUR PASSWORD

MAIL_USERNAME=YOUR USERNAME
MAIL_PASSWORD=YOUR PASSWORD
MAIL_ENCRYPTION=tls
```
- Import [ecc.sql] file from inside the project.
- open your terminal in the directory where you have the project.
- type in terminal 
```bash
cd ecc
php artisan serve
```
- for admin access:
```
email address: wagih707@gmail.com
password: 12345678
```
- Now you're logged in as an admin.
- For accessing any other user, get the email address from the database and use the same password as the admin for all of them.

## Root Folder

The root folder has
- The application files
- my Mysql database , it's name : ecc.sql