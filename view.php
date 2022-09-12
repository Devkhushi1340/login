<?php
session_start();
  ini_set ( 'error_reporting', E_ALL );
  ini_set ( 'display_errors', '1' );
  ini_set ( 'start_up_errors', '1' );
  error_reporting ( E_ALL ^ E_NOTICE );
if(empty($_SESSION['user'])){
    header("Location:login.php");
}
else{
print_r($_SESSION);
$conn= mysqli_connect('localhost','root','','registration');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
  //echo "Connected successfully";
  $sql="select * from register";
  $result = mysqli_query($conn, $sql);   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>View All Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="menu">
<?php include 'header.php';?>
<a href="logout.php">logout</a>
</div>  
</div>
<div class="container mt-3">
  <table class="table table-bordered table-sm">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Contact Number</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
    ?>
    <tr>
     <td><?php echo $i; ?></td>
     <td><?php echo $row['name']; ?></td>
     <td><?php echo $row['email']; ?></td>
     <td><?php echo $row['address']; ?></td>
     <td><?php echo $row['number']; ?></td>
    </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
</div>
<div class="footer">
    <?php include 'footer.php';?>
      </div>
</body>
</html>
