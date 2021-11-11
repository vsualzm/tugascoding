<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

 $conn = new mysqli("localhost", "root", "", "penjualan_vue");
 if($conn->connect_error){
     die("Connection Failed!" .$conn->connect_error);
 }
 $result = array('error' => false);
 $action = '';

 if(isset($_GET['action'])){
     $action = $_GET['action'];
 }

 if($action == 'read'){
     $sql = $conn->query("SELECT * FROM barang");
     $barang = array();
     while($row = $sql->fetch_assoc()){
         array_push($barang, $row);
     }
     $result['barang'] = $barang;
 }
  if($action == 'create'){
      $name = $_POST['name'];
      $stock = $_POST['stock'];
      $jumlahterjual = $_POST['jumlahterjual'];
      $ttransaksi = $_POST['ttransaksi'];
      $jbarang = $_POST['jbarang']; 
     $sql = $conn->query("INSERT INTO barang(name,stock,jumlahterjual,ttransaksi,jbarang)
     VALUES('$name','$stock','$jumlahterjual','$ttransaksi','$jbarang')");

     if($sql){
       $result['message'] = "User added successfully";  
     }else{
         $result['error'] = true;
         $result['message'] = "Failed to add!";
     }
 }
 if($action == 'update'){
      $no = $_POST['no'];
      $name = $_POST['name'];
      $stock = $_POST['stock'];
      $jumlahterjual = $_POST['jumlahterjual'];
      $ttransaksi = $_POST['ttransaksi']; 
      $jbarang = $_POST['jbarang'];
     $sql = $conn->query("UPDATE barang SET name='$name',stock='$stock',jumlahterjual='$jumlahterjual' , ttransaksi='$ttransaksi' ,jbarang='$jbarang'  WHERE no='$no' ");

     if($sql){
       $result['message'] = "User added successfully";  
     }else{
         $result['error'] = true;
         $result['message'] = "Failed to update user!";
     }
 }
  if($action == 'delete'){
      $no = $_POST['no']; 
     $sql = $conn->query("DELETE FROM barang WHERE no='$no'");

     if($sql){
       $result['message'] = "User deleted successfully";  
     }else{
         $result['error'] = true;
         $result['message'] = "Failed to update user!";
     }
 }

 $conn->close();
 echo json_encode($result);
?>