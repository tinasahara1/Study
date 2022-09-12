<?php
    include('connect.php');
    if (isset($_POST['username']) && isset($_POST['password']) ) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
        $query="SELECT id,user,phone FROM info_user where user='$username' and passwd='$password'";


        $stmt = $connection->prepare($query);
        $stmt->execute();
        $count=$stmt->rowCount();
        $result =  $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if($count==0){
            echo 'Invalid username or password';
            
        }else {
            echo 'Logged in successfully<br>'; 
            echo 'Customer information <br>'; 
            $result = $stmt->fetchAll();
            foreach ($result as $row) {
                echo 'id :      ' .$row['id'] .'<br>';
                echo 'user:     '. $row['user'] .'<br>';
                echo 'phone:    '. $row['phone'] .'<br>';
                }
        }
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
        
    $connection = null;
    

    }
?>