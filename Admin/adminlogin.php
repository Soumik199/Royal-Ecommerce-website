<?php
 session_start();
 include_once "../util/database.php";
 if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user = $_POST['user'];
    $password = $_POST['password'];
    //$remember = $_POST['remember'];
    $query="SELECT * FROM admin WHERE user =:user and password=:password";
    $run=$con->prepare($query);
    $run->bindValue(':user',$user);
    $run->bindValue(':password',$password);
    $run->execute();
//data collected from the database
$results=$run->fetchAll(PDO::FETCH_OBJ);
// var_dump($results);
$i=0;
    if($run->rowCount() > 0){
        $_SESSION['user']=$user;
          $_SESSION['id']= $results[$i]->id;
         //   $_SESSION['utype']= $results[$i]->usertype;

        echo "user logged in ";
           // echo  $_SESSION['utype'];
         header("location:Admin.php");

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
    <title>Admin Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/admin.css" class="css">
</head>
<body>
<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center"> Admin Login </h2>
		    <form class="login-form" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
    <input type="text" name="user" class="form-control" placeholder=" Username*" autocomplete="off" value="<?php if(isset($_COOKIE["user"])) { echo $_COOKIE["user"]; } ?>"/>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password*" autocomplete="off" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" name="password" />
  </div>
    <div class="form-check">
    <button type="submit" class="btn btn-login float-right">Submit</button>
  </div>
</form>
		</div>
		<div class="col-md-8 banner-sec">

            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>This is Heaven</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
        </div>	
  </div>
          </div>	   
		    
		</div>
	</div>
</div>
</section>
</body>
</html>