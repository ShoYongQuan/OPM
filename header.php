<!-- Header -->
<section id="header">
    <div class="header wrap">
        <div class="nav-bar">
            <div class="headerlogo">
            <a href="#hero"><img src="logo.png"></a>
            </div>  
            <div class="nav-list">
                <ul>
                    <li><a href="index.php" data-after="Home">Home</a></li>
                    <li><a href="index.php#about" data-after="about">About</a></li>
                    <li><a href="index.php#massages" data-after="Massage">Massage</a></li>
                    <?php
                    if(isset($_SESSION['userID'])) {
                        echo '<li><a href="customerProfile.php" data-after="Profile">Profile</a></li>';
                        echo '<li><a href="appointment.php" data-after="Appointment">Appointment</a></li>';
                     }?>

                </ul>
            </div>
            <?php include 'modal.php';?>
        </div>
    </div>
</section>
