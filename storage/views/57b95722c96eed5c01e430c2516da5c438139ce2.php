<html>
  <head>
    <meta charset="utf-8">
    <title>Resto | Koki</title>
  </head>
  <link rel="stylesheet" href="/css/public.css">
  <link rel="stylesheet" href="/css/koki.css">
  <link rel="stylesheet" href="/css/sweetalert.css">
  <script type="text/javascript" src="/js/public.js"></script>
  <script type="text/javascript" src="/js/koki.js"></script>
  <script type="text/javascript" src="/js/jquery.js"></script>
  <body>
    <header>
      <aside>
        <label class="judul">My Resto</label>
      </aside>
      <aside>
          <input class="brick sign animasi" id="out" onclick="log_out()" name="out" type="button" value="Log out">
      </aside>
    </header>
    
    <div class="wrapcontent">
      <div id="leftsb_menu">
        <div class="list-akun">
          <table class="log-akun">
            <tr>
              <td rowspan=2 width=30%>
                <img src="/gambar/home.png" width=60px height=60px alt="">
              </td>
              <td>116001</td>
            </tr>
            <tr><td>Hamzah nur al falah</td></tr>
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
</html>
