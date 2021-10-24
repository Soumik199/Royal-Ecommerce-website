<?php
session_start();
include_once "database.php";
//It will check whether the login credentials are store in client side or not.
  
    //If the credentials are not set in client side then user have to login first
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];
        $query="SELECT * FROM people WHERE email=:email and password=:password";
    $run=$con->prepare($query);
    $run->bindValue(':email',$email);
    $run->bindValue(':password',$password);
    $run->execute();
    //data collected from the database
    $results=$run->fetchAll(PDO::FETCH_OBJ);
    // var_dump($results);
    $i=0;
       

        if($run->rowCount() > 0){
    //after the login the users credentials will be store within the  cookie using setcookie function
            if(isset($remember)){
                setcookie("email", $email, time()+(60*60*24)*2);
        //48hour=172800sec[(60*60*24)*2]
        setcookie("password",$password, time()+(60*60*24)*2);
            }
            //and within the session also for server side verification
          
            $_SESSION['email']=$email;
              $_SESSION['uid']= $results[$i]->id;
             //   $_SESSION['utype']= $results[$i]->usertype;

            echo "user logged in ";
               // echo  $_SESSION['utype'];
             header("location: productdisplay.php");

        }
        else{
            echo "Invalid User ID or Password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/login.css">
<!------ Include the above in your HEAD tag ---------->
<body>
    <div id="login banner">
        <div class="container py-5">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info"> Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Email:</label><br>
                                <input type="text" name="email" id="email" class="form-control"placeholder="Your Email *" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" name="email" />
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="text" name="password" id="password" class="form-control"placeholder="Your Password *" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" name="password" />
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember" name="remember" type="checkbox"  <?php if(isset($_COOKIE["email"])) { ?> checked<?php } ?>></span></label><br>
                               <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="registration.php" class="text-info">Register here</a>
                            </div>
                            <div class="form-group">
                            <a href="#" class="btnForgetPwd" value="Login">Forget Password?</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>