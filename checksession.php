<?php
    session_start();
	date_default_timezone_set('Asia/Calcutta');
    if(!isset($_SESSION['userID'])){
        echo "<script>alert('Please login first. Click the top right icon to login.'); window.location='index.php'</script>";
    }else{
        $id=$_SESSION['userID'];
    }
    

    $today = date("Y-m-d",time());
    $bdate = date('Y-m-d', strtotime($today. ' + 1 days'));


    include 'connection.php';
    if(isset($_POST['submit'])){

        if ((!(isset($_POST['date']))) || (strtotime($_POST['date']) ==false)) {
            $dateErr = "Enter Date";
        } else {
            $date=$_POST["date"];
        }
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


</head>

<body>
 
    

	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="booking-cta">
							<h1>Bookings</h1>
							<p>Trust us as your massage service with our massage specialist.</p>
						</div>
					</div>
					<div class="col-md-7 col-md-offset-1">
						<div class="booking-form">
							<form action ="booksession.php" method="GET">
						


                                
								<div class="row">
									<div class="col-md-6">
                                                <span class="form-label">Massage</label><br>
                                                <select id="massage" name="massageID">
                                                    <?php include 'connection.php';
                                                    $sql = "SELECT * FROM Massage;";
                                                    $run = mysqli_query($conn,$sql);
                                                    while($data=mysqli_fetch_array($run)){
                                                        $massageID = $data['massageID'];
                                                        $massageName = $data['massageName'];
                                                        $massagePrice = $data['massagePrice']; 
                                                        echo"<option value='$massageID'>$massageName (RM$massagePrice)</option>";
                                                    }?>
                                                </select>
									</div>


                                    <div class="col-md-6">
										<div class="form group">
										<span class="form-label">Date</span><br>
										<input class="form-control" type="date" required id="date" min="<?= $bdate?>" name="date" >

										</div>
									</div>
									
								</div>
								
								<div class="form-btn">
									<button class="submit-btn" name="check">Check Availability</button>
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