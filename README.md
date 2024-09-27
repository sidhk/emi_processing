
# EMI Processing Application

This project is a Laravel-based application for processing and managing Loan EMI (Equated Monthly Installment) data. The application follows the repository and service pattern to ensure a clean and maintainable codebase. It includes features for storing loan details, calculating EMI, and dynamically managing the EMI data.

## Features

1. **Loan EMI Calculation Screen**
   - A separate form/screen for calculating and displaying Loan EMIs.

2. **Dynamic Data Storage**
   - Loan and EMI data are stored dynamically in the database.

3. **Database Setup**
   - Create a `loan_details` table using migrations.
   - Populate the `loan_details` table with seed data.
   - Create a `user` table with a seeded user for admin login.

4. **Admin Login**
   - A basic Laravel-based admin page that uses Laravel's authentication to log in.

5. **Loan Details Display**
   - A page to display the data from the `loan_details` table.

6. **EMI Details Processing**
   - A page with a "Process Data" button to dynamically create and display the EMI details.

## Database Setup

### 1. Loan Details Table

Create a table named `loan_details` using migrations with the following fields:

- **clientid**: This is the client ID.
- **num_of_payment**: The total number of payments the client has to make (EMI count).
- **first_payment_date**: The start date of payment (format: `YYYY-MM-DD`).
- **last_payment_date**: The end date of payment (format: `YYYY-MM-DD`).
- **loan_amount**: The total amount to be paid by the client (sum of all EMIs).

### 2. Seed Data for Loan Details

Add the following data to the `loan_details` table using seeds:

| clientid | num_of_payment | first_payment_date | last_payment_date | loan_amount |
|----------|----------------|--------------------|-------------------|-------------|
| 1001     | 12             | 2018-06-29         | 2019-05-29        | 1550.00     |
| 1003     | 7              | 2019-02-15         | 2019-08-15        | 6851.94     |
| 1005     | 17             | 2017-11-09         | 2019-03-09        | 1800.01     |

### 3. User Table

Create a `user` table and add a user using seeds:

- **username**: `developer`
- **password**: `Test@Password123#`

## Application Pages

### 1. Admin Login

A basic admin login page using Laravel's Auth system to authenticate the user.

### 2. Display Loan Details

A page that displays the data from the `loan_details` table.

### 3. EMI Details Processing

- Initially, the page will have a "Process Data" button. The page will be blank until the button is clicked.
- On clicking the "Process Data" button, the following steps will occur:
  - **EMI Details Table Creation**:
    - Create a table named `emi_details` dynamically.
    - If the table already exists, it will be deleted and recreated.
    - The table will have dynamic columns based on the `min first_payment_date` and `max last_payment_date` from the `loan_details` table.
  - **EMI Calculation**:
    - For each row in the `loan_details` table, calculate the EMI amount using the formula: `EMI = loan_amount / num_of_payment`.
    - Save each EMI amount into the corresponding month's column in the `emi_details` table.
    - Adjust the last payment if necessary to ensure the total EMI amount equals the total loan amount.
  - **Display EMI Details**:
    - Display the data from the `emi_details` table on the page.
  - Repeating the process will regenerate and display the updated data.


To Run This Project
To set up and run the EMI project, follow these steps:

Run the migrations to create the necessary database tables:

## To Run this Project use Artisan Commands

To set up and run the EMI project, follow these steps:

1. Run the migrations to create the necessary database tables:
   ```bash
   php artisan migrate
   ```

2. Seed the database with the default data:
   ```bash
   php artisan db:seed
   ```

3. Seed the `loan_details` table with specific data using the `LoanDetailsSeeder`:
   ```bash
   php artisan db:seed --class=LoanDetailsSeeder
   ```

