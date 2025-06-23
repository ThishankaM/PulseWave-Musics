<?php
require ("databasecon.php");

if (isset($_GET['query'])) {
    $query = $conn->real_escape_string($_GET['query']);
    $sql = "SELECT DISTINCT title FROM music WHERE title LIKE '%$query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>" . $row['title'] . "</div>";
        }
    } else {
        echo "No results found";
    }
}

$conn->close();
?>
