<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body class="nl-blurred">
		<div class="container demo-1">
			<div class="main clearfix">
				<form id="nl-form" class="nl-form" action="index.php" method="POST">
					I am <input type="text" name="name" value="" placeholder="Name" data-subline="Your Full Name"/>
					,<input type="text" name="regno" value="" placeholder="Registration Number" data-subline="Your Registration Number"/>
					currently <select name="type">
						<option value="1" selected>a STUDENT</option>
						<option value="2">an EMPLOYEE</option>
						<option value="3">OTHERS</option>
					</select> in <input type="text" value="" placeholder="School/College" data-subline="Name of the current institution"/>
					and i <select name="agree">
						<option value="1" selected> 1WOULD</option>
						<option value="2"> WOULD NOT</option>
					</select> like to recieve updates on<input type="text" name="email" value="" placeholder="XXXXX@XXX.XXX" data-subline="Please enter a <em>valid</em> email id"/>
					<div class="nl-submit-wrap">
						<button class="nl-submit" type="submit">SUBMIT</button>
					</div>
					<div class="nl-overlay"></div>
				</form>
			</div>
		</div><!-- /container -->
		<script src="js/nlform.js"></script>
		<script src="js/svgcheckbx.js"></script>
		<script>
			var nlform = new NLForm( document.getElementById( 'nl-form' ) );
		</script>
<?php
function check($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//$con=mysqli_connect('server_name','DB_NAME','DB_PASS','DB_TABLE_NAME');
$con=mysqli_connect('localhost','root','12345','test');
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$name=check($_POST['name']);
	$regno=check($_POST['regno']);
    $email=check($_POST['email']);
    $agree=check($_POST['agree']);
    $type=check($_POST['type']);
    $emailErr="";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
  		$emailErr = "Invalid email format"; 
	}
    if($name!="" && $email!="" && $agree!="" && $type!="" && $emailErr=="")
    {
    	echo "IN";
    	if(mysqli_query($con,"INSERT INTO contact(NAME,EMAIL,REGNO,TYPE,AGREE) VALUES('$name','$email','$regno','$type','$agree')"))
    	{
    		echo "SUCCESS";
    	}
    	else
    	{
 			 echo("Error : " . mysqli_error($con) . $emailErr);
    	}
    }

}
?>
	</body>
</html>