<!DOCTYPE html>
<html>
    <head>
        <title>Avaiable Rooms</title>
        <meta charset="utf-8">
        <style>
table, th, td {
    border: 5px solid black;
}
</style>
    </head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "hello@2022";
$dbname = "lunahotel";


$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="SELECT r_no,type,IF(seaview=0, 'no', 'yes')as seaview FROM room where r_no not in (select room_id from occupied)";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>TYPE</th><th>Seaview</th></tr>";
   
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["r_no"]. "</td><td>" . $row["type"]. "</td><td>".$row["seaview"]. "</td></tr>";
    }
    echo "</table>";
} 
else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>




