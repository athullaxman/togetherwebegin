<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Together We Begin!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Rebuild Kerala" />
  <meta name="author" content="Sreenath B S" />

  <!-- css -->
  <link href="<?php echo base_url(); ?>assets/home/css/bootstrap.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/home/css/bootstrap-responsive.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/home/css/prettyPhoto.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/home/css/style.css" rel="stylesheet">

  <!-- Theme skin -->
  <link id="t-colors" href="<?php echo base_url(); ?>assets/home/color/default.css" rel="stylesheet" />

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/home/ico/apple-touch-icon-144-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/home/ico/apple-touch-icon-114-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/home/ico/apple-touch-icon-72-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/home/ico/apple-touch-icon-57-precomposed.png" />
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/home/ico/favicon.png" />


</head>

<body>
  <div id="wrapper">
    <!-- start header -->
    <header>
      <div class="container">
        <div class="row nomargin">
          <div class="span4">
            <div class="logo">
                <a href="<?php echo base_url(); ?>home"><img src="<?php echo base_url(); ?>assets/home/img/together.png" class="logo-top"><span class="logo-text">together we begin</span></a>
            </div>
          </div>
          <div class="span8">
            <div class="navbar navbar-static-top">
              <div class="navigation">
                <nav>
                  <ul class="nav topnav">
                    <li class="active">
                      <a href="<?php echo base_url(); ?>home">Home</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url(); ?>services">Services</a>
                    </li>
                    <li>
                      <a href="<?php echo base_url(); ?>contact">Contact Us</a>
                    </li>
                    <li class="hidden">
                      <a href="<?php echo base_url(); ?>statistics">Statistics</a>
                    </li>
                    <li>
                      <?php 
                      if (is_null($this->session->userdata('user_id'))) { 
                        echo '<a href="'.base_url().'login">Login</a>';
                      } else {
                        echo '<a href="'.base_url().'logout">Logout</a>';
                      }
                      ?>
                    </li>
                  </ul>
                </nav>
              </div>
              <!-- end navigation -->
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- end header -->

    <!-- section intro -->
    <div id="intro">
      <div class="intro-content">
            <br>
            <h2>Contact Us</h2>
            <h4 style="color:white;">Prithvi</h4>
            <h5 style="color:white;">Mobile: +91 82813 74736</h5>
            <h4 style="color:white;">Alwin </h4>
            <h5 style="color:white;">Mobile: +91 75618 50699</h5>
            <h4 style="color:white;">Irshad </h4>
            <h5 style="color:white;">Mobile: +91 85898 09616</h5>
            <h4 style="color:white;">E-mail: togetherwebeginkerala@gmail.com</h4>
      </div>
    </div>
    <!-- /section intro -->

  </div>

  <!-- javascript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url(); ?>assets/home/js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>assets/home/js/jquery.easing.1.3.js"></script>
  <script src="<?php echo base_url(); ?>assets/home/js/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/home/js/modernizr.custom.js"></script>
  <script src="<?php echo base_url(); ?>assets/home/js/toucheffects.js"></script>
  <script src="<?php echo base_url(); ?>assets/home/js/google-code-prettify/prettify.js"></script>
  <script src="<?php echo base_url(); ?>assets/home/js/jquery.prettyPhoto.js"></script>
  <script src="<?php echo base_url(); ?>assets/home/js/portfolio/jquery.quicksand.js"></script>
  <script src="<?php echo base_url(); ?>assets/home/js/portfolio/setting.js"></script>
  <script src="<?php echo base_url(); ?>assets/home/js/animate.js"></script>

  <!-- Template Custom JavaScript File -->
  <!-- <script src="js/custom.js"></script> -->

</body>

</html>