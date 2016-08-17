<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="World in 360: Been Here - Done That - Captured That">
  <meta name="author" content="Riddhiman Adib">

  <meta property="og:title" content="World in 360 : Riddhiman Adib">
  <!--meta property="og:image" content="http://example.com/images/photo.jpg"-->
  <meta property="og:description" content="World in 360: Been Here - Done That - Captured That">
  <meta property="og:url" content="https://world-in-360.herokuapp.com/">

  <title>World in 360</title>

  <!-- Loading Bootstrap -->
  <link href="<?= base_url() ?>assets/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- START -->
  <!-- SHARE Styles -->
  <link rel="stylesheet" href="https://cdn.shr.one/0.1.9/shr.css">
  <!-- Docs styles -->
  <link rel="stylesheet" href="https://cdn.shr.one/0.1.9/docs.css">
  <!-- END -->

  <!-- Loading Flat UI -->
  <link href="<?= base_url() ?>assets/css/flat-ui.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="<?= base_url()?>assets/css/riddhi-custom.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">

  <link rel="shortcut icon" href="img/favicon.ico">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
<script src="js/vendor/html5shiv.js"></script>
<script src="js/vendor/respond.min.js"></script>
<![endif]-->
</head>

<body>
  <div class="centre-aligned-text">
    <h1>World in 360</h1>
    <h6>Been Here - Done That - Captured That</h6>
    <p class="desc">I have always had that knack for some clicks, not of us, not of people around us, but where I was, where we were. The time, that very moment in which we were, we existed, we lived. Here's a collection of that very special moments.</p>
  </div>
  <!-- /.container -->




  <!-- Sharing Links -->
  <main role="main" id="main">
    <div class="examples">      
      <a href="https://www.facebook.com/sharer/sharer.php?u=https://world-in-360.herokuapp.com/" target="_blank" class="button button-facebook" data-shr-network="facebook">
          <svg><use xlink:href="#shr-facebook"></use></svg>Share
      </a>

      <a href="https://twitter.com/intent/tweet?text=https://world-in-360.herokuapp.com/.&amp;url=http%3a%2f%2flocalhost%2fworld_in_360%2f&amp;via=sam_potts" target="_blank" class="button button-twitter" data-shr-network="twitter">
        <svg><use xlink:href="#shr-twitter"></use></svg>Tweet
      </a>

      <a href="https://plus.google.com/share?url=https://world-in-360.herokuapp.com/" target="_blank" class="button button-google" data-shr-network="google">
        <svg><use xlink:href="#shr-google"></use></svg>     +1
      </a>
    </div>
  </main>





  <div class="container">
    <div class="row">

      <?php 
        for ($x = 0; $x < count($data); $x++) { 
      ?>
            <div class="col-md-3 col-sm-4 col-xs-6">
              <a href="index.php/panorama/<?= $x ?>" target="_blank">
                <span style=""><?= $data[$x]['title'] ?></span>
                <img class="img-responsive" src="assets/img/panorama/thumb/<?= $data[$x]['name'] ?>.jpg" />
              </a>
            </div>
      <?
        } 
      ?> 

    </div>
  </div>



  <div class="footer-bottom" id="custom_footer">
        <div class="container">
            <div style="font-size: 14px; text-align: justify;"><i>These image are not taken professionally, rather taken with amateur hands. Only tool used was a Google Nexus 5X. All the images are property of Riddhiman Adib, and they should not be used in any kind of work, personal or commercial, without consent.</i></div>

            <br>

            <p class="pull-right"> Copyright © <a href='https://riddhimanadib.wordpress.com/about/' target='_blank'>Riddhiman Adib</a> 2016. All right reserved. </p>
        </div>
  </div>



  <script>
    (function(d, u){
      var x = new XMLHttpRequest(),
      b = d.body;

            // Check for CORS support
            // If you're loading from same domain, you can remove the if statement
            // XHR for Chrome/Firefox/Opera/Safari
            if ("withCredentials" in x) {
              x.open("GET", u, true);
            }
            // XDomainRequest for older IE
            else if(typeof XDomainRequest != "undefined") {
              x = new XDomainRequest();
              x.open("GET", u);
            }
            else {
              return;
            }

            x.send();
            x.onload = function(){
              var c = d.createElement("div");
              c.setAttribute("hidden", "");
              c.innerHTML = x.responseText;
              b.insertBefore(c, b.childNodes[0]);
            }
          })(document, "https://cdn.shr.one/0.1.9/sprite.svg");
        </script>

        <!-- Shr core script -->
        <script src="https://cdn.shr.one/0.1.9/shr.js"></script>

        <!-- Docs script -->
        <script src="https://cdn.shr.one/0.1.9/docs.js"></script>



        <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
        <script src="<?= base_url() ?>assets/js/vendor/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?= base_url() ?>assets/js/vendor/video.js"></script>
        <script src="<?= base_url() ?>assets/js/flat-ui.min.js"></script>
      </body>

      </html>
