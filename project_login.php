<?php
// Start session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Connect to your database
  // TODO: Fill in with your DB details
  $db = new mysqli('localhost', 'username', 'password', 'database');

  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // Prepared statement to avoid SQL injection
  $stmt = $db->prepare('SELECT * FROM users WHERE username=?');
  $stmt->bind_param('s', $username);

  $stmt->execute();

  $result = $stmt->get_result();
  while ($user = $result->fetch_assoc()) {
    // Verify password
    if (password_verify($password, $user['password'])) {
      // Successful login
      $_SESSION['username'] = $user['username'];
      $_SESSION['usertype'] = $user['usertype'];

      // Redirect to homepage
      header('location: index.php');
      exit();
    } else {
      echo "Incorrect username/password combination";
    }
  }
  $stmt->close();
  $db->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
</head>
<body>
  <h2>Login</h2>
  <form action="login.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Login">
  </form>
</body>
</html>
