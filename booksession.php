<?php
    session_start();

    if(!isset($_SESSION['userID'])){
        echo "<script>alert('Please login first. Click the top right icon to login.'); window.location='index.php'</script>";
    }else if(isset($_GET['check'])){
        $date = $_GET["date"];
        $mID = $_GET["massageID"];
    }else{
        echo "<script>alert('Please select a date first.'); window.location='checksession.php'</script>";
    }
?>

<?php 
      include 'header.php';

?>     


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	


	
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300&display=swap" rel="stylesheet">

	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	
	<link type="text/css" rel="stylesheet" href="booking.css" />
    <style>
        .error {color: #FF0000;
                font-size: 12px;}
        .div1{
            display:flex;
            justify-content: space-between;
        }
    </style>

</head>

<body>

	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="booking-cta">
							<h1>Book your appointment now</h1>
							<p>Trust us as your massage service with our massage specialist.</p>
						</div>
					</div>
					<div class="col-md-7 col-md-offset-1">
						<div class="booking-form">
                        <form action ="bookingprocess.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="hidden" name="date" value="<?php echo $date?>">
                        <input type="hidden" name="massageID" value="<?php echo $mID?>">
                                            
								
								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label2">Timeslot</span><br>
                                            <?php include 'connection.php';

                                                $arr1[]="";
                                                $sql = "SELECT t.*
                                                FROM Timeslot t, Booking b
                                                WHERE b.date = '$date'
                                                AND b.startTime = t.startTime;";
                                                $run = mysqli_query($conn,$sql);
                                                while($data=mysqli_fetch_array($run)){
                                                    $sT = $data['startTime'];
                                                    $eT = $data['endTime'];

                                                    $merge = array($sT,$eT);
                                                    $timeslot = implode(" ~ ",$merge);
                                                    $arr1[] = ($timeslot);
                                                }

                                                //print_r($arr1);
                                                echo"<br>";
                                                $err="";?>
                                                    <select id="timeslot" name="timeslot">
                                                        <?php 
                                                        include '../connection.php';
                                                        $sql = "SELECT * FROM Timeslot;";
                                                        $run = mysqli_query($conn,$sql);
                                                        while($data=mysqli_fetch_array($run)){
                                                            $startTime = $data['startTime'];
                                                            $endTime = $data['endTime'];

                                                            $merge = array($startTime,$endTime);
                                                            $timeslot = implode(" ~ ",$merge);
                                                            $arr2=array($timeslot);

                                                            $intersect=array_intersect($arr1,$arr2);
                                                        
                                                            
                                                            if(!(array_intersect($arr1,$arr2))){
                                                                echo"<option value='$timeslot' required>$timeslot </option>";
                                                            }
                                                        }    
                                                    
                                                    echo '</select>';
                                                    if((array_sum($intersect))==(array_sum($arr2))){
                                                        $err="Fully Booked, please choose another date";
                                                    }
                                                    ?>
                                                <?php
                                                //print_r($arr2);
                                                echo "<br>";
                                                ?>
											
										</div>
									</div>
								</div>
								<div class="div2">
                                    <span class="error"><?php echo "<br>".$err;?></span>
                                </div>
								
								
									
								
                                <div class="buy-now2">
                                    <a class ="buy-btn" href="checksession.php">Back</a>

                                    <?php
                                    if(empty($err)){?>
                                    <button class="submit-btn" name="submit">Book</button>
                                    <?php }
                                    ?>
                                </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>