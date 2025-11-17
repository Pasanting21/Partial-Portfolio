<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if ($new_password !== $confirm_password) {
        echo "<script>alert('New passwords do not match.');</script>";
    } else {
        $username = $_SESSION["username"];
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($current_password, $user['password'])) {
            $hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
            $update->bind_param("ss", $hashed, $username);
            if ($update->execute()) {
                echo "<script>alert('Password changed successfully!');</script>";
            } else {
                echo "<script>alert('Failed to update password.');</script>";
            }
        } else {
            echo "<script>alert('Current password is incorrect.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('8351186.gif') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .container {
            background: rgba(0, 0, 0, 0.6);
            /* semi-transparent black */
            padding: 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 24px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            text-align: left;
            font-size: 14px;
            color: #ddd;
        }

        input[type="password"] {
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            background-color: #f3f3f3;
            color: #333;
        }

        input[type="submit"] {
            background-color: #45aaf2;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2d98da;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
        }

        a:hover {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Change Password</h2>
        <form method="post">
            <label>Current Password:</label>
            <input type="password" name="current_password" required>

            <label>New Password:</label>
            <input type="password" name="new_password" required>

            <label>Confirm New Password:</label>
            <input type="password" name="confirm_password" required>

            <input type="submit" value="Change Password">
            <a href="index.php">← Back to Login</a>
        </form>
    </div>
</body>

</html>