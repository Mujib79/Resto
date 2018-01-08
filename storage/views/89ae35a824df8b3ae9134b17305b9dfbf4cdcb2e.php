<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <title>Resto | <?php echo $__env->yieldContent('title'); ?></title>
  </head>
  <script type="text/javascript" src="<?php echo asset('public/js/jquery.js'); ?>"></script>
  <meta http-equiv="Cache-Control" content="no-store" />
  <link rel="stylesheet" href="<?php echo asset('public/css/public.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('public/css/sweetalert.css'); ?>">
  <script type="text/javascript" src="<?php echo asset('public/js/sweetalert.min.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo asset('public/js/public.js'); ?>"></script>
  <?php $__env->startSection('lib'); ?>
    <?php echo $__env->yieldSection(); ?>
  <body>
    <center><div id="load"></div></center>
    <?php $__env->startSection('popup'); ?>
      <?php echo $__env->yieldSection(); ?>
    <header>
      <aside>
        <label class="judul">My Resto</label>
      </aside>
      <aside>
          <button class="brick logout prosesbtn sign animasi" id="out" onclick="log_out()" name="out" type="button">LOG OUT</button>
      </aside>
    </header>
    
    <div class="wrapcontent">
      <div id="slidesidebar" class="animasi" onclick="showslidesidebar()">
        <div class="rightarrow arrow"></div>
      </div>
      <div id="leftsb_menu" class="animasi">
        <div class="list-akun">
          <table class="log-akun">
            <tr>
              <td rowspan=2 width=30%>
                <img id="fotoicon" src="<?php echo e($_SESSION["icon"]); ?>" width=60px height=60px>
              </td>
              <td>
                  <?php echo e($_SESSION["nip"]); ?>

              </td>
            </tr>
            <tr>
              <td>
                <?php echo e($_SESSION["nama"]); ?>

              </td>
            </tr>
          </table>
        </div>
        <?php $__env->startSection('child'); ?>
        <?php echo $__env->yieldSection(); ?>

      </div>
      
      
      <div id="content">
        <?php $__env->startSection('content'); ?>

          <?php echo $__env->yieldSection(); ?>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    document.getElementById("content").onclick= function(){
      $("#leftsb_menu").removeClass("showsidebar");
      $("#slidesidebar").removeClass("leftslide");
      $("#slidesidebar div").removeClass("rotatearrow");
    }
  </script>
</html>
