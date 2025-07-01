# Vndrosport Marketplace Application

Vndrosport is a marketplace application designed for Android devices. It enables users to buy, sell, and manage products with a robust backend and a user-friendly interface.

---

## Features

- Minimum Android API Level: 24 (Android 7 Nougat)
- Integrated with web services using Retrofit
- Backend powered by CodeIgniter 3.1
- Supports both MySQL (server) and SQLite (local) databases

---

## Installation Guide

### 1. Backend (CodeIgniter 3.1)

**Steps:**

1. Clone the repository:
   ```sh
   git clone https://github.com/alexistdev/vndrosport.git
   ```
2. Move the project files to your local web server directory (e.g., `htdocs` for XAMPP).
3. Open the terminal in the project directory and install dependencies:
   ```sh
   composer install
   ```
4. Create a MySQL database and configure the credentials in `application/config/database.php`.
5. Import the database structure from `vndrosport.sql`.
6. Access the admin panel via:  
   ```
   http://localhost/vndrosport/admin/login
   ```
   - **Username:** `admin`
   - **Password:** `admin`

---

### 2. Android Application

**Steps:**

1. Open the Android project in Android Studio.
2. Navigate to `config/Constants.java` and update the backend API base URL:
   - Set it to your local IP (localhost) when using XAMPP/WAMP.
3. Build and run the project on an emulator or Android device.

---

## Screenshots

<div align="center">
  <a href="https://postimg.cc/gnFLMHgf" target="_blank">
    <img src="https://i.postimg.cc/rFzGwhxF/1.png" width="250" alt="Vndrosport Screenshot 1"/>
  </a>
  <a href="https://postimg.cc/Btxnv9CV" target="_blank">
    <img src="https://i.postimg.cc/VshrDz0m/4.png" width="500" alt="Vndrosport Screenshot 2"/>
  </a>
</div>

---

## Additional Notes

- Ensure both the backend web service and the Android application are running on the same network if using a physical device.
- Update firewall and network settings if you encounter connectivity issues.

---

## License

This project is licensed under the [MIT License](LICENSE).

---

**Happy coding!**
