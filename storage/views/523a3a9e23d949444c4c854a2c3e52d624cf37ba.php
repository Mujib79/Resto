  <html>
  <head>
    <!-- CSS -->
    <style>
    #preloader {
      position:fixed;
      top:0;
      left:0;
      right:0;
      bottom:0;
      background-color:#ffffff; /* change if the mask should have another color then white */
      z-index:99; /* makes sure it stays on top */
    }

    #loading {
      width:200px;
      height:200px;
      position:absolute;
      left:50%; /* centers the loading animation horizontally one the screen */
      top:50%; /* centers the loading animation vertically one the screen */
      background-image:url("public/gambar/icon/loading19.gif"); /* path to your loading animation */
      background-repeat:no-repeat;
      background-position:center;
      border-radius: 50%;
      margin:-100px 0 0 -100px; /* is width and height divided by two */
    }
    </style>

  </head>
  <body>
      <!-- Loading -->
      <div id="preloader">
        <div style="display:block" id="loading"></div>
      </div>
      <meta http-equiv="refresh" content="1;url=/Resto">

      <!-- jQuery -->
      <script src="javascript/jquery.js"></script>

      <!-- Javascript -->
      <script type="text/javascript">
      $(window).load(function() { // makes sure the whole site is loaded
        $("#status").fadeOut(); // will first fade out the loading animation
        $("#preloader").delay(350).fadeOut("slow"); // will fade out the white DIV that covers the website.
      })
      </script>
  </body>
  </html>
