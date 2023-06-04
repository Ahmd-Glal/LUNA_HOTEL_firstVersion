<?php
$servername = "localhost";
$username = "root";
$password = "hello@2022";
$dbname = "lunahotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$ID      =$_POST['cid'];
$Room    =$_POST['croom'];
$FDate    =$_POST['cres'];

$sql = "SELECT r_no FROM room where r_no='$Room' and occupied <>'1' ";
$result = mysqli_query($conn, $sql);

$sql1 = "SELECT id FROM client where id='$ID'";
$result1 = mysqli_query($conn, $sql1);

if(mysqli_num_rows($result) == 0 ){
    echo "Dear Receptionist:<br>Please Check the Data You Just Entered<br><br><br>Frequent Issues:<br>".
    "The Room Number Is Not a Vaild Number Or The Room Is Already Occupied.";
   
}
else if(mysqli_num_rows($result1) == 0){
    echo "Dear Receptionist:<br>Please Check the Data You Just Entered<br><br><br>Frequent Issues:<br>".
    "You Entered the ID of a None Exisiting Client.";
}
else{
    
    $sql2="UPDATE room SET occupied='1' WHERE r_no='$Room'";
    $rs=$conn->query($sql2);
    $sql3="INSERT INTO occupied VALUES ('$ID','$Room','$FDate')";
    $rs1=$conn->query($sql3);
    echo "New record created successfully";
}

$conn->close();
?>