<?php
// Database connection
$servername = "localhost"; // Change to your database server
$username = "kbtowner_k";        // Change to your database username
$password = "reversebypass";            // Change to your database password
$dbname = "kbtowner_k"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['generate_key'])) {
    $key_value = $_POST['key_value'];

    if (!empty($key_value)) {
        $stmt = $conn->prepare("INSERT INTO keys_table (key_value) VALUES (?)");
        $stmt->bind_param("s", $key_value);
        if ($stmt->execute()) {
            $message = "Key successfully generated and added to the database!";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Please enter a key value!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Key Generator</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Styling for iOS-like design */
        .button-ios {
            background-color: #007aff; /* iOS blue */
            color: white;
            padding: 14px 24px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            width: 100%;
            text-align: center;
            transition: background-color 0.3s ease-in-out;
        }

        .button-ios:hover {
            background-color: #0051a8;
        }

        .input-ios {
            padding: 16px;
            border-radius: 20px;
            border: 1px solid #ccc;
            font-size: 16px;
            width: 100%;
            background-color: #f7f7f8;
            margin-bottom: 20px;
            transition: all 0.3s ease-in-out;
        }

        .input-ios:focus {
            border-color: #007aff;
            background-color: #ffffff;
            box-shadow: 0 0 5px rgba(0, 122, 255, 0.5);
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom, #f5f5f5, #ffffff);
        }

        .card {
            background-color: white;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            padding: 40px;
            text-align: center;
            animation: fadeIn 1s ease-out;
        }

        .card h2 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }

        .alert {
            background-color: #e1f5fe;
            color: #0277bd;
            padding: 12px;
            border-radius: 10px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Simple fade-in animation */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="font-poppins">

    <div class="container">
        <div class="card">
            <h2>Generate Your Custom Key</h2>

            <?php if (isset($message)) { ?>
                <div class="alert">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form action="key_generator.php" method="POST">
                <input type="text" name="key_value" id="key_value" class="input-ios" placeholder="Enter Custom Key (E.g., VPRO123)" required>
                
                <button type="submit" name="generate_key" class="button-ios">
                    <i class="fas fa-plus-circle mr-2"></i> Generate Key
                </button>
            </form>
        </div>
    </div>

</body>
</html>