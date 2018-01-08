<html>
  <head>
    <meta charset="utf-8">
    <title>Resto</title>
  </head>
  <link rel="stylesheet" href="<?php echo asset('public/css/public.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('public/css/index.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('public/css/sweetalert.css'); ?>">
  <script src="<?php echo asset('public/js/jquery.js'); ?>"></script>
  <script src="<?php echo asset('public/js/public.js'); ?>"></script>
  <script src="<?php echo asset('public/js/index.js'); ?>"></script>
  <script src="<?php echo asset('public/js/sweetalert-div.js'); ?>"></script>
  <script src="<?php echo asset('public/js/sweetalert.min.js'); ?>"></script>
  <body>
    <form action="/Resto/" method="POST">
			<!-- popup -->
      <?php echo e(csrf_field()); ?>

			<div id="popupBox">
				<div id="nomeja" class="wrapper">
					<div class="head">
						<fieldset>
							<div><label>Nomor Meja</label></div>
							<button type="button" class="close animasi" onclick="popup('nomeja',0)">X</button>
						</fieldset>
					</div>
					<div>
						<fieldset>
              <div class="group_set">
								<input class="animasi" type="number" min="0" onkeyup="just_number(this)" id="nomor" name="nomor">
								<button class="green animasi" onclick="tetapkan_nomeja()" type="button" id="tetapkan" name="tetapkan">Tetapkan</button>
              </div>
						</fieldset>
					</div>
				</div>
        <!-- END WRAPPER -->
        <div id="login" class="wrapper">
          <div class="head">
            <fieldset>
              <label>Login</label>
              <button type="button" class="close animasi" onclick="popup('login',0)">X</button>
            </fieldset>
          </div>
          <div>
            <fieldset>
              <div class="group_set">
                <label>NIP</label>
                <input type="text" name="user" id="user">
                <label>Password</label>
                <input type="password" name="pass" id="pass">
              </div>
              <button onclick="login('user','pass','masuk')" class="green animasi" type="button" id="masuk" name="masuk">Masuk</button>
            </fieldset>
          </div>
        </div>
        <div id="login_akun" class="wrapper">
          <div class="head">
            <fieldset>
              <label>Login</label>
              <button type="button" class="close animasi" onclick="popup('login_akun',0)">X</button>
            </fieldset>
          </div>
          <div>
            <fieldset>
              <div class="group_set">
                <label>NIP</label>
                <input type="text" name="username" id="username">
                <label>Password</label>
                <input type="password" name="password" id="password">
              </div>
              <button onclick="login('username','password','masukakun')" class="green animasi" type="button" id="masukakun" value="masukakun" name="masukakun">Masuk</button>
            </fieldset>
          </div>
        </div>
			</div>
      <!-- END POPUPBOX -->
    </form>
			<aside class="utama">
				<aside class="interface">
					<header class="above">
						My Resto
					</header>
					<section class="middle">
						<aside class="panelmenu">
							<span>Pilih Mode</span>
							<aside class="menu">
									<button type="button" id="admin" onclick="popup('login','1')" name="admin" class="animasi">Pegawai</button>
									<button type="button" id="pelanggan" onclick="popup('nomeja','1')" name="pelanggan" class="animasi">Pelanggan</button>
									<button type="button" id="daftar" onclick="popup('login_akun','1')" name="daftar" class="animasi">Olah Akun</button>
							</aside>
						</aside>
					</section>
					<footer class="bottom">
					</footer>
				</aside>
		  </aside>
	</body>
  <?php if(count($error)>0): ?>
    <script type="text/javascript">
      window.onload = function(){
        swal({
          title: "ERROR",
          text: "Username atau password salah",
          type: "error",
          confirmButtonColor: "#2b5dcd",
          confirmButtonText: "OK",
          closeOnConfirm: true
        });
      }
    </script>
  <?php endif; ?>
</html>
