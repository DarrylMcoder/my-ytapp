<?PHP
    
  require('src/crypto.class.php');
  
  $crypto = new Crypto();

  $file_name = $_GET['file'];
  $file = file_get_contents("../".$file_name);
  $crypted = $crypto->encrypt($file);
  $wrapped = $crypto->wrapCode($crypted);
  echo $wrapped;
    
?>
