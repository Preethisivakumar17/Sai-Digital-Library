<?php

$username = $_POST['username'];
$password = $_POST['password'];

if(!empty($username)|| !empty($password))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname="loginpage";


$conn = new mysqli  ($host, $dbusername, $dbpassword, $dbname);

if(mysqli_connect_error()){
    die('Connect Error ('.
       mysqli_connect_errno() .') '
        .mysqli_connect_error());
}
else{
    $SELECT="SELECT username From login where username = ? Limit 1";
    $INSERT="INSERT Into login(username, password ) values(?,?)";

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("i",$username);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if($rnum==0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("is",$username,$password);
        $stmt->execute();
        echo "login  sucessfully";
        echo '<a href="stud_dashboard.html">click here</a>';

    }else{
        echo "someone already register using this username";

    }
    $stmt->close();
    $conn->close();
}
}else{
    echo"All field are required";
    die();
}
?>