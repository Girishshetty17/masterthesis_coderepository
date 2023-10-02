import mysql from 'mysql2/promise';

export const handler = async (event) => {
    let connection;
    try {
        // Retrieve the form data
        const { name, email, subject, message } = event.body;

        // Create a new MySQL connection
        connection = await mysql.createConnection({
            host: 'database-1.crrmnrqirc9r.us-east-1.rds.amazonaws.com',
            user: 'admin',
            password: 'admin123',
            database: 'retrodiner_database'
        });

        // Prepare the SQL statement
        const sql = 'INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)';
        const values = [name, email, subject, message];

        // Execute the SQL statement
        const [result] = await connection.execute(sql, values);

        // Check if any rows were affected
        if (result.affectedRows > 0) {
            return 'Entry inserted successfully!';
        } else {
            return 'No rows were inserted.';
        }
    } catch (error) {
        console.log(error);
        throw error;
    } finally {
        // Close the database connection
        if (connection) {
            connection.end();
        }
    }
};