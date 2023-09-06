<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // User details from the sign-up form
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Database connection parameters
        
$servername = "localhost"; // Replace with your server name or IP address
$db_username = "final"; // Replace with your database username
$db_password = "password"; // Replace with your database password
$dbname = "final"; // Replace with your database name // Replace with your database name

        // Create a database connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute an SQL INSERT query
        $sql = "INSERT INTO users (email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $password); // "sss" represents three string parameters
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            // Redirect to a success page or display a success message
            header("Location: success.html");
            exit();
        } else {
            // Redirect to an error page or display an error message
            header("Location: error.html");
            exit();
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
}

// If the script reaches this point, it means no form was submitted or there was an error
header("Location: error.html"); // Redirect to an error page
exit();
?>




















