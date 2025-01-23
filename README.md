<p align="center">
  <img src="https://github.com/MohamedElaassal/electroWave/blob/main/electroWaveLogo.png" alt="ElectroWave Logo" width="400">
</p>


ElectroWave is a comprehensive store management system designed for IT consultancy businesses. Built using Laravel 9 and Filament 3, this system provides efficient management of IT products, brands, categories, clients, and sales. ElectroWave simplifies operations with powerful functionalities such as statistical insights and multi-faceted management tools.

## Features

### 1. **Statistics**
   - Analyze key performance indicators of your store.
   - Gain insights into sales, clients, and product trends.

### 2. **Brand Management**
   - Manage a variety of IT brands (e.g., Apple, Samsung, Dell, etc.).
   - Add, edit, or delete brand records easily.

### 3. **Category Management**
   - Organize products into intuitive categories (e.g., Phones, Computers, Headphones, etc.).
   - Unlimited category customization for all types of IT devices.

### 4. **Product Management**
   - Maintain detailed records for all products, including:
     - Product Name
     - Associated Brand
     - Assigned Category
   - Streamlined product addition, updating, and deletion.

### 5. **Client Management**
   - Keep track of your clients and their purchase history.
   - Record client details and the products they have purchased.

### 6. **Payment Management**
   - Flexible payment options for clients:
     - Full payment
     - Partial payment with tracking

## Technologies Used

- **Framework:** Laravel 9
- **Admin Panel:** Filament 3
- **Database:** MySQL (or other Laravel-supported databases)
- **Frontend:** Blade templates integrated with Filament for dynamic UI components
- **Styling:** Tailwind CSS (default with Filament)

- ### Prerequisites:
- Install [Laravel 9](https://laravel.com/docs/9.x/installation) by following the official Laravel installation guide.
- Install [Filament 3](https://filamentphp.com/docs) by following the Filament installation instructions.

After ensuring that Laravel and Filament are installed, follow these steps:

## Installation

Follow these steps to set up ElectroWave on your local machine:

1. Clone the repository:
   ```bash
   git clone https://github.com/MohamedElaassal/electroWave.git
   cd electroWave
   ```

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

3. Set up the environment variables:
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your database credentials and other configuration details.

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Run migrations and seeders to set up the database:
   ```bash
   php artisan migrate --seed
   ```

6. Install NPM dependencies and build the frontend:
   ```bash
   npm install && npm run dev
   ```

7. Start the local development server:
   ```bash
   php artisan serve
   ```

Access the application at `http://localhost:8000`.

## Usage

- **Admin Panel:** Log in to the admin panel via `/admin` to manage brands, categories, products, clients, and payments.
- **Statistics:** View key statistics and insights from the dashboard.

## Contribution

Contributions are welcome! To contribute:

1. Fork the repository.
2. Create a new feature branch:
   ```bash
   git checkout -b feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add feature-name"
   ```
4. Push the branch:
   ```bash
   git push origin feature-name
   ```
5. Submit a pull request.

## License

ElectroWave is open-source and available under the [MIT License](LICENSE).

## Contact

For inquiries or support, please contact:

- **Email:** mohamedelaassal42@gmail.com

