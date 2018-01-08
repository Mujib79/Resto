<?php $__env->startSection('child'); ?>
  <ul class="list-button">
    <li class="firstmenu active"><a class="dashboard animasi" href="#">Dashboard</a></li>
    <li class="firstmenu"><a class="kitchen animasi" href="dapur">Mode Dapur</a></li>
    <li class="firstmenu" onclick="set_interface('ALL')"><a class="dish animasi" href="#">Olah Hidangan</a></li>
  </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <table id="dashboard">
    <tr>
      <td class="animasi" onclick="set_interface('ALL')"><a class="allfood" href="#">Tampilkan Semua Hidangan</a></td>
      <td class="animasi" onclick="set_interface('APP')"><a class="app" href="#">Tampilkan Hidangan Pembuka</a></td>
      <td class="animasi" onclick="set_interface('MAC')"><a class="mac" href="#">Tampilkan Hidangan Utama</a></td>
      <td class="animasi" onclick="set_interface('DES')"><a class="des" href="#">Tampilkan Hidangan Penutup</a></td>
    </tr>
    <tr>
      <td class="animasi" onclick="set_interface('SOF')"><a class="sof" href="#">Tampilkan Data Minuman</a></td>
      <td class="animasi" onclick="set_interface('available')"><a class="available" href="#">Hidangan Tersedia</a></td>
      <td class="animasi" onclick="set_interface('notavailable')"><a class="notavailable" href="#">Hidangan Tidak Tersedia</a></td>
      <td class="animasi" onclick="set_interface('shing')"><a class="basket" href="#">Tampilkan Data Bahan Baku</a></td>
    </tr>
    <tr>
      <td class="animasi" onclick="add_new(0)"><a class="new" href="#">Tambah Data Hidangan Baru</a></td>
      <td class="animasi" onclick="add_new(1)"><a class="new" href="#">Tambah Data Bahan Baku Baru</a></td>
      <td class="animasi" onclick="sort_data('ALL')"><a class="trash" href="#">Sampah Hidangan</a></td>
      <td class="animasi" onclick="sort_data('ALL')"><a class="trash" href="#">Sampah Bahan Baku</a></td>
    </tr>
  </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.parent-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>