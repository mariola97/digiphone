<?php
	session_start();
	
	
   $DB_SERVER='localhost';
   $DB_USERNAME='root';
   $DB_PASSWORD='';
   $DB_DATABASE='web_trgovina';
   
  
   $db = mysqli_connect($DB_SERVER,$DB_USERNAME,$DB_PASSWORD,$DB_DATABASE);

   if($db==false)
    {
        die("Greska kod spajanja!");
    }
	
	
	   $kor_ime = $_POST['username'];
      $password = $_POST['lozinka']; 
      
      $sql = "SELECT id, lozinka FROM users WHERE username = '$kor_ime'";
	  
      $result = mysqli_query($db,$sql);
      
      $count = mysqli_num_rows($result);
      
		
      if($count == 1) {
         if ($row = mysqli_fetch_assoc($result)) {
            $hash = $row["lozinka"];
            $verify = password_verify($password, $hash);
         
         if ($verify) {
            $_SESSION["username"]=$kor_ime;
            header('location:index.php');
         }}
      }
      else{
         $error="Pogrešno korisničko ime ili lozinka, pokušaj ponovo<br>";
         echo $error;
         echo "Niste registrirani? <a href='register.html'>Klikni za registraciju</a>";
    }
      
	

?>