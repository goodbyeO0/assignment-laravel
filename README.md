# Laravel School Management System with Web3 Integration

This project is a Laravel-based school management system that includes features for managing timetables, subjects, halls, and groups, along with Web3 wallet integration for Ethereum transactions.

## Prerequisites

-   PHP >= 8.1
-   Composer
-   Node.js & NPM
-   MySQL
-   MetaMask browser extension
-   Git
-   Laragon (recommended) or other local development environment

## Installation

1. Clone the repository:

```bash
git clone <repository-url>
cd laravel_asignment
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install and compile frontend dependencies:

```bash
npm install
npm run dev
```

4. Create a copy of the environment file:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Configure your database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run migrations:

```bash
php artisan migrate
```

8. Create storage link:

```bash
php artisan storage:link
```

## Features

### 1. School Management

-   **Students Management**: CRUD operations for student records
-   **Subjects Management**: Add, edit, and manage course subjects
-   **Halls Management**: Manage lecture halls and their capacity
-   **Groups Management**: Organize students into groups
-   **Timetable Management**: Create and manage class schedules

### 2. Web3 Integration

-   Connect MetaMask wallet
-   Send ETH on Sepolia testnet
-   View transaction history
-   Direct links to Etherscan for transactions and addresses

## Usage

### School Management

1. **Students**

    - Access at: `/students`
    - Add new students: `/students/create`
    - Edit existing students: `/students/{id}/edit`

2. **Subjects**

    - Access at: `/subjects`
    - Add new subjects: `/subjects/create`
    - Manage subject details and lecturer assignments

3. **Halls**

    - Access at: `/halls`
    - Manage lecture halls and capacities

4. **Groups**

    - Access at: `/groups`
    - Create and manage student groups

5. **Timetables**
    - Access at: `/timetables`
    - Create and manage class schedules

### Web3 Features

1. **Connect Wallet**

    - Click "Connect Wallet" in the navigation
    - Approve MetaMask connection
    - System will automatically switch to Sepolia testnet

2. **Send ETH**

    - Ensure you have Sepolia ETH (get from a faucet)
    - Enter recipient address
    - Enter amount in ETH
    - Click "Send ETH"
    - Approve transaction in MetaMask

3. **View Transactions**
    - All transactions are listed in the "Recent Transactions" section
    - Click "View on Etherscan" to see transaction details
    - Your wallet address has a direct link to Etherscan

## Important Notes

1. **MetaMask Setup**

    - Install MetaMask browser extension
    - Create or import a wallet
    - Switch to Sepolia testnet
    - Get test ETH from a Sepolia faucet

2. **Security**

    - Never share your private keys
    - Use test networks for development
    - Keep your MetaMask wallet secure

3. **Development**
    - Run `npm run dev` during development
    - Use `php artisan serve` if not using Laragon
    - Check browser console for Web3 debugging

## Troubleshooting

1. **Database Issues**

    - Ensure MySQL is running
    - Check database credentials in `.env`
    - Run `php artisan migrate:fresh` if needed

2. **Web3 Issues**

    - Ensure MetaMask is installed and unlocked
    - Verify you're on Sepolia testnet
    - Check if you have enough Sepolia ETH

3. **Storage Issues**
    - Run `php artisan storage:link`
    - Ensure proper permissions on storage directory

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, please create an issue in the repository or contact the development team.
