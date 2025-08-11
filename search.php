<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            max-width: 800px;
            margin: auto;
            padding: 40px;
             background: linear-gradient(135deg, #74ebd5, #ACB6E5);
        }
        h2 {
            color: #333;
        }
        .post {
            background: #fff;
            padding: 20px;
            border-left: 4px solid  #45a049;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .post h3 {
            margin-top: 0;
            color:  #45a049;
        }
        .post p {
            margin: 10px 0;
        }
        .date {
            font-size: 0.85em;
            color: #666;
        }
        a {
            color: purple;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Search Results</h2>
<a href="index.php">← Back to Home</a>
<br><br>

<?php
if (isset($_GET['query'])) {
    $search = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM posts WHERE title LIKE '%$search%' OR content LIKE '%$search%' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='post'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['content'] . "</p>";
            echo "<div class='date'>Posted on: " . $row['created_at'] . "</div>";
            echo "</div>";
        }
    } else {
        echo "No matching posts found.";
    }
}
?>

</body>
</html>
