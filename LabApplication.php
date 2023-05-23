<?php
// login.php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        // Store result
        $stmt->store_result();
        
        // Check if email exists, if yes then verify password
        if($stmt->num_rows == 1){                    
            // Bind result variables
            $stmt->bind_result($id, $email, $hashed_password);
            if($stmt->fetch()){
                if(password_verify($password, $hashed_password)){
                    // Password is correct, so start a new session
                    session_start();
                    
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["email"] = $email;                            
                    
                    // Redirect user to welcome page
                    header("location: welcome.php");
                } else{
                    // Display an error message if password is not valid
                    $password_err = "The password you entered was not valid.";
                }
            }
        } else{
            // Display an error message if email doesn't exist
            $email_err = "No account found with that email.";
        }
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

