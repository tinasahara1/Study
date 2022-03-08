<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
body {
    background-color: LightGray;
}

.login{  
    width: 382px;  
    overflow: hidden;  
    margin: auto;  
    margin: 20 0 0 450px;  
    padding: 80px;  
    background: #696969;  
    border-radius: 15px ;
    border: 3;
}

.tab {
    display: inline-block;
    margin-left: 40px;
}

#Uname {
    width: 350px;
    height: 30px;
    border: 3;
    border-radius: 3px;
    padding-left: 8px;
    background: #DCDCDC;
}

#Pass {
    width: 350px;
    height: 30px;
    border: 3;
    border-radius: 3px;
    padding-left: 8px;
    background: #DCDCDC;
}

</style>
</style>


<body>
    <h1 style="font-family:Comic Sans Ms;text-align=center;font-size: 400%;" align="middle">
        Login page
    </h1>
    <div class="login">
    <form id="login" method="post" action="check.php">
        <label><b>Username</b></label>
        <input type="text" name="user" id="Uname" placeholder="Username" ><br><br>
        <label><b>Password</b></label>
        <input type="Password" name="passwd" id="Pass" placeholder="Password"><br><br>
        <span class="tab"></span><span class="tab"></span>
        <input type="submit" value="Login" >
        <?php require 'check.php';?>
        
    </form>   
        <!--<img src="hello.jpg" alt="Helloo" style="width:400px;height:250px;" align="right"  hspace="200"> -->
</body>

</html>
