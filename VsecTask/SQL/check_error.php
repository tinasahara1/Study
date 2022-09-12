<?php
    include('connect.php');
    if (isset($_POST['username']) && isset($_POST['password']) ) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        //echo $username;
        //echo $password;
        try {
        mysql_connect("localhost", "admin", "123456") or die("Could not connect: " . mysql_error());
        mysql_select_db("users");
            

        $query="SELECT id,user,phone FROM info_user where user='$username' and passwd='$password'";
        $result = mysql_query($query);
        $count=mysql_num_rows($result);
        //echo $query .'<br>';
        //echo $result .'<br>';
        //echo $count .'<br>';
        
        //if($count==0){
        //    echo 'Invalid username or password';
            
        
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            printf("ID: %s  Name: %s   Phone: ", $row["id"], $row["user"],$row['phone']);
        }
            
            
        
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
        
    mysql_free_result($result);
    

    }
?>