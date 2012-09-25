<?php
function getIpAddress()
{
   $basicIP = getenv("REMOTE_ADDR");
   $realIP = getenv("HTTP_X_FORWARDED_FOR");
   
   if(empty($realIP)) { $realIP = getenv("HTTP_X_FORWARDED"); }
   if(empty($realIP)) { $realIP = getenv("HTTP_FORWARDED_FOR"); }
   if(empty($realIP)) { $realIP = getenv("HTTP_FORWARDED"); }
   
   $proxyFlag = empty($realIP) ? 0 : 1;
   
   if(!$proxyFlag) {
      $realIP = getenv("HTTP_VIA");
      if(empty($realIP)) { $realIP = getenv("HTTP_X_COMING_FROM"); }
      if(empty($realIP)) { $realIP = getenv("HTTP_COMING_FROM"); }
      if(!empty($realIP)) { $proxyFlag = 2; }
   }
   
   if($realIP==$basicIP) { $proxyFlag = 0; }
   
   switch($proxyFlag) {
      case '0':
         $ipadr = $basicIP;
         break;
      case '1':
         $tmp = ereg("^([0-9]{1,3}\.){3,3}[0-9]{1,3}", $realIP, $zhoda);
         if($tmp && (count($zhoda)>0)) {
            $ipadr = $zhoda[0];
         } else {
            $ipadr = $basicIP;
         }
         break;
      case '2':
         $ipadr = $basicIP;
   }
   
   return $ipadr;
}

function cenzuruj($text){

  $PoCenzure="";
  $SpatnaSlova = Array("jebo", "pice", "kokot");
  $RozdelText = explode(" ", $text);
  foreach ($RozdelText as $TestovaneSlovo) {
    foreach ($SpatnaSlova as $SpatneSlovo) {
      if ($TestovaneSlovo==$SpatneSlovo){
		$c="";
			for ($i=0;$i<strlen($TestovaneSlovo);$i++){
			$c.='*';
			}
			$TestovaneSlovo=$c;
	  }
    }
   $PoCenzure=$PoCenzure." ".$TestovaneSlovo;
  }
  echo $PoCenzure;
}

function cenzura($text){
	$str = "";
	$vulgar = Array ("pica", "kokot","kokotisko", "jebo","jeb", "jebak","kurva"); // Sem dopln slova ktore ta napadnu :D
	$oddelovace = Array(","," ",".",PHP_EOL);
	$uprava = "";

		for($i=0; $i<strlen($text);$i++){
			$str .= $text[$i];
			if(in_array($text[$i],$oddelovace)){
				$znak = $text[$i]; 
				$kontr_slovo = substr($str,0,-1);
				$kontr_slovo = strtolower($kontr_slovo);
					if(in_array($kontr_slovo,$vulgar)){
						for($j=0; $j<strlen($kontr_slovo); $j++ ){
							$uprava.='*';	
						}
						$slova[]=$uprava;
						$slova[]=$znak;
						$uprava="";
						$str="";
						$znak="";
					}
					else{
						$slova[]=$str;
						$str="";
					}

			}

		}
	echo $veta = implode("",$slova);
}

function getPageLink($i, $page){
	if($i==$page){
		return " $i";
	}
	return "<a href='" . ( $i !=1 ? "?page=$i" : " . ") . "'> $i </a>";
}

function log_me($nick,$pass){
require_once 'errors.php';

	$mess = "";
	$nick = mysql_real_escape_string(trim($nick));
	$pass = mysql_real_escape_string(trim($pass));

	$ln_nick = strlen($nick);
	$ln_pass = strlen($pass);
	if($ln_nick > 3 && $ln_nick < 20) {$ok_nick=true;} else {$ok_nick=false;}
	if($ln_pass > 3 && $ln_pass < 20) {$ok_pass=true;} else {$ok_pass=false;}
	
	if($ok_nick == true && $ok_pass == true){
		include_once 'db.php';
		
			$sql = "SELECT nick, pass FROM users WHERE nick=md5('$nick') and pass='$pass' ";
			$req = mysql_query($sql);
			$poc = mysql_num_rows($req);
			if($poc == 1){
				$_SESSION['nick']  = $nick;
				$_SESSION['loged'] = 1;
				header("Location: index.php");
			}
			else{
				$mess.="Špatne zadaný nick alebo heslo.";
			}
	}
	else{
		$mess.="nejaky error o dlzke znakov, pri prihlasovani";
	}
	echo $mess;

}

function reg_me($nick,$pass,$email){
require_once 'errors.php';

	$mess="";
	$poc=0;
	$nick = mysql_real_escape_string(trim($nick));
	$pass = mysql_real_escape_string(trim($pass));
	$email = mysql_real_escape_string(trim($email));

	$ln_nick = strlen($nick);
	$ln_pass = strlen($pass);
	$ln_email = strlen($email);
	
	if($ln_nick > 3 && $ln_nick < 20) {$ok_nick=true;} else {$ok_nick=false;}
	if($ln_pass > 3 && $ln_pass < 20) {$ok_pass=true;} else {$ok_pass=false;}
	if($ln_email > 8 && $ln_email < 40) {$ok_email=true;} else {$ok_email=false;}

	if($ok_nick == true && $ok_pass == true && $ok_email == true){
		include_once 'db.php';
		
		$sql = "SELECT nick FROM users WHERE nick = '$nick'";
		$req = mysql_query($sql);
		$poc = mysql_num_rows($req);
		if($poc==0){
			$date = date("d.m.Y");
			$ip   = getIpAddress();
			
			$sql  = $req = "";
				 
			$sql  = "INSERT INTO users(pass , nick , email , date , ip) VALUES ('$pass' , md5('$nick') , '$email' , '$date' , '$ip') ";
			$req  = mysql_query($sql);
		}
		if($poc==1){
			$mess.=$error[6];
		}
	}
	else{
		if($ln_nick < 3 || $ln_nick > 20) { $mess.=$error[3];}
		if($ln_pass < 3 || $ln_pass > 20) { $mess.=$error[4];}
		if($ln_email < 8 || $ln_email > 40) { $mess.=$error[5];}		
	}

	echo $mess;
	
}



?>


