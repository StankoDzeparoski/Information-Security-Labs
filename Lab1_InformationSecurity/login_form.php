<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register user</title>
</head>
<body>
<form action="login.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <br />
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br />
    <button type="submit">Login</button>
</form>
<p>Not registered? <a href="register_user_form.php">Register</a></p>
</body>
