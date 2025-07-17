<?php
// Replace these with your actual database credentials
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

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];


  // Check if the username already exists
  $checkQuery = "SELECT * FROM users WHERE username = '$username'";
  $result = $conn->query($checkQuery);

  if ($result->num_rows > 0) {
    echo '<script>
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "This username is already taken. Please choose a different one.",
            });
          </script>';

    header("Location: registeradmin2.php");
  } else {
    // Hash the password (you should use a stronger hashing method in a real-world scenario)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the "users" table
    $insertQuery = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashedPassword', 'admin')";

    if ($conn->query($insertQuery) === TRUE) {
       echo '<script>
              Swal.fire({
                icon: "success",
                title: "Success!",
                text: "New record created successfully",
              });
            </script>';
            
      header("Location: registeradmin2.php");
    } else {
      echo "Error: " . $insertQuery . "<br>" . $conn->error;
      header("Location: registeradmin2.php");
    }
  }
}

// Close the connection
$conn->close();
?>
