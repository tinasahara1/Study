<?php
    include('connect.php');
    if (isset($_POST['username']) && isset($_POST['password']) ) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        //echo $username;
        //echo $password;
        try {
        $query="SELECT id,user,phone FROM info_user where user='$username' and passwd='$password'";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $count=$stmt->rowCount();
        $result =  $stmt->setFetchMode(PDO::FETCH_ASSOC);
        //echo $query .'<br>';
        //echo $result .'<br>';
        //echo $count .'<br>';

        if($count==0){
            echo "";
        }else {
            echo 'Logged in successfully<br>'; 
        }
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
        
    $connection = null;
    

    }
?>