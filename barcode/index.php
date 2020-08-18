<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Encode Workshop Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="css/main.css">
</head>

<body class="bg-light">
<div class="jumbotron text-center text-white bg-primary">
<img id="logo" class="pb-1" src="logo.jpg" alt="LOGO">
<h2 id="heading">Registration Form</h2>
</div>

<div class="container ">
<?php 
if(isset($_SESSION['error'])){
		echo "<p style='color:red'>".$_SESSION['error']."</p>";
		$_SESSION['error']="";
}
?>
<form action="Controller.php" method="post" enctype="multipart/form-data">
  <label for="fname">First name : </label>
  <input type="text" id="fname" name="fname" required placeholder="Magnus"><br><br>
  <label for="lname">Last name : </label>
  <input type="text" id="lname" name="lname" required placeholder="Carlsen"><br><br>
   <label for="lname">Email : </label>
  <input type="email" id="lname" name="email" required placeholder="abc@gmail.com"><br><br>
  <label for="ph">Mobile Number : </label>
  <input type="text" id="ph" name="phone" required><br><br>
  <label for="roll">Roll Number : </label>
  <input type="text" id="roll" name="enroll" required placeholder="19BITXX"><br><br>
  <label for="branch">Branch :</label>
  <select id="branch" name="branch">
	<option value="Computer">Computer</option>
	<option value="ICT">ICT</option>
	<option value="Chemical">Chemical</option>
	<option value="Mechanical">Mechanical</option>
	<option value="Petroleum">Petroleum</option>
  </select><br><br>
   <label for="branch">Semester :</label>
  <select id="branch" name="sem">
	<option value="3">3</option>
	<option value="5">5</option>
	<option value="7">7</option>
  </select><br><br>
  <label for="img">Image : </label>
  <input type="file" id="img" name="filename"  required><br><br>
  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
</form> 
</div>
</body>
</html>
