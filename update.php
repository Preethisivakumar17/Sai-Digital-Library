<?php

$Book_Name = $_POST['Book_Name'];
$Author_Name = $_POST['Author_Name'];
$Book_ID = $_POST['Book_ID']
$Date_of_Buy= $_POST['Date_of_Buy'];


if(!empty($Book_Name)|| !empty($Author_Name) || !empty($Book_ID)|| !empty($Date_of_Buy))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname="update";


$conn = new mysqli  ($host, $dbusername, $dbpassword, $dbname);

if(mysqli_connect_error()){
    die('Connect Error ('.
       mysqli_connect_errno() .') '
        .mysqli_connect_error());
}
else{
    $SELECT="SELECT Book_ID From update where Book_ID = ? Limit 1";
    $INSERT="INSERT Into update(Book_Name,Author_Name,Book_ID,Date_of_Buy ) values(?,?,?,?)";

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$Book_ID);
    $stmt->execute();
    $stmt->bind_result($Book_ID);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if($rnum==0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssss",$Book_Name,$Author_Name,$Book_ID,$Date_of_Buy);
        $stmt->execute();
        echo "New record updated sucessfully";
    }else{
        echo "somebook already register using this ID no";
    }
    $stmt->close();
    $conn->close();
}
}else{
    echo"All field are required";
    die();
}
?>