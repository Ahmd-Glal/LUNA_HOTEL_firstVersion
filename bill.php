<!DOCTYPE html>
<head>
<style>
table, th, td {
    border: 5px solid black;
}
</style>
<title>Receipt</title>
</head>
<body>
</body>
</html>

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
$rid = $_POST["rid"];

$sql = "SELECT id,name FROM client where id='$cid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Dear Receptionist:<br>Please Check the Data You Just Entered<br><br><br>Frequent Issues:<br>".
    "You Entered the ID of an Exisiting Client.";
} 
else {
    $sql5="SELECT  c.id,c.name,r.r_no,r.type,r.seaview,o.reserve_Time from client c join occupied o on o.client_id=c.id join room r on o.room_id=r.r_no WHERE id='$cid' and r_no='$rid' ";
    $result=mysqli_query($conn, $sql5); 

    while($row = mysqli_fetch_array($result)) {
        $x=$row['type'];
        $y=$row['seaview'];
        $z=$row['reserve_Time'];
        $user=$row['id'];
        $uname=$row['name'];
        $uroom=$row['r_no'];
    }
    $sql6="SELECT costpn from roomcost where type='$x' and seaview='$y'";
    $price=mysqli_query($conn, $sql6);

    while($row = mysqli_fetch_array($price)) {
        $s=$row['costpn'];
    }

    $CurrentDate=date("Y-m-d");
    echo "$CurrentDate";
    $sql7="SELECT calccost('$z','$CurrentDate','$s') as be7a";
    $result2=mysqli_query($conn, $sql7);

    while($row = mysqli_fetch_array($result2)) {
        $ss=$row['be7a'];
    }
    $sql8="DELETE FROM occupied where client_id='$cid' and room_id='$rid'";
    $result3=mysqli_query($conn, $sql8);

    $sql9="UPDATE room SET occupied='0'  where r_no='$rid'";
    $result4=$conn->query($sql9);

    echo "<table><tr><th>ID</th><th>Name</th><th>ROOM Number</th><th>Total Cost</th></tr>";
    echo "<tr><td>" . "$user". "</td><td>" . "$uname"."</td><td>"."$uroom"."</td><td>"."$ss"."$".  "</td></tr>";
    echo "</table>";
}
?>
