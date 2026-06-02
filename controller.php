<?php
function connect_db(){
    $host = "localhost";
    $user = "root";
    $pwd = "";
    $db = "test";
    $mysqli = new mysqli($host,$user,$pwd,$db);

    // Check connection
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
    return $mysqli;
}

function insert_user($name,$email,$password){
    $conn = connect_db();
    $sql = "INSERT INTO user (full_name,email,password) VALUES ('$name','$email','$password')";
    return $conn->query($sql);
}

function read_all_users(){
    $conn = connect_db();
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function read_user($email){
    $conn = connect_db();
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}
?>