<?php
    session_start(); //khai bao session
    include('connect.php');
    if (isset($_POST['username']) && isset($_POST['password']) ) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query="SELECT * FROM users where user='$username'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result =  $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        //foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        //    echo $v;
        //}
        if(!$result){
            echo 'Invalid account or password';
        }else{
            echo 'Logged in successfully';
            foreach ($result as $row) {
                echo $row['id'] . '\n';
                echo $row['user'] . '\n';
                echo $row['passwd'] . '\n';
                echo $row['phone'] .'\n';
                }
        }
        

    $connect->close();

    }
?>