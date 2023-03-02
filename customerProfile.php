<?php 
    session_start();
    session_start();
    if(isset($_SESSION['userID'])){
		$userID=$_SESSION['userID'];
	}else{
		echo "<script>alert('Please login first. Click the top right icon to login.'); window.location='index.php'</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>One Paradise Massage</title>
</head>
<body>
    <?php include 'header.php';?>

    <section id="profile">
        <div class="frame">
            <?php 
            include 'connection.php';
            $sql="SELECT * FROM user WHERE userID='$userID';";
            $run=mysqli_query($conn,$sql);

            while($data=mysqli_fetch_array($run)){
                $userID=$data['userID'];
                $name=$data['name'];
                $gender=$data['gender'];
                $dob=$data['dob'];
                $phoneNo=$data['phoneNo'];
                $email=$data['email'];
                $image=$data['image'];
                
                    ?>
                    <div class="boxx">
                        <div class="left">
                            <h2>Your Profile</h2>
                            <div class="pp">
                                <?php if($image=="None"){
                                    echo '<img src="avatar.png">';
                                }else
                                    echo "<img src='$image'>";
                                ?>
                            
                            </div>
                        </div>
                        
                        <div class="left">
                            <div class="text">
                            <p><span>Name:</span><br><?=$name?></p><br>
                            <p><span>Gender:</span><br><?=$gender?></p><br>
                            <p><span>Date of Birth:</span><br><?=$dob?></p><br>
                            <p><span>Phone Number:</span><br><?=$phoneNo?></p><br>
                            <p><span>Email:</span><br><?=$email?></p><br>
                            <div class="done">
                                <a href="editprofileform.php?userID='.$userID.'" class="done-btn">Edit</a> 
                                <a href="logout.php" class="done-btn">Log Out?</a>
                             
                            </div>
                            </div>
                        </div>

                    </div>
                ';<?php
                
                
            
            }
        ?>
        </div>
    </section>

</body>
</html>
