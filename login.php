<?php
  session_start();  
  ini_set ( 'error_reporting', E_ALL );
  ini_set ( 'display_errors', '1' );
  ini_set ( 'start_up_errors', '1' );
  error_reporting ( E_ALL ^ E_NOTICE );

    $email= $password="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=$_POST['email'];
	  $password=$_POST['password'];
    //check Requered field.............
	  if (empty($_POST["email"])) {
        $dispaly_msg = "Name is required";
      } 
      elseif (empty($_POST["password"])) {
        $dispaly_msg = "Password is required";
      }
      else{
        //Databse connect.....
        $conn= mysqli_connect('localhost','root','','registration');
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
          //echo "Connected successfully";
          $sql="select * from register where email='$email'";
           $result = mysqli_query($conn, $sql);  //query run....
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
          $count = mysqli_num_rows($result);  
          //print_r($row);
          if(mysqli_num_rows($result)>0)//check email in database....
         {
          $pass=$row['password'];
          $email=$row['email'];
          if (password_verify($password, $pass)) {//password verify and match....
            echo " Login successful ";  
            $_SESSION["user"] =$row['email']; 
             ?>
             <script>
               setTimeout(function(){
               window.location = "<?php echo 'view.php';?>";
               }, 3000);
             </script>
            <?php
        } 
        else {
            echo 'Invalid password.';//for password .............
        }
      }
      else
      {
        echo "Invalide Email";//for email.................
      }
  }
}
?>
<html>
    <head>
	    <title>Login Page</title>
		<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body> 
	<div class="menu">
<?php include 'header.php';?>
</div>
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-3">
      </div>
    <div class="col-sm-6">
	 <h3> Login Here </h3>
      <form action="" method="POST">
   <div class="mb-3 mt-3">
    <label for="email" class="form-label">Email:</label>
	<span class="error"></span>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">Password:</label>
	<span class="error"></span>
    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
  </div><br>
  <div class="d-grid">
  <button type="submit" name="button" class="btn btn-primary btn-block">Login</button>
</div>
</form>
</div>
</div>
</div>	 
<div class="footer">
 <?php include 'footer.php';?>
</div>   
</body>
</html>