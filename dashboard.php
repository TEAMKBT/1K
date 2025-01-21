<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['paid_key'])) {
    header("Location: index.html");
    exit();
}

// Fetch session data
$game_mode = $_SESSION['game_mode'];
$game_version = $_SESSION['game_version'];
$paid_key = $_SESSION['paid_key'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Base Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Background and Container Styles */
        body {
            background: url('https://kbtowner.shop/1K/b.jpg') no-repeat center center/cover;
            position: relative;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
            background: rgba(0, 0, 0, 0.7);
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.7);
            width: 90%;
            max-width: 500px;
            text-align: center;
        }

        .container h1 {
            font-size: 20px; /* Smaller text size */
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #ffffff;
            animation: glowText 2s infinite;
        }

        @keyframes glowText {
            0%, 100% { text-shadow: 0 0 10px #ffffff, 0 0 20px #ffffff; }
            50% { text-shadow: 0 0 20px #ffffff, 0 0 40px #ffffff; }
        }

        /* Information Box Styling with Transparent Border */
        .info-box {
            background-color: rgba(255, 255, 255, 0.1); /* Transparent background */
            border: 1px solid rgba(255, 255, 255, 0.5);  /* Transparent border */
            border-radius: 10px;
            padding: 10px; /* Smaller padding */
            margin-bottom: 10px; /* Smaller margin */
            display: flex;
            justify-content: flex-start; /* Align left */
            align-items: center;
            font-size: 12px; /* Smaller text size */
        }

        .info-box i {
            margin-right: 8px; /* Smaller icon spacing */
        }

        .info-box p {
            font-size: 12px; /* Smaller text size */
            color: #fff;
        }

        /* Result and Timer Styling */
        .result-box {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            padding: 10px; /* Smaller padding */
            margin-bottom: 10px; /* Smaller margin */
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            font-size: 12px; /* Smaller text size */
        }

        #randomResult {
            font-size: 16px; /* Smaller font size */
            color: #ffae00; /* Gold glow */
            text-shadow: 0px 0px 10px #ffae00, 0px 0px 20px #ffc700;
            animation: fadeIn 1s ease-in-out;
            margin-top: 10px;
        }

        #textview1, #textview2 {
            font-size: 14px; /* Smaller font size */
            color: white;
            margin-bottom: 5px; /* Smaller margin */
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .button {
            width: 100%;
            padding: 8px; /* Smaller padding */
            border: none;
            border-radius: 8px;
            background: linear-gradient(90deg, #ffffff, #9e9e9e);
            color: #000;
            font-size: 14px; /* Smaller font size */
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px; /* Smaller margin */
            transition: all 0.3s ease;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(255, 255, 255, 0.4);
        }

    </style>
</head>
<body>
    <div id="particles-js"></div>

    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
        
        <!-- License Key, Game Mode, and Game Version with Icons, Aligned Left -->
        <div class="info-box">
            <i class="fas fa-key"></i> 
            <p><strong>License Key:</strong> <?php echo $paid_key; ?></p>
        </div>
        
        <div class="info-box">
            <i class="fas fa-gamepad"></i>
            <p><strong>Game Mode:</strong> <?php echo $game_mode; ?></p>
        </div>
        
        <div class="info-box">
            <i class="fas fa-cogs"></i>
            <p><strong>Game Version:</strong> <?php echo $game_version; ?></p>
        </div>

        <!-- Period, Timer, and Random Result in their own box -->
        <div class="result-box">
            <div id="textview1" class="user-info">Loading...</div>
            <div id="textview2" class="user-info">00:00</div>
            <div id="randomResult">Result will appear here</div>
        </div>

        <!-- Telegram Button -->
        <a href="https://t.me/TEAM_KBT_OWNER1" target="_blank"><button class="button">Telegram</button></a>
    </div>

    <!-- Script to Load Particles.js -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>  <!-- Font Awesome Icons -->
    <script>
        particlesJS('particles-js', {
            particles: {
                number: { value: 50, density: { enable: true, value_area: 800 } },
                color: { value: "#808080" },
                shape: { type: "circle", stroke: { width: 1, color: "#d3d3d3" } },
                opacity: { value: 0.5 },
                size: { value: 3 },
                move: { enable: true, speed: 1 }
            },
            interactivity: {
                events: {
                    onhover: { enable: true, mode: "repulse" },
                    onclick: { enable: true, mode: "push" }
                },
                modes: { repulse: { distance: 100 } }
            },
            retina_detect: true
        });

        // Random result and period calculation
        const results = ["BIG ","SMALL ","BIG ","SMALL ","BIG ", "SMALL  ", "BIG  ", "SMALL ", "BIG ","SMALL"];
        const textview1 = document.getElementById('textview1');
        const textview2 = document.getElementById('textview2');
        const randomResult = document.getElementById('randomResult');

        setInterval(() => {
            const now = new Date();
            const seconds = now.getSeconds();
            const remainingSeconds = 60 - seconds;

            const startHour = 5;
            const startMinute = 29;

            const currentHour = now.getHours();
            const currentMinute = now.getMinutes();

            let elapsedMinutes = (currentHour * 60 + currentMinute) - (startHour * 60 + startMinute);

            if (elapsedMinutes < 0) elapsedMinutes = 0;

            const formattedDate = now.toISOString().slice(0, 10).replace(/-/g, '');
            const periodNumber = "100001".concat(String(elapsedMinutes).padStart(4, '0'));
            const newText = formattedDate.concat(periodNumber);

            // Update period number
            if (textview1.textContent !== newText) {
                textview1.textContent = newText;

                // Display a random result when period changes
                randomResult.textContent = results[Math.floor(Math.random() * results.length)];
            }

            // Update countdown timer
            textview2.textContent = `00:${remainingSeconds.toString().padStart(2, '0')}`;
        }, 1000);
    </script>
</body>
</html>