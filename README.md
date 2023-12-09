# Student Management System

The Student Management System is a Laravel-based web application designed to streamline the management of student courses and certificates. The system empowers students to access their course information, view grades, and calculate their GPA. With built-in database seeders and migration files, setting up the application is a breeze.

## Getting Started

Follow these steps to set up the Student Management System on your local machine:

### Prerequisites

1. Make sure you have [Composer](https://getcomposer.org/) installed.
2. Ensure you have [PHP](https://www.php.net/) 7.4 or higher installed.
3. Set up a MySQL database.

### Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/evokelektrique/laravel-student-management-system.git
   ```

2. Navigate to the project directory:

   ```bash
   cd student-management-system
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env` and configure your database:

   ```bash
   cp .env.example .env
   ```

   Update the `.env` file with your database credentials.

5. Generate an application key:

   ```bash
   php artisan key:generate
   ```

6. Run migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

7. Start the Laravel development server:

   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your browser to access the Student Management System.

## Features

- **Student Dashboard**: Students can log in to view their enrolled courses and certificates.

- **Course Management**: Admins can manage courses, including adding new courses, updating details, and setting course status.

- **GPA Calculation**: The system calculates and displays students' Grade Point Averages based on their course grades.

- **Database Seeding**: Use predefined seeders to populate the database with sample data for testing.

## Usage

1. **Login**: Access the system by logging in with the provided credentials.

2. **Dashboard**: View a personalized dashboard with information about enrolled courses and overall GPA.

3. **Courses**: Explore available courses, view details, and manage enrollment.

4. **Admin Panel**: Admins can access the admin panel to manage courses, users, and other system settings.

## Contributing

Contributions are welcome! Feel free to submit issues, feature requests, or pull requests.

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/awesome-feature`).
3. Commit your changes (`git commit -am 'Add awesome feature'`).
4. Push to the branch (`git push origin feature/awesome-feature`).
5. Open a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Special thanks to the Laravel community for the amazing framework.
- Inspired by the need for an efficient student management solution.

Feel free to enhance the README with additional sections or details specific to your project. Adjust the content based on the actual features and structure of your Student Management System.
