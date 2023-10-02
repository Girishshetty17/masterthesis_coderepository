<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve the form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Create a new MySQLi instance
$mysqli = new mysqli("database-1.cm2wyaf7lrgi.us-east-1.rds.amazonaws.com", "admin", "admin123", "retrodiner_database");

// Check for connection errors
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Prepare the SQL statement
$stmt = $mysqli->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");

if (!$stmt) {
    die('Error: ' . $mysqli->error);
}

// Bind the parameters and execute the statement
$stmt->bind_param("ssss", $name, $email, $subject, $message);
$result = $stmt->execute();

if (!$result) {
    die('Error: ' . $stmt->error);
}

// Check if any rows were affected
if ($stmt->affected_rows > 0) {
    echo "Entry inserted successfully!";
} else {
    echo "No rows were inserted.";
}

// Close the statement and database connection
$stmt->close();
$mysqli->close();

// Redirect the user back to the contact page or display a success message
header("Location: success.html");
exit();
?>
