<?php
// Start the session to manage user login state
session_start();

// Establish database connection (Replace these variables with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is already logged in, redirect to home/dashboard
if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to retrieve user from the database
    $sql = "SELECT ID, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameter and execute the statement
    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    // Check if the username exists in the database
    if ($stmt->num_rows > 0) {
        // Bind retrieved data to variables
        $stmt->bind_result($userID, $username, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, create session variables
            $_SESSION['user_id'] = $userID;
            $_SESSION['username'] = $username;

            // Redirect to dashboard or home page upon successful login
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!-- HTML form for user login -->
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>

<h2>User Login</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>

</body>
</html>
