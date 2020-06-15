<?php
// contoh table di '/db/salam.sql'
// contoh koneksi database di '/database.php'

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class mod extends ktupad {

public function setconf() {
$this->conf['tb']='iot';
$this->conf['mn']='iot';
}

public function post(){
  $d=$this->conf;
  $conn=$this->connect();

  $sql = "SELECT * FROM  $d[tb] WHERE deviceid='$d[idd]'";
  $result = $conn->query($sql);
  $row = $result->fetch();
  if($row){
    $out=array( 'res'=>'IDD sudah terdaftar','sql'=>$sql);
   echo json_encode($out);
   exit();
  }

  $sql = "INSERT INTO $d[tb] SET deviceid='$d[idd]', pin='$d[pin]',value='$d[val]'";
  $result = $conn->query($sql);
  if($result){
  $out=array('res'=>'posr','sql'=>$sql);  }
  else { $out=array( 'res'=>'relogin','sql'=>$sql); }
  echo json_encode($out);
 }

public function get(){
  $d=$this->conf;
  $conn=$this->connect();

  $sql = "SELECT * FROM  $d[tb] WHERE deviceid='$d[idd]' AND pin='$d[pin]'";
  $result = $conn->query($sql);
  $row = $result->fetch();
  if($row){    $out=array('res'=>'get','data'=>$row,'sql'=>$sql);  }
    else { $out=array( 'res'=>'relogin','data'=>$row,'sql'=>$sql); }
    echo json_encode($out);

}

public function put(){
  $d=$this->conf;
  $conn=$this->connect();
  $sql = "UPDATE $d[tb] SET value='$d[val]' Where deviceid='$d[idd]'";
  $result = $conn->query($sql);
  if($result){
  $out=array('res'=>'put','sql'=>$sql);  }
  else { $out=array( 'res'=>'relogin','sql'=>$sql); }
  echo json_encode($out);

}
public function delete(){
  $d=$this->conf;
  $conn=$this->connect();
  $sql = "DELETE FROM $d[tb]  WHERE deviceid='$d[idd]' AND pin='$d[pin]'";
  $result = $conn->query($sql);
  if($result){
  $out=array('res'=>'delete','sql'=>$sql);  }
  else { $out=array( 'res'=>'relogin','sql'=>$sql); }
  echo json_encode($out);
}

public function simpan(){
    $d=$this->conf;
    $conn=$this->connect();

    $find_letters = array(" or'"," or ", "=");
    $string = $d['val'].$d['deviceid'];
    if (str_replace($find_letters, '', $string) != $string)
    {
      $out=array(
      'res'=>'relogin');
      echo json_encode($out);
    }
    else{

    $sql = "UPDATE $d[tb] SET value='$d[val]' Where deviceid='$d[deviceid]'";
    $result = $conn->query($sql);
    if($result){
    $out=array('res'=>'profile','sql'=>$sql);  }
    else { $out=array( 'res'=>'relogin','sql'=>$sql); }
    echo json_encode($out);
   }
 }

}

$app = new mod();
$app->init();


?>
