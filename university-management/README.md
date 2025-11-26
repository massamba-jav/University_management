# University Management System

## Overview
This project is a University Management System built using Laravel. It provides a web interface for managing various entities such as students, departments, fields, and professors. The application features server-side rendering of tables with pagination, ensuring a smooth user experience.

## Features
- Manage students, departments, fields, and professors.
- Server-side rendering of data tables.
- Pagination for easy navigation through large datasets.
- Responsive design with a professional neutral theme.

## Project Structure
```
university-management
├── app
│   └── Http
│       └── Controllers
│           └── TableauController.php
├── routes
│   └── web.php
├── resources
│   ├── css
│   │   └── tableau.css
│   └── views
│       ├── components
│       │   ├── table.blade.php
│       │   └── pagination.blade.php
│       ├── layouts
│       │   └── app.blade.php
│       ├── tableau
│       │   ├── index.blade.php
│       │   ├── departements.blade.php
│       │   ├── filieres.blade.php
│       │   ├── professeurs.blade.php
│       │   └── etudiants.blade.php
│       └── menu.blade.php
└── README.md
```

## Installation
1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd university-management
   ```
3. Install dependencies:
   ```
   composer install
   ```
4. Set up your `.env` file:
   ```
   cp .env.example .env
   ```
5. Generate the application key:
   ```
   php artisan key:generate
   ```
6. Run the migrations:
   ```
   php artisan migrate
   ```
7. Start the development server:
   ```
   php artisan serve
   ```

## Usage
- Access the application at `http://localhost:8000`.
- Use the main menu to navigate between different sections of the application.
- Each section allows you to view, create, edit, and delete records.

## Contributing
Contributions are welcome! Please feel free to submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.