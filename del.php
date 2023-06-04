<?php

$servername = "localhost";
$username = "root";
$password = "hello@2022";
$dbname = "lunahotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cid = $_POST["id"];

$sql = "SELECT id FROM client where id='$cid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Dear Receptionist:<br>Please Check the Data You Just Entered<br><br><br>Frequent Issues:<br>".
    "You Entered the ID of an Exisiting Client.";
} 
else {
    $sql2 = "SELECT room_id FROM occupied where client_id='$cid'";
    $result2 = mysqli_query($conn, $sql2);
    while($row = mysqli_fetch_array($result2)) {
        $del=$row["room_id"];
        $sql4="UPDATE room SET occupied='0' WHERE r_no='$del' ";
        $rs1=$conn->query($sql4);
    }
    $sql3="DELETE FROM client WHERE id='$cid'";
    $rs=$conn->query($sql3);
    echo "client is now deleted";
}
?>
