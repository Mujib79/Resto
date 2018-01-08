<?php
class tes extends PHPUnit_Framework_TestCase
{
	function testEmployees(){
		$konek = mysqli_connect('localhost','root','','resto');
		$sql = mysqli_query($konek,"SELECT * FROM employees WHERE NIP='10107'");
		$user = mysqli_fetch_array($sql);
		$test_user = $user['jabatan'];
		$content = $test_user;
		$this->assertEquals('MANAGER',$content);
	}

	function testTotmeja()
	{
		$konek = mysqli_connect('localhost','root','','resto');
		$sql = mysqli_query($konek,"SELECT COUNT(no_pemesanan) AS jumlah FROM orders WHERE no_meja<=2;");
		$user = mysqli_fetch_array($sql);
		$test_user = $user['jumlah'];
		$content = $test_user;
		$this->assertEquals('5',$content);
		} 

	function testTotBahan()
	{
		$konek = mysqli_connect('localhost','root','','resto');
		$sql = mysqli_query($konek,"SELECT SUM(STATUS)
AS total_bahan FROM ingredients WHERE no_bahan<=50;");
		$user = mysqli_fetch_array($sql);
		$test_user = $user['total_bahan'];
		$content = $test_user;
		$this->assertEquals('47',$content);
		} 


 }
?>


