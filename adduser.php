<?php
$servername = "localhost";
$username = "root";
$password = "hello@2022";
$dbname = "lunahotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$Name   =$_POST['cname'];
$Country=$_POST['ccountry'];
$ID     =$_POST['cid'];
$Email  =$_POST['cemail'];
$Fdate  =$_POST['cfirst'];
$Phone  =$_POST['cphone'];

$Room =$_POST['croom'];

$sql = "SELECT r_no FROM room where r_no='$Room' and occupied <>'1' ";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    $sql1 = "INSERT INTO client VALUES ('$ID','$Name', '$Country', '$Phone','$Email','$Fdate')";
    if ($conn->query($sql1) === TRUE) {
        $sql2="UPDATE room SET occupied='1' WHERE r_no='$Room'";
        $rs=$conn->query($sql2);
        $sql3="INSERT INTO occupied VALUES ('$ID','$Room','$Fdate')";
        $rs1=$conn->query($sql3);
        echo "New record created successfully";
    }
    else {
          echo "Dear Receptionist:<br>Please Check the Data You Just Entered<br><br><br>Frequent Issues:<br>".
          "1- You Entered the ID of an Exisiting Client.<br>
           2- You Entered a wrong type of date (exp:numbers in the name field ,etc...).<br>
           ";
    }
}
else{
    echo "Dear Receptionist:<br>Please Check the Data You Just Entered<br><br><br>Frequent Issues:<br>".
    "The Room Number Is Not a Vaild Number Or The Room Is Already Occupied";    
}
$conn->close();
?>