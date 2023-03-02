<?php 

include 'connection.php';

if (isset($_POST['register'])) {
	$name = $_POST['name'];
	$gender = $_POST['radio'];
	$dob = $_POST['dob'];
	$pNo = $_POST['phoneNo'];
	$email = $_POST['email'];
	$role = $_POST['role'];
	$password =$_POST['password'];
	$cpassword = $_POST['cPassword'];

	$regexname="/^[a-zA-Z ]*$/";
	$regexphone="/^[0]\d{9}/";

	
	if ($password == $cpassword) {
		$sql = "SELECT * FROM User WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		$encpass = password_hash($password, PASSWORD_BCRYPT);
		if(preg_match($regexname,$name)){
			if(preg_match($regexphone,$pNo)){
				if (!(mysqli_num_rows($result)) > 0) {
					$sql = "INSERT INTO User (name, gender, dob, phoneNo, email, password,role,image) VALUES (?,?,?,?,?,?,?,?)";
					$image="None";
					if ($stmt = mysqli_prepare($conn, $sql)) {
						mysqli_stmt_bind_param($stmt, "ssssssss", $name, $gender, $dob, $pNo, $email, $encpass,$role,$image);
						mysqli_stmt_execute($stmt);
						echo "<script>alert('Wow! User Registration Completed.'); window.location='index.php'</script>";
						mysqli_stmt_close($stmt);
					} else {
						echo "<script>alert('Woops! Something Went Wrong.'); window.location='index.php'</script>";
					}
				} else {
					echo "<script>alert('Woops! Email Already Exists.'); window.location='index.php'</script>";
				}
			} echo "<script>alert('Inavlid phone format. Please try again.'); window.location='index.php'</script>";

		} else {
			echo "<script>alert('Inavlid name, numeric characters and special symbols are not allowed.'); window.location='index.php'</script>";
		}

		
	} else {
		echo "<script>alert('Password Not Matched.'); window.location='index.php'</script>";
	}

}else{
	echo "<script>alert('Please fill in the register form first.'); window.location='index.php'</script>";
}

	

mysqli_close($conn);
?>