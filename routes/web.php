<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "index_controller@index");
Route::get('/tetapkan-nomeja/{nomeja}', "index_controller@set_table_number");
Route::post('/', "index_controller@store");

//Manager
Route::get('/manager', "manager_controller@index");
Route::get('/manager/show-lineChart/{tahun}', "manager_controller@showChart");
Route::get('/manager/show/{id}',"manager_controller@show");
Route::get('/manager/paging/{limit}',"manager_controller@next_shopping_report");
Route::get('/manager/paging-feedback/{limit}',"manager_controller@next_feedback");
Route::get('/manager/detail-report/{noreport}',"manager_controller@detail_report");
Route::get('/manager/edit-pegawai/{nip}',"manager_controller@edit_employee");
Route::get('/manager/sort-by/{month}/{year}',"manager_controller@sort_by");
Route::get("/manager/backup/{sts}/{tahun}/{bulan}","manager_controller@backup");
Route::get("/manager/backup-pengeluaran/{noreport}","manager_controller@backup_pengeluaran");
Route::post('/manager/delete-employee/{nip}',"manager_controller@delete_employee");
Route::post('/manager/add-employee/{rows}',"manager_controller@add_employee");
Route::post('/manager/update-employee/{rows}',"manager_controller@update_employee");
Route::post('/manager/delete-report/{noreport}',"manager_controller@delete_report");
Route::post('/manager/delete-report-permanent/{noreport}',"manager_controller@delete_report_permanent");
Route::post('/manager/restore-report/{noreport}',"manager_controller@restore_report");
Route::post('/manager/delete-row-feedback',"manager_controller@delete_row_feedback");

//pelanggan
Route::get("/pelanggan","pelanggan_controller@index");
Route::get("/pelanggan/get-catatan/{notrans}","pelanggan_controller@get_catatan");
Route::get("/pelanggan/load-keranjang","pelanggan_controller@load_keranjang");
Route::post("/pelanggan/set-order/{no}","pelanggan_controller@set_order");
Route::post("/pelanggan/simpan-jumlah/{notrans}/{val}","pelanggan_controller@save_qty");
Route::post("/pelanggan/simpan-catatan/{notrans}","pelanggan_controller@save_note");
Route::post("/pelanggan/hapus_transaksi/{notrans}/{baris}","pelanggan_controller@delete_transaction");
Route::post("/pelanggan/order-pesanan","pelanggan_controller@order_pesanan");
Route::post("/pelanggan/bayar","pelanggan_controller@bayar_pesanan");
Route::post("/pelanggan/simpan-feedback","pelanggan_controller@simpan_feedback");
Route::post("/pelanggan/logout","pelanggan_controller@logout");

// koki
Route::get('/koki', "koki_controller@index");
Route::get('/koki/show/{id}',"koki_controller@show");
Route::get('/koki/edit/{id}','koki_controller@edit');
Route::get('/koki/data-baru','koki_controller@new_data');
Route::get('/koki/get_bahan_baku','koki_controller@get_bahan_baku');
Route::get('/koki/show-detail-order/{no}','koki_controller@show_detail_order');
Route::get("/koki/show_order",'koki_controller@show_order');
Route::post('/koki/delete-permanently-ingredient/{id}',"koki_controller@permanent_del_ing");
Route::post('/koki/restore/{id}',"koki_controller@restore_food");
Route::post('/koki/restore-ingredient/{id}',"koki_controller@restore_ingredient");
Route::post('/koki/delete/{id}/{kode}',"koki_controller@delete_dish");
Route::post('/koki/delete_ingredient/{id}/{kode}',"koki_controller@delete_ingredient");
Route::post('/koki/delete-permanently/{id}',"koki_controller@permanent");
Route::post('/koki/update/{id}','koki_controller@update');
Route::post('/koki/update-ingredient/{id}/{nama}','koki_controller@update_ingredient');
Route::post('/koki/new-ingredient/{nama}/{temp}','koki_controller@new_data_ingredient');
Route::post('/koki/add_food','koki_controller@add_food');
Route::post('/koki/update-ketersediaan/{sts}/{visibility}','koki_controller@update_ketersediaan');
Route::post('/koki/status_buat/{sts}/{nopesan}/{notrans}','koki_controller@status_buat');

//pantry
Route::get('/pantry', "pantry_controller@index");
Route::get('/pantry/cari-bahan-baku/{val}', "pantry_controller@cari_bahan_baku");
Route::get('/pantry/cari-hidangan-dengan-bahan/{val}/{sts}', "pantry_controller@cari_dengan_bahan_baku");
Route::get("/pantry/edit-ingredient/{no}","pantry_controller@edit_show");
Route::get("/pantry/show/{id}","pantry_controller@show");
Route::get("/pantry/edit-data/{id}","pantry_controller@edit_data_laporan");
Route::post("/pantry/add-new-report/{sts}","pantry_controller@add_new_report");
Route::post("/pantry/save-data/{id}/{no}/{noreg}/{val}","pantry_controller@save_data");
Route::post("/pantry/add-new-row/{no}/{sts}","pantry_controller@tambah_baris_detail");
Route::post("/pantry/delete-row/{no}/{sts}","pantry_controller@hapus_baris_detail");
Route::post("/pantry/delete/{id}/{sts}/{jumrow}","pantry_controller@hapus_laporan_belanja");
Route::post("/pantry/restore-laporan/{id}","pantry_controller@restore_laporan");
Route::post("/pantry/save-budget/{id}/{val}","pantry_controller@update_budget");
Route::post("/pantry/save-detail-laporan/{sts}/{noreport}/{nodetail}/{val}","pantry_controller@update_detail_laporan");
Route::post('/pantry/update-ketersediaan/{sts}/{visibility}','pantry_controller@update_ketersediaan');
Route::post('/pantry/kirim/{no}/{sts}','pantry_controller@send_to_manager');
Route::post("/pantry/save-information/{nodetail}/{noreport}/{ket}","pantry_controller@save_information");

//Olah Akun
Route::get('/olah-akun/show/{id}','olah_akun_controller@show');
Route::get('/olah-akun', "olah_akun_controller@index");
Route::post('/olah-akun/update-data-pegawai', "olah_akun_controller@update_pegawai");
Route::post('/olah-akun/ganti-password', "olah_akun_controller@update_password");

//Kasir
Route::get("/kasir","kasir_controller@index");
Route::get("/kasir/get-daftar-bayar","kasir_controller@get_bayar");
Route::get("/kasir/get-detail-pesan/{no}","kasir_controller@get_detail_pesan");
Route::post("/kasir/simpan-transaksi/{nopesan}","kasir_controller@simpan_transaksi");

//operasi
Route::get('/logout',"operation_controller@logout");
Route::get('/notfound',"operation_controller@notfound");
