<?php
include 'config.php';
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $token = bin2hex(random_bytes(50));
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $update = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $update->bind_param("ss", $token, $email);
        if ($update->execute()) {
            $link = "http://yourdomain.com/reset_password.php?token=$token";
            $success = "Reset link: <a href='$link' target='_blank'>$link</a>";
        }
    } else {
        $error = "No user found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('https://i.pinimg.com/originals/2f/10/ce/2f10ce69b96c0611989308b0abc68e70.gif') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Press Start 2P', cursive;
            color: white;
        }

        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

        .container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            max-width: 500px;
            margin: 100px auto;
            border: 4px solid #fff;
            box-shadow: 0 0 20px #000;
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 16px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="email"],
        input[type="submit"] {
            padding: 10px;
            font-family: 'Press Start 2P', cursive;
            border: none;
            outline: none;
            font-size: 12px;
        }

        input[type="email"] {
            background: #222;
            color: #fff;
            border: 2px solid #555;
        }

        input[type="submit"] {
            background: #e63946;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background: #ff6b81;
        }

        a {
            color: #a8dadc;
            font-size: 10px;
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            font-size: 12px;
            border-radius: 4px;
            word-break: break-all;
        }

        .message.success {
            background-color: #2a9d8f;
            color: #fff;
        }

        .message.error {
            background-color: #e76f51;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form method="post">
            <label>Enter your email:</label>
            <input type="email" name="email" required>
            <input type="submit" value="Send Reset Link">
        </form>
        <a href="register.php">← Go back to Registration</a>

        <?php if ($error): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php elseif ($success): ?>
            <div class="message success"><?= $success ?></div>
        <?php endif; ?>
    </div>
</body>

</html>