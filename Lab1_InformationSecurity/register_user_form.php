<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register user</title>
</head>
<body>
<form action="register_user.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <br />
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <br />
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br />
    <button type="submit">Register</button>
</form>

<p>Already registered? <a href="login_form.php">Login</a></p>
</body>
