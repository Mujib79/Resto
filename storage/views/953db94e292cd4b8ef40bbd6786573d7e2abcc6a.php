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
          <input class="red sign animasi" id="out" onclick="log_out()" name="out" type="button" value="Log out">
      </aside>
    </header>
    
    <div id="leftsb_menu">
      <div class="list-akun">

      </div>
      <ul class="list-button">
        <li><a class="kitchen animasi" href="#">Mode Dapur</a></li>
        <li>
            <a class="dish animasi" href="#">Olah Hidangan</a>
            <ul id="first-child">
              <li><a id="a1" class="plus" href="#" onclick="tampil_child('#second-child1','#a1')">Tampilkan Hidangan</a>
                <ul id="second-child1">
                  <li><a class="all-data" href="#">Semua</a></li>
                  <li><a class="available" href="#">Tersedia</a></li>
                  <li><a class="notavailable" href="#">Tidak Tersedia</a></li>
                </ul>
              </li>
            </ul>
            <ul>
              <li><a id="a2" class="plus" href="#" onclick="tampil_child('#second-child2','#a2')">Olah Data Hidangan</a>
                <ul id="second-child2">
                  <li><a class="new" href="#">Data Baru</a></li>
                  <li><a class="edit" href="fb.com">Edit Data</a></li>
                  <li><a class="trash" href="#">Sampah</a></li>
                </ul>
              </li>
            </ul>
        </li>
      </ul>
    </div>
    
    
    <div id="content">
      <?php $__env->startSection('content'); ?>
    </div>
  </body>
</html>
