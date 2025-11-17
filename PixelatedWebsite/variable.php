<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP String Functions Demo</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Press Start 2P', cursive;
            background: url('8351186.gif') no-repeat center center fixed;
            background-size: cover;
            image-rendering: pixelated;
            min-height: 100vh;
            color: #222;
        }

        h2 {
            font-size: 18px;
            margin-top: 40px;
            color: #228B22;
            text-shadow: 2px 2px 0 #fff, 0 0 8px #228B22;
            text-align: center;
            font-family: 'Press Start 2P', cursive;
        }

        .input-group label {
            font-size: 12px;
            color: #222;
            font-family: 'Press Start 2P', cursive;
            margin-bottom: 6px;
            display: block;
            text-align: left;
        }

        input[type="text"] {
            width: 80%;
            padding: 12px;
            margin-bottom: 12px;
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            border: 2px solid #444;
            background-color: #f0f0f0;
            box-shadow: inset 2px 2px 0 #ccc;
            outline: none;
            color: #222;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #66ccff;
        }

        input[type="submit"] {
            padding: 14px 32px;
            background-color: #00b894;
            color: #fff;
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            border: 2px solid #000;
            border-radius: 8px;
            box-shadow: 3px 3px 0 #00796b;
            cursor: pointer;
            transition: background 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #00e6b8;
        }

        .result {
            margin: 40px auto 0 auto;
            background: rgba(255, 255, 255, 0.7);
            border: 4px solid #333;
            box-shadow: 8px 8px 0 #555;
            border-radius: 16px;
            width: 90%;
            max-width: 700px;
            min-height: 100px;
            text-align: center;
            padding: 30px 0;
            font-family: 'Press Start 2P', cursive;
        }

        code {
            background: #eee;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
            font-family: 'Press Start 2P', cursive;
        }

        .btn {
            font-family: 'Press Start 2P', cursive;
            font-size: 12px;
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 8px;
            background-color: #00796b;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #004d40;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_GET['func'])) {
        $func = $_GET['func'];
        echo '<div class="result">';
        if ($func == 'strlen') {
            echo '<h2>strlen()</h2>';
            echo '<form method="post"><div class="input-group"><label>Enter a string:</label><br><input type="text" name="str" required></div><input type="hidden" name="func" value="strlen"><input type="submit" value="Show Length"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'strlen') {
                $str = $_POST['str'];
                $len = strlen($str);
                echo "<br><b>Code:</b> <code>'" . htmlspecialchars($str) . "'</code><br>";
                echo "<br><b>Result:</b> $len";
            }
        } elseif ($func == 'str_replace') {
            echo '<h2>str_replace()</h2>';
            echo '<form method="post"><div class="input-group"><label>Original string:</label><br><input type="text" name="str" required></div><div class="input-group"><label>Search for:</label><br><input type="text" name="search" required></div><div class="input-group"><label>Replace with:</label><br><input type="text" name="replace" required></div><input type="hidden" name="func" value="str_replace"><input type="submit" value="Replace"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'str_replace') {
                $str = $_POST['str'];
                $search = $_POST['search'];
                $replace = $_POST['replace'];
                $new = str_replace($search, $replace, $str);
                echo "<br><b>Code:</b> <code>'" . htmlspecialchars($search) . "', '" . htmlspecialchars($replace) . "', '" . htmlspecialchars($str) . "'</code><br>";
                echo "<br><b>Result:</b> $new";
            }
        } elseif ($func == 'str_word_count') {
            echo '<h2>str_word_count()</h2>';
            echo '<form method="post"><div class="input-group"><label>Enter a string:</label><br><input type="text" name="str" required></div><input type="hidden" name="func" value="str_word_count"><input type="submit" value="Count Words"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'str_word_count') {
                $str = $_POST['str'];
                $count = str_word_count($str);
                echo "<br><b>Code:</b> <code>'" . htmlspecialchars($str) . "'</code><br>";
                echo "<br><b>Result:</b> $count";
            }
        } elseif ($func == 'strpos') {
            echo '<h2>strpos()</h2>';
            echo '<form method="post"><div class="input-group"><label>Original string:</label><br><input type="text" name="str" required></div><div class="input-group"><label>Find position of:</label><br><input type="text" name="search" required></div><input type="hidden" name="func" value="strpos"><input type="submit" value="Find Position"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'strpos') {
                $str = $_POST['str'];
                $search = $_POST['search'];
                $pos = strpos($str, $search);
                echo "<br><b>Code:</b> <code>'" . htmlspecialchars($str) . "', '" . htmlspecialchars($search) . "'</code><br>";
                echo "<br><b>Result:</b> " . ($pos !== false ? $pos : 'Not found');
            }
        } elseif ($func == 'strrev') {
            echo '<h2>strrev()</h2>';
            echo '<form method="post"><div class="input-group"><label>Enter a string:</label><br><input type="text" name="str" required></div><input type="hidden" name="func" value="strrev"><input type="submit" value="Reverse String"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'strrev') {
                $str = $_POST['str'];
                $rev = strrev($str);
                echo "<br><b>Code:</b> <code>'" . htmlspecialchars($str) . "'</code><br>";
                echo "<br><b>Result:</b> $rev";
            }
        } elseif ($func == 'strtoupper') {
            echo '<h2>strtoupper()</h2>';
            echo '<form method="post"><div class="input-group"><label>Enter a string:</label><br><input type="text" name="str" required></div><input type="hidden" name="func" value="strtoupper"><input type="submit" value="To Uppercase"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'strtoupper') {
                $str = $_POST['str'];
                $res = strtoupper($str);
                echo "<br><b>Code:</b> <code>'" . htmlspecialchars($str) . "'</code><br>";
                echo "<br><b>Result:</b> $res";
            }
        } elseif ($func == 'strtolower') {
            echo '<h2>strtolower()</h2>';
            echo '<form method="post"><div class="input-group"><label>Enter a string:</label><br><input type="text" name="str" required></div><input type="hidden" name="func" value="strtolower"><input type="submit" value="To Lowercase"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'strtolower') {
                $str = $_POST['str'];
                $res = strtolower($str);
                echo "<br><b>Code:</b> <code>'" . htmlspecialchars($str) . "'</code><br>";
                echo "<br><b>Result:</b> $res";
            }
        } elseif ($func == 'ucfirst') {
            echo '<h2>ucfirst()</h2>';
            echo '<form method="post"><div class="input-group"><label>Enter a string:</label><br><input type="text" name="str" required></div><input type="hidden" name="func" value="ucfirst"><input type="submit" value="Capitalize First Letter"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'ucfirst') {
                $str = $_POST['str'];
                $res = ucfirst($str);
                echo "<br><b>Code:</b> <code>u'" . htmlspecialchars($str) . "'</code><br>";
                echo "<br><b>Result:</b> $res";
            }
        } elseif ($func == 'substr') {
            echo '<h2>substr()</h2>';
            echo '<form method="post"><div class="input-group"><label>Enter a string:</label><br><input type="text" name="str" required></div><div class="input-group"><label>Start position (int):</label><br><input type="text" name="start" required></div><div class="input-group"><label>Length (optional):</label><br><input type="text" name="length"></div><input type="hidden" name="func" value="substr"><input type="submit" value="Get Substring"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'substr') {
                $str = $_POST['str'];
                $start = (int)$_POST['start'];
                $length = isset($_POST['length']) && $_POST['length'] !== '' ? (int)$_POST['length'] : null;
                $res = $length !== null ? substr($str, $start, $length) : substr($str, $start);
                echo "<br><b>Code:</b> <code>'" . htmlspecialchars($str) . "', $start" . ($length !== null ? ", $length" : "") . "</code><br>";
                echo "<br><b>Result:</b> $res";
            }
        } elseif ($func == 'trim') {
            echo '<h2>trim()</h2>';
            echo '<form method="post"><div class="input-group"><label>Enter a string (with spaces):</label><br><input type="text" name="str" required></div><input type="hidden" name="func" value="trim"><input type="submit" value="Trim Spaces"></form>';
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['func'] == 'trim') {
                $str = $_POST['str'];
                $res = trim($str);
                echo "<br><b>Code:</b> <code>'" . htmlspecialchars($str) . "'</code><br>";
                echo "<br><b>Result:</b> '$res'";
            }
        }
        echo '</div>';
    }
    ?>
</body>

</html>