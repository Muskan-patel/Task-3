<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>All Blog Posts</title>
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

        form {
            margin-bottom: 30px;
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #45a049;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .post {
            background: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 5px solid  #45a049;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .post h3 {
            margin-top: 0;
            color: #45a049;
        }

        .post p {
            margin: 10px 0;
        }

        .date {
            font-size: 0.85em;
            color: #666;
        }

        .pagination {
            margin-top: 30px;
        }

        .pagination a {
            display: inline-block;
            margin: 5px;
            padding: 8px 12px;
            background-color: #ddd;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color:  #45a049;
            color: white;
        }

        </style>
</head>
<body>

<h2>All Blog Posts</h2>

<form action="search.php" method="GET">
    <input type="text" name="query" placeholder="Search posts..." required>
    <button type="submit">Search</button>
</form>

<?php
$limit = 5; // 5 posts per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='post'>";
    echo "<h3>" . $row['title'] . "</h3>";
    echo "<p>" . $row['content'] . "</p>";
    echo "<small>Posted on: " . $row['created_at'] . "</small>";
    echo "</div>";
}

// pagination links
$res = mysqli_query($conn, "SELECT COUNT(*) FROM posts");
$total = mysqli_fetch_row($res)[0];
$total_pages = ceil($total / $limit);

echo "<div class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='index.php?page=$i'>$i</a>";
}
echo "</div>";
?>

</body>
</html>
