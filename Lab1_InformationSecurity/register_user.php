<?php

// Check if the request method is POST to handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values from the POST request, with basic validation
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate required fields
    if (empty($username) || empty($email) || empty($password)) {
        echo "Please fill in all required fields correctly.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
        exit;
    }

    // Include the database connection file
    include 'db_connection.php';
    // Connect to the SQLite database
    $db = connectDatabase();
    //  Check if user exists
    $stmt = $db->prepare("SELECT * FROM usersTable WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    if ($result->fetchArray(SQLITE3_ASSOC)) {echo "Username is already taken!";}
    //Encrypt pw
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Prepare and execute the insert statement
    $stmt = $db->prepare("INSERT INTO usersTable (username, email, password) VALUES (:username, :email, :password)");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect back to the view page
        header("Location: login_form.php");
    } else {
        echo "Error creating user: " . $db->lastErrorMsg();
    }

    // Close the database connection
    $db->close();
} else {
    // If not a POST request, display an error message
    echo "Invalid request method. Please submit the form to register.";
}
