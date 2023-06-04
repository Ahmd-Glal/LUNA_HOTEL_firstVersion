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
$cdata = $_POST["new"];

$sql = "SELECT id FROM client where id='$cid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Dear Receptionist:<br>Please Check the Data You Just Entered<br><br><br>Frequent Issues:<br>".
    "You Entered the ID of an Exisiting Client.";
} else {
    if ($_POST["x"] == "country") {
        $sql2="UPDATE client SET country ='$cdata' WHERE id='$cid'";
        $rs=$conn->query($sql2);
    } else if ($_POST["x"] == "email") {
        $sql2="UPDATE client SET email ='$cdata' WHERE id='$cid'";
        $rs=$conn->query($sql2);
    }else{
        $sql2="UPDATE client SET phone ='$cdata' WHERE id='$cid'";
        $rs=$conn->query($sql2);
    }
    echo "Data is Updated";
}
?>
