<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="logoblack.png">
    <link rel="stylesheet" href="./css/massage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" />

    <title>One Paradise Massage</title>
</head>

<body>
        <!-- Massage Section -->
        <section id="massages">
        <div class="container-fluid my-5">
            <h1 class="text-center">Massage</h1>
            <div class="row">
                <div class="col-12 m-auto">
                    <div class="owl-carousel owl-theme">
                        <?php include 'connection.php';
                        $sql = "SELECT * FROM MASSAGE;";
                        $run = mysqli_query($conn,$sql);
                        
                        while($data = mysqli_fetch_array($run)){
                            $massageID = $data['massageID'];
                            $massageName = $data['massageName'];
                            $description = $data['massageDescr'];
                            $massagePrice = $data['massagePrice'];
                            $imagedir = $data['imgdir'];
                            $imagedir = substr($imagedir,1);

                            echo '
                            <div class="item">
                                <div class="card border-0">
                                    <div class="massage-title">
                                        <h3>'.$massageName.'</h3>
                                    </div>
                                    <div class="card-img">
                                        <img src="'.$imagedir.'" alt="'.$massageName.'">
                                    </div>
                                    <div class="card-detail">
                                        <div class="detail">
                                        <p>'.$description.'</p>
                                        </div>
                                        <div class="price">
                                            <p>RM '.$massagePrice.' </p>
                                        </div>
                                    </div>
                                    <hr class="line">
                                </div>
                            </div>';  
                        }?>

                
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Massage Section -->

</body>

    <script src="app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
    
    </body>
    
    </html>