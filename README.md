
# Elimspro Mini Project Laravel


---Persiapan---
1. lakukan "php artisan serve" dan "npm run dev" untuk menjalankan
2. lakukan migration pada database "php artisan migrate"
3. lakukan db seeder untuk mengirimkan akun user "php artisan db:seed --class=UsersTableSeeder"

#

---Catatan---
1. Tambahkan key "Accept" dan value "application/json" pada Headers

---Link Api---
1. domain/api/register (POST)
body : name,email,password,confirm_password

2. doamin/api/login (POST)
body : email,password

3. domain/api/companies (GET)
note : Authorization ubah ke "Bearer Token" dan masukan Token

4. domain/api/companies/id (GET)
note : Authorization ubah ke "Bearer Token" dan masukan Token

5. domain/api/create/companies (POST)
note : Authorization ubah ke "Bearer Token" dan masukan Token
body : name,address,email

6. domain/api/update/companies/id (PUT)
note : Authorization ubah ke "Bearer Token" dan masukan Token
body : name,address,email

7. domain/api/delete/companies/id (DELETE)
note : Authorization ubah ke "Bearer Token" dan masukan Token

8. domain/api/employees (GET)
note : Authorization ubah ke "Bearer Token" dan masukan Token

9. domain/api/employee/id (GET)
note : Authorization ubah ke "Bearer Token" dan masukan Token

10. domain/api/create/employee (POST)
note : Authorization ubah ke "Bearer Token" dan masukan Token
body : first_name,last_name,company_id,email,phone

11. domain/api/update/employee/id (PUT)
note : Authorization ubah ke "Bearer Token" dan masukan Token
body : first_name,last_name,company_id,email,phone

12. domain/api/delete/employee/id (DELETE)
note : Authorization ubah ke "Bearer Token" dan masukan Token