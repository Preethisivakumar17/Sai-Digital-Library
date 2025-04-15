<?php

$Student_Name = $_POST['Student_Name'];
$Student_ID_No = $_POST['Student_ID_No'];
$Book_Name = $_POST['Book_Name'];
$Author_Name = $_POST['Author_Name'];
$Date_of_collect = $_POST['Date_of_collect'];


if(!empty($Student_Name)|| !empty($Student_ID_No) || !empty($Book_Name) || !empty($Author_Name) || !empty($Date_of_collect))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname="addbook";


$conn = new mysqli  ($host, $dbusername, $dbpassword, $dbname);

if(mysqli_connect_error()){
    die('Connect Error ('.
       mysqli_connect_errno() .') '
        .mysqli_connect_error());
}
else{
    $SELECT="SELECT Student_ID_No From addbook where Student_ID_No = ? Limit 1";
    $INSERT="INSERT Into addbook(Student_Name,Student_ID_No,Book_Name,Author_Name,Date_of_collect ) values(?,?,?,?,?)";

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$Student_ID_No);
    $stmt->execute();
    $stmt->bind_result($Student_ID_No);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if($rnum==0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssss",$Student_Name,$Student_ID_No,$Book_Name,$Author_Name,$Date_of_collect);
        $stmt->execute();
        echo "New book updated sucessfully";
    }else{
        echo "someone already register using this ID no";
    }
    $stmt->close();
    $conn->close();
}
}else{
    echo"All field are required";
    die();
}
?>

