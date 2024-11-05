Developed a Laravel-based loan management system with the following features:

Database Design & Migration: Created loan_details and user tables using Laravel migrations, with fields like client ID, number of payments, loan amount, and payment start/end dates.
User Authentication: Implemented Laravel Auth for secure user login, with a seeded admin user (developer).
Dynamic EMI Table Generation: Built a dynamic page that processes loan data to create a table (emi_details) with monthly columns based on payment start and end dates. Used raw SQL queries to generate the table and populate it with EMI amounts.
EMI Calculation & Data Display: Calculated EMIs and displayed data for each client, ensuring that the total EMI sum matched the loan amount.
Reprocessing & Display: Implemented functionality to dynamically recreate and display the emi_details table upon each button click, ensuring updated data processing.
