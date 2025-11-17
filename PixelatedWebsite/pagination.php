<?php
include "config.php";

$limit = 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$result = $conn->query("SELECT * FROM users LIMIT $start, $limit");
?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP Pixel-Pagination</title>
    <style>
        body {
            margin: 0;
            font-family: 'Press Start 2P', cursive, monospace;
            background: #87ceeb;
            color: #222;
            -webkit-font-smoothing: none;
            -moz-osx-font-smoothing: grayscale;
            background: url('https://wallpaperaccess.com/full/9034017.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            background: #a2d149;
            border-radius: 4px;
            border: 4px solid #2c6e1f;
            padding: 20px;
            max-width: 800px;
            box-shadow: 0 0 0 4px #3c941f;
            text-align: center;
            position: relative;
            animation: floatUp 1s ease-out;
            border-radius: 8px;
            user-select: none;
            transition: background-color 0.5s ease, color 0.5s ease;
            margin: 20px auto;
        }

        @keyframes floatUp {
            from {
                transform: translateY(40px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #dff0d8;
            border: 4px solid #2c6e1f;
            image-rendering: pixelated;
        }

        th,
        td {
            border: 2px solid #2c6e1f;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }

        button {
            background: #f39c12;
            border: 2px solid #d35400;
            padding: 6px 12px;
            cursor: pointer;
            font-family: 'Press Start 2P', cursive, monospace;
            font-size: 10px;
            color: white;
            image-rendering: pixelated;
            box-shadow: 2px 2px #e67e22;
        }

        button:hover {
            background: #d35400;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            display: inline-block;
            margin: 0 6px;
            padding: 10px 14px;
            border: 3px solid #2c6e1f;
            background: #6abf4b;
            color: #1b3d0a;
            text-decoration: none;
            font-family: 'Press Start 2P', cursive, monospace;
            font-size: 10px;
            box-shadow: 2px 2px #3c941f;
            user-select: none;
            image-rendering: pixelated;
        }

        .pagination a.active,
        .pagination a:hover {
            background: #2c6e1f;
            color: #a2d149;
            box-shadow: none;
        }

        .GTDB {
            display: inline-block;
            margin: 20px;
            text-decoration: none;
            font-family: 'Press Start 2P', cursive, monospace;
            font-size: 12px;
            background: #f39c12;
            padding: 10px 20px;
            border: 3px solid #d35400;
            color: white;
            box-shadow: 2px 2px #e67e22;
            image-rendering: pixelated;
            border-radius: 3px;
        }

        .GTDB:hover {
            background: #d35400;
        }

        .pixel-landscape {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            gap: 2px;
        }

        .pixel-landscape div {
            width: 20px;
            height: 20px;
            image-rendering: pixelated;
        }
    </style>
</head>

<body>
    <a href="dashboard.php" class="GTDB">Go back to dashboard</a>
    <div class="container">
        <h2>Users</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr id="user-<?= $row['id']; ?>">
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <button onclick="confirmDelete(<?= $row['id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <div class="pagination">
            <?php
            $total_result = $conn->query("SELECT COUNT(id) AS total FROM users");
            $total_row = $total_result->fetch_assoc();
            $total = $total_row['total'];
            $pages = ceil($total / $limit);
            for ($i = 1; $i <= $pages; $i++) {
                $active = ($i == $page) ? 'active' : '';
                echo "<a href='?page=$i' class='$active'>$i</a>";
            }
            ?>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                fetch('delete.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + encodeURIComponent(id)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('user-' + id).remove();
                        } else {
                            alert("Error: " + data.error);
                        }
                    })
                    .catch(() => {
                        alert("Request failed.");
                    });
            }
        }
    </script>
</body>

</html>