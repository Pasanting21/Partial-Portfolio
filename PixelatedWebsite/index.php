<?php
        session_start();
        include 'config.php';

        $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($user = $result->fetch_assoc()) {
                    if (password_verify($password, $user['password'])) {
                        $_SESSION["username"] = $user['username'];
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        $error = "Invalid password!";
                    }
                } else {
                    $error = "Your Email Was Not Registered!";
                }

                $stmt->close();
            } else {
                $error = "Error preparing statement: " . $conn->error;
            }
        }

        if (!empty($error)) {
            echo "<script>alert('" . htmlspecialchars($error) . "');</script>";
        }
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixelated Log In</title>
    <style> 
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Press Start 2P', cursive;
            background: url('https://wallpaperaccess.com/full/1719750.png') no-repeat center center fixed;
            background-size: cover;
            image-rendering: pixelated;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #f0f0f0;
        }

        .form-container {
            background-color: rgba(20, 20, 40, 0.85);
            border: 4px solid #444;
            box-shadow: 6px 6px 0px #000;
            padding: 30px;
            width: 420px;
            max-width: 90%;
            text-align: center;
            /* Animation */
            opacity: 0;
            transform: translateY(40px) scale(0.98);
            animation: fadeInUp 1s cubic-bezier(.42, 0, .58, 1) forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        h2 {
            font-size: 14px;
            margin-bottom: 25px;
            color: #b0e0ff;
            text-transform: uppercase;
        }

        label {
            display: block;
            font-size: 10px;
            margin: 12px 0 5px;
            color: #ccc;
            text-align: left;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            font-family: 'Press Start 2P', cursive;
            font-size: 10px;
            border: 2px solid #000;
            background-color: #222;
            color: #f0f0f0;
            box-shadow: inset 2px 2px 0 #111;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #66ccff;
        }

        input[type="submit"] {
            width: 100%;
            padding: 14px;
            background-color: #1e90ff;
            color: #fff;
            font-family: 'Press Start 2P', cursive;
            font-size: 10px;
            border: 2px solid #000;
            box-shadow: 3px 3px 0 #003366;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            /* Animation for press */
        }

        input[type="submit"]:active {
            transform: scale(0.96);
            box-shadow: 1px 1px 0 #003366;
        }

        .link {
            display: block;
            margin-top: 15px;
            font-size: 10px;
            text-decoration: none;
            color: #aaccff;
            position: relative;
            overflow: hidden;
        }

        .link::after {
            content: "";
            display: block;
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background: #aaccff;
            transition: width 0.3s;
        }

        .link:hover::after {
            width: 100%;
        }

        .link:hover {
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form method="post" action="index.php">
            <h2>Log In</h2>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter Email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter Password" required>

            <input type="submit" name="submit" id="submit" value="Log in" class="submit-btn">

            <a href="forgot_password.php" class="link">Forgot Password?</a>
            <a href="register.php" class="link">Not Registered Yet? Register Here!</a>
        </form>
    </div>
</body>

</html>