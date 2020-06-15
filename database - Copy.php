<?php
include('system/ktupad.php');
   class koneksi{
   function connect(){
   try {
   $conn = new PDO("mysql:host=localhost;dbname=iot", "root", "usbw");
   // $conn = new PDO("firebird:host=localhost;dbname=/var/lib/firebird/2.5/data/employee.fdb;charset=UTF8", "sysdba", "masterkey");
   // $conn = new PDO("mssql:host='den1.mssql8.gear.host';dbname='apar', 'apar', 'db@apar'");
   // $conn = new PDO("sybase:host=$host;dbname=$dbname, $user, $pass");
   // $conn = new PDO("sqlite:my/database/path/database.db");
   // $conn = new PDO("odbc:psbodbc");
   // $conn = new PDO("dblib:host=localhost;dbname=psb", "ktupad","db@ktupad");
   }
   catch(PDOException $e) {  echo $e->getMessage(); }
   return $conn;
   }




   public function setconf() {
   $this->conf['tb']='iot';
   $this->conf['mn']='iot';
   }



 public function get(){
     $d=$this->conf;
     $conn=$this->connect();
    //
     $id=$d['id'];
     $val=$d['val'];
    //
     $find_letters = array(" or'"," or ", "=");
     $string = $id.$val;
     if (str_replace($find_letters, '', $string) != $string)
     {
       $out=array(
       'res'=>'relogin');
       echo json_encode($out);
     }
     else{

      $id=$d['id'];
      $val=$d['val'];

    //
     $sql = "SELECT * FROM  $d[tb] Where deviceid='$id'";
     $result = $conn->query($sql);
     $row = $result->fetch();

     if($row){
     echo $val = $row['value'];
     // $out=array('res'=>'profile','sql'=>$id);
    }
     else {
       // $out=array( 'res'=>'relogin','sql'=>$sql);
        echo 'Hi, Nindja';
      }
     // echo json_encode($out);


    }
  }




 }

  // $app = new mod();
  // $app -> init();



?>
