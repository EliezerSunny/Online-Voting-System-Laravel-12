# 🗳️ Online Voting Platform

An online voting application built using **Laravel** and **Livewire**. This platform enables secure, real-time voting experiences with a dynamic and responsive frontend, all without leaving the Laravel ecosystem.

## 🚀 Features

* ✅ Secure user authentication and role-based access
* 🧑‍⚖️ Admin dashboard to manage elections, candidates, and results
* 👥 Roles and Permissions
* 👥 Voter registration and verification
* 🗳️ Real-time voting powered by Laravel Livewire
* 📊 Live vote count updates
* 📄 Audit logs and results reporting
* 📬 Email notifications (e.g., voting confirmation)

## 🛠️ Tech Stack

* **Backend**: Laravel 12+
* **Frontend**: Blade, Livewire, Tailwind CSS
* **Database**: MySQL
* **Authentication**: Laravel Starter Kit  (New)
* **Other Tools**: Laravel Sanctum, Spatie, Laravel Excel, Laravel Notification

## Images

* Login page:
![img](https://raw.githubusercontent.com/EliezerSunny/Online-Voting-System-Laravel-12/refs/heads/main/public/storage/img/login.png)

* Login page:
![img](https://raw.githubusercontent.com/EliezerSunny/Online-Voting-System-Laravel-12/refs/heads/main/public/img/login_error.png)

* Home page:
![img](https://raw.githubusercontent.com/EliezerSunny/Online-Voting-System-Laravel-12/refs/heads/main/public/img/home_page.png)

* Home page2:
![img](https://raw.githubusercontent.com/EliezerSunny/Online-Voting-System-Laravel-12/refs/heads/main/public/img/home_page2.png)

* Voting page:
![img](https://raw.githubusercontent.com/EliezerSunny/Online-Voting-System-Laravel-12/refs/heads/main/public/img/voting_page.png)

* Roles and Permissions page:
![img](https://raw.githubusercontent.com/EliezerSunny/Online-Voting-System-Laravel-12/refs/heads/main/public/img/roles_permissions.png)

* Login page:
![img](https://raw.githubusercontent.com/EliezerSunny/Online-Voting-System-Laravel-12/refs/heads/main/public/img/dashboard.png)


## 📦 Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/EliezerSunny/Online-Voting-System-Laravel-12.git
   cd Online-Voting-System-Laravel-12
   ```

2. **Install Dependencies**

   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Environment Setup**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database**
   Edit `.env` file with your database credentials:

   ```
   DB_DATABASE=voting_platform
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run Migrations**

   ```bash
   php artisan migrate --seed
   ```

6. **Serve the Application**

   ```bash
   composer run dev
   ```

7. **Access the App**
   Visit `http://127.0.0.1:8000` in your browser.

## 🧪 Sample Admin Credentials

```
Email: eliezersunny@gmail.com
Password: 12345678
```

> Replace this with your own seeded or configured credentials.

## 🔐 Security Considerations

* Ensure HTTPS is enabled in production.
* Use Laravel’s validation and policies for secure input and role control.
* Enable email verification and rate-limiting for public-facing routes.

## 📁 Project Structure Highlights

```
app/
├── Http/
│   ├── Livewire/
│   └── Controllers/
├── Models/
├── Policies/
resources/
├── views/
│   ├── livewire/
│   └── layouts/
routes/
├── web.php
```

## 🧑‍💻 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## 📄 License

[MIT](LICENSE)
