<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XSS Demo - Secure vs Vulnerable</title>
    <style>
        body {
            font-family: Arial;
            background: #0f172a;
            color: white;
            text-align: center;
        }

        .container {
            width: 50%;
            margin: auto;
            background: #1e293b;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }

        input {
            width: 70%;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            border: none;
        }

        button {
            padding: 10px 20px;
            background: #38bdf8;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0ea5e9;
        }

        .comment {
            background: #334155;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .vuln {
            color: #f87171;
        }

        .safe {
            color: #4ade80;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>💻 XSS Demonstration</h1>

    <p class="vuln">Mode Vulnérable (XSS possible)</p>

    <form method="POST">
        <input type="text" name="comment" placeholder="Write a comment...">
        <br>
        <button type="submit">Send</button>
    </form>

    <h3>💬 Comments:</h3>

    <?php
    // Tableau pour stocker temporairement
    static $comments = [];

    if(isset($_POST['comment'])) {
        $comments[] = $_POST['comment'];
    }

    foreach($comments as $c) {
        echo "<div class='comment'>$c</div>"; // ❌ vulnérable
    }
    ?>
</div>

<hr>

<div class="container">
    <h2>🛡️ Version Sécurisée</h2>
    <p class="safe">Protection contre XSS activée</p>

    <?php
    if(isset($_POST['comment'])) {
        echo "<div class='comment'>" . htmlspecialchars($_POST['comment']) . "</div>";
    }
    ?>
</div>

</body>
</html>