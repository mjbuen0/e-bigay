<?php 
	session_start();
	$isActive = isset($_SESSION['email']);
	if($isActive){
		$user = $_SESSION['email'];
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>E-Bigay</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicons -->
  <link href="assets/img/logo2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700"
    rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- Custom CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">
      <div id="logo">
        <h1><a style="text-decoration:none" href="index.php"><span>E-Bigay <img src="assets/img/logo2.png" alt="" style="width:50px"></span></a></h1>
      </div>
      <nav id="navbar" class="navbar">
        <ul>
          <?php
            switch ($isActive) {
              case 'value' :{
                include('assets/php/config.php');
                $email = $_SESSION['email'];
                $sql = "SELECT * FROM registered_accounts WHERE email = '" .$_SESSION['email']. "'";
                $res = mysqli_query($con, $sql );
                if(! $res ) {
                  die('Could not get data: ' . mysql_error());
                }
                while($row=mysqli_fetch_array($res)){
                  $name = $row["name"];
                  $role = $row['role'];
                  
                }
                if ($role == 'Recipient') {
                  echo "<li><a class='nav-link scrollto' href='recipient_profile.php'>". $name ."</a></li>";
                ?>
                  <li class="nav-item dropdown">
                      <a href="#" class="nav-link " data-bs-toggle="dropdown">
                        <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
                        <i class="fas fa-bell" style="font-size:18px;"></i></a>
                      <div class="dropdown-menu" style="padding-left:5px;width:300px;">
                      </div>
                  </li>
                <?php
                } else {
                  echo "<li><a class='nav-link scrollto' href='donor_profile.php'>". $name ."</a></li>";
                ?>
                  <li class="nav-item dropdown">
                    <a href="#" class="nav-link " data-bs-toggle="dropdown">
                      <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
                      <i class="fas fa-bell" style="font-size:18px;"></i></a>
                    <div class="dropdown-menu" style="padding-left:5px;width:300px;">
                    </div>
                </li>
                <?php
                }
                break;
              }
              default:{
                echo "";
                break;
              }
            }
          ?>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <?php
            switch ($isActive) {
              case 'value' :{
                echo "<li><a class='nav-link scrollto' href='assets/php/logout.php' style='color: red'>Log Out</a></li>";
                break;
              }
              default:{
                echo "<li><a class='nav-link scrollto' href='loginpage.php'>Log-In</a></li>";
                break;
              }
            }
            
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->
  <!-- ======= hero Section ======= -->
  <section id="hero">
    <div class="hero-content" data-aos="fade-up">
      <?php 
        switch($isActive) {
          case 'value':{
            if($role == "Donor") {
              echo "<h2>Total Accumulated Amount</h2>";
              echo "<h2 id='time'>As of:</h2>";
              echo "<h2 id='total-amount'>Calculating...</h2>";
            } else {
              echo "<h2>E-Bigay handang magbigay!</h2>";
            }
          }
          break;
          default:{
            echo "<h2>E-Bigay handang magbigay!</h2>";
            echo '
            <div>
              <a href="loginpage.php" class="btn-projects scrollto">Donate Now!</a>
            </div>
            ';
          }
          break;
        }
      ?>
      
    </div>
    <div class="hero-slider swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/1.jpg');"></div>
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/2.jpg');"></div>
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/3.jpg');"></div>
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/4.jpg');"></div>
        <div class="swiper-slide" style="background-image: url('assets/img/hero-carousel/5.jpg');"></div>
      </div>
    </div>
  </section><!-- End Hero Section -->
  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="assets/img/AboutUs.png" alt="">
          </div>
          <div class="col-lg-6 content">
            <h2>E-Bigay Online Community Pantry</h2>
            <h3><b>Sangguniang Kabataan Barangay Maharlika</b></h3>
            <ul>
              <li><i class="bi bi-check-circle"></i> Aims to help government organizations find the right beneficiaries
                for their initiatives.</li>
              <li><i class="bi bi-check-circle"></i> Receive donations from both publicand private institutions, and
                make things easier for both organizations and receivers.</li>
              <li><i class="bi bi-check-circle"></i> Intends to offer appropriate scheduling of products to be delivered
                to the recipients.</li>
            </ul>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->
    <!-- ======= Team Section ======= -->
    <section id="team">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Our Team</h2>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic"><img src="assets/img/team-1.jfif" alt=""></div>
              <div class="details">
                <h4>Diego Angelo Garalde</h4>
                <span>E-Bigay Leader</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic"><img src="assets/img/team-2.png" alt=""></div>
              <div class="details">
                <h4>Mark Joshua Bueno</h4>
                <span>E-Bigay Member</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="member">
              <div class="pic"><img src="assets/img/team-3.png" alt=""></div>
              <div class="details">
                <h4>Antonio Miguel Santos</h4>
                <span>E-Bigay Member</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Team Section -->
    <!-- ======= Contact Section ======= -->
    <section id="contact">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Contact Us</h2>
          <p></p>
        </div>
        <div class="row contact-info">
          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <address>Barangay Maharlika, Quezon City</address>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Contact Number</h3>
              <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">E-Bigay@gmail.com</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="container mb-4">
      
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1930.0553117453323!2d121.0546853009068!3d14.649661316682016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1smaharlika!5e0!3m2!1sen!2sph!4v1651207322166!5m2!1sen!2sph"
          width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      <div class="container">
        <div class="form">
            <?php
              switch($isActive) {
                case 'value':{
                  ?>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>" readonly>
                    </div>
                    <div class="form-group col-md-6 mt-3 mt-md-0">
                      <input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" readonly>
                    </div>
                  </div>
                  <?php
                }
                break;
                default: {
                  ?>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group col-md-6 mt-3 mt-md-0">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                    </div>
                  </div>
                  <?php
                }
                break;
              }
            ?>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="text-center"><button class="btn btn-primary" id="send">Send</button></div>
        </div>
      </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Reveal</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
      -->
      </div>
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/fetch_total_amount.js"></script>
  <script src="assets/js/validatemessage.js"></script>
  <?php
  if ($role == 'Recipient') {?>
    <script src="assets/js/recipient_notif.js"></script>
  <?php
  } else {?>
    <script src="assets/js/donor_notif.js"></script>
  <?php
  }
  ?>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  
</body>

</html>