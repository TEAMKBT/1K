<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Database connection
$servername = "localhost"; // Update if your database host is different
$username = "kbtowner_k"; // Replace with your database username
$password = "reversebypass"; // Replace with your database password
$dbname = "kbtowner_k"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $game_mode = isset($_POST['game_mode']) ? $_POST['game_mode'] : '';
    $game_version = isset($_POST['game_version']) ? $_POST['game_version'] : '';
    $paid_key = isset($_POST['paid_key']) ? $_POST['paid_key'] : '';

    // Validate input
    if (empty($game_mode) || empty($game_version) || empty($paid_key)) {
        die("All fields are required.");
    }

    // Query the database to check the key
    $sql = "SELECT id FROM keys_table WHERE key_value = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $paid_key);
    $stmt->execute();

    // Bind result to a variable
    $stmt->bind_result($key_id);
    $stmt->fetch();

    if ($key_id) {
        // Valid key, save data in session
        $_SESSION['game_mode'] = $game_mode;
        $_SESSION['game_version'] = $game_version;
        $_SESSION['paid_key'] = $paid_key;

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid key, redirect back to login with error
        echo "Invalid key. Please try again.";
        exit();
    }
} else {
    // Redirect to login page if accessed directly
    header("Location: index.html");
    exit();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>