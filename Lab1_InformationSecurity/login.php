<?php
session_start();
// Include the database connection file
include 'db_connection.php';

// Check if the request method is POST to handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values from the POST request, with basic validation
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validate required fields
    if (empty($username) || empty($password)) {
        echo "Please fill in all required fields correctly.";
        exit;
    }

    // Connect to the SQLite database
    $db = connectDatabase();
    //  Check if user exists
    $stmt = $db->prepare("SELECT * FROM usersTable WHERE username = :username LIMIT 1");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);
    if (!$user) {echo "User doesn't exist!"; $db->close(); exit;}

    // Close the database connection
    $db->close();

    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        echo "Incorrect password!";
        exit;
    }


} else {
    // If not a POST request, display an error message
    echo "Invalid request method. Please submit the form to login.";
}