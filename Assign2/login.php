<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <meta name="description" content="Assignment 2">
    <meta name="keywords" content="PHP, File, input, output">
    <link rel="stylesheet" href="./style/login.css">
</head>
<body>
    <h1>Login</h1>
    <form action="login_process.php" method="post">
        <label for="username">User Name:</label>
        <input type="text" name="username" required>

        <label for="accountPassword">Password:</label>
        <input type="password" name="accountPassword" required>

        <input type="submit" value="Login">
    </form>
</body>
</html>