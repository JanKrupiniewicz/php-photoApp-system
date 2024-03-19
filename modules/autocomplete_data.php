<?php
include "../includes/db.php";

$query = "SELECT * FROM users WHERE username LIKE '%{$_GET['term']}%'";
$result = mysqli_query($connection, $query);

$autocomplete_data = array();
while($row = mysqli_fetch_assoc($result)) {
    $autocomplete_data[] = $row['username'];
}

header('Content-Type: application/json');
echo json_encode($autocomplete_data);

