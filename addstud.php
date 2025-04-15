<?php

$Student_Name = $_POST['Student_Name'];
$Department = $_POST['Department'];
$Year_of_study = $_POST['Year_of_study'];
$Reg_no = $_POST['Reg_no'];
$Branch = $_POST['Branch'];
$section = $_POST['section'];
$ID_No = $_POST['ID_No'];
$DOB = $_POST['DOB'];
$Phone_no = $_POST['Phone_no'];
$email = $_POST['email'];
$Address = $_POST['Address'];
$book_currently_taken = $_POST['book_currently_taken'];
$book_not_return = $_POST['book_not_return'];
$Due_amt = $_POST['Due_amt'];


if(!empty($Student_Name)|| !empty($Department) || !empty($Year_of_study) || !empty($Reg_no) || !empty($Branch) || !empty($section)
|| !empty($ID_No)|| !empty($DOB)|| !empty($Phone_no)|| !empty($email)|| !empty($Address)|| !empty($book_currently_taken)
|| !empty($book_not_return)|| !empty($Due_amt) )
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname="addstud";


$conn = new mysqli  ($host, $dbusername, $dbpassword, $dbname);

if(mysqli_connect_error()){
    die('Connect Error ('.
       mysqli_connect_errno() .') '
        .mysqli_connect_error());
}
else{
    $SELECT="SELECT email From addstud where email = ? Limit 1";
    $INSERT="INSERT Into addstud(Student_Name,Department,Year_of_study,Reg_no,Branch,section,ID_No,DOB,Phone_no,
    email,Address,book_currently_taken,book_not_return,Due_amt) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s",$emai);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if($rnum==0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssssssssssiii",$Student_Name,$Department,$Year_of_study,$Reg_no,$Branch,$section,$ID_No,$DOB,$Phone_no,
        $email,$Address,$book_currently_taken,$book_not_return,$Due_amt);
        $stmt->execute();
        echo "New record updated sucessfully";
    }else{
        echo "someone already register using this email";
    }
    $stmt->close();
    $conn->close();
}
}else{
    echo"All field are required";
    die();
}
?>

