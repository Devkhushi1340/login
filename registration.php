<?php
session_start();
   ini_set ( 'error_reporting', E_ALL );
  ini_set ( 'display_errors', '1' );
  ini_set ( 'start_up_errors', '1' );
  error_reporting ( E_ALL ^ E_NOTICE );

$dispaly_msg="";
$name = $email = $address = $number = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//print_r($_POST);
	$name=$_POST["name"];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$address=$_POST['address'];
	$number=$_POST['number'];
  if (empty($_POST["name"])) {
    $dispaly_msg = "Name is required";
  } 
  elseif (empty($_POST["email"])) {
    $dispaly_msg = "Email is required";
  }
  elseif (empty($_POST["password"])){
	  $dispaly_msg = "Password is required";
  }
  elseif (empty($_POST["address"])){
	  $dispaly_msg = "Address is required";
  }elseif (empty($_POST["number"])){
	  $dispaly_msg = "Number is required";
  }else{
	 $conn= mysqli_connect('localhost','root','','registration');
   if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $sql="select * from register where email='$email'";
  $result = mysqli_query($conn, $sql); 
         if(mysqli_num_rows($result)>0)
         {
          echo "Allready exits";
         }
         else{
  //echo "Connected successfully";
$query="insert into register(name,email,password,address,number) values ('$name','$email','$hash','$address','$number')";
//echo $query;
if (mysqli_query($conn, $query)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
 //header("Location:login.php");
 ?>
 <script>
         setTimeout(function(){
            window.location = "<?php echo 'login.php';?>";
         }, 5000);
      </script>
      <?php
  }
}
}
 ?>
 <html>
    <head>
	    <title>Registration Page</title>
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
	 <h3> Registration Here </h3>
      <form action="" method="POST">
   <div class="mb-3 mt-3">
   <?php echo $dispaly_msg; ?>
   <label for="email" class="form-label">Name:</label>
     <span class="error"></span>
    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
    <label for="email" class="form-label">Email:</label>
	<span class="error"></span>
    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">Password:</label>
	<span class="error"></span>
    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
  </div>
  <label for="address">Address:</label>
  <span class="error"></span>
  <textarea class="form-control" rows="2" id="address" name="address" placeholder="Enter Address"></textarea>
  <div class="mb-3">
  <label for="number">Number:</label>
   <span class="error"></span>
   <input type="number" class="form-control" placeholder="Enter Mobile Number" id="number" name="number">
  </div>
 <div class="d-grid">
  <button type="submit" name="button" class="btn btn-primary btn-block">Submit</button>
</div>
</form>
</div>
    <div class="col-sm-3">
      </div>
  </div>
</div>
<div class="footer">
    <?php include 'footer.php';?>
      </div>	    
</body>
</html>
