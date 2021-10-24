<?php
  include_once "database.php";

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $name = $_POST["name"];
      $email= $_POST["email"];
      $phone= $_POST["phone"];
      $password= $_POST["password"];
      $Rpassword= $_POST["Rpassword"];

      $query=$con->prepare("Select email from people where=:email");//peope is table name in admin page
      $query->bindvalue(':email',$email);
      //$query->execuate();
      if($query->rowcount()>0){
          echo "Email already exists";
      }
      else
      {
          $sql='INSERT INTO people(name,email,phone,password,Rpassword) VALUES(:name,:email,:phone,:password,:Rpassword)';
          $statement= $con->prepare($sql);
          if($statement->execute([':name'=> $name, ':email'=> $email,':phone'=> $phone,':password'=> $password,':Rpassword'=> $Rpassword])){
           $message = "Account create sucessfull!";
          }
         else{
             echo"Data is not inserted";
         }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
<div class="card bg-light banner md-10">
<article class="card-body mx-auto" style="max-width: 400px;">
<?php if(!empty($message)):?>
    <div class ="alert alert-sucess"><h5><?=$message;?><h5></div>
<?php endif;?>
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	<p class="text-center text">Get started with your free account</p>
	<p>
		<a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
		<a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
	</p>
	<p class="divider-text">
        <span class="bg-light text-dark">OR</span>
    </p>
	<form method="POST">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="name" class="form-control" placeholder="Full name" type="text">
    </div> 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" type="email">
    </div> 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
        <input name="phone" class="form-control" placeholder="Phone Number" type="number">
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" class="form-control" placeholder="Create password" type="password">
    </div> 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="Rpassword" class="form-control" placeholder="Repeat password" type="password">
    </div>  
    <div class="form-group input-group">
    	<div class="input-group-prepend">
           <img src="captcha.php">
           <input class="form-control" type="text" placeholder="Enter Captcha" name="captcha">
             <input type="reset" value="reload" class="btn btn-danger "> 
        </div>
    </div>   
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
     </div>  
     <h5 class="text-center">Have an account? <a href="login.php" class="text-danger">Login</a> || <a href="logout.php" class="text-danger">Logout Acct.</a></h5>                                                               
</form>
</article>
 </div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>