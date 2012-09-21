<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" lang="sk">

<html>
<head>
	<title>Vyhladavanie!</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250" >
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="js/jquery.autocomplete.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<script>
 $(document).ready(function(){
  $("#hladat").autocomplete("js/autocomplete.php", {
         selectFirst: false,
		 minLength:	2,
		 minChars: 2,
		 delay: 100
		 });
 });
 </script>
</head>
<body>
<!-- Tabulky ma uz zas bavia -->
<table class="main_table"  align="center">
  <tbody>
    <tr>
      <td class="hlavicka">
        <a href="index.php"><img class="logo" src="images/napalilima_logo.png" alt="Napalili ma Logo" height="70" /></a>
      </td>
      <td align="right">
        <form action="hladat.php" method="post">
          <input name="hladat" type="text" id="hladat" size="20"  />&nbsp;<input name="search" type="submit" value="Hladať" />
        </form>
      </td>
    <tr/>
    <tr>
      <td colspan="2">
        <p id="popis">Využite možnosť ventilovať svoj hnev a pomôžte iným vyhnúť sa problémom</p>
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <div id="nova_staznost">
          <?php
            session_start();
            include('errors.php');
            include('functions.php');
      
            echo '<form  method="post">
                    Kto/Co: <br /><input type="text" name="claim_at" cols="35"> <br/>
                    Ako/Cim:<br /><textarea name="claim" rows="5" cols="100"></textarea><br/><br/>
                    <input type="submit" value="Odoslať sťažnosť" name="send">
                  </form></div>';
                
            if(isset($_POST['send'] ))
              {
				$message="";
                $claim_at   = mysql_real_escape_string(trim($_POST['claim_at']));
                $claim      = mysql_real_escape_string(trim($_POST['claim']));
                $claim_date = date("d.m.Y");
                //$nick 		= mysql_real_escape_string(trim($_POST['nick']));
                //$email 		= mysql_real_escape_string(trim($_POST['email']));
                //$ip			= getIpAddress();
				
				// slovo ln spojene s premennou bude oznacovat dlzku retazca premennej
				// slovo ok budeme spajat s premenou a bude typu boolean
				$ln_claim_at = strlen($claim_at);
				$ln_claim    = strlen($claim);

				if($ln_claim_at > 3 && $ln_claim_at < 50) {$ok_claim_at = true; } else {$ok_claim_at = false; $message.=$error[1];}
				if($ln_claim > 5 && $ln_claim < 200) {$ok_claim = true; } 	 	 else {$ok_claim = false; $message.=$error[2];}
				// blo by fajn keby nick a mail sa dava do session :) teda pri logovaní :)
				
            
                if ($ok_claim_at === true && $ok_claim === true)
                  {
                    include('db.php');
                    $sql  = "INSERT INTO claims (claim_at, claim, claim_date ) 
                             VALUES ('$claim_at','$claim','$claim_date')";
					$res  = mysql_query($sql);
					$id_s = mysql_insert_id(); // funkcia mysql_insert_id dostava poslednu autoinkrementovanu hodnotu primarneho kluca u nas to je id 
					
					$sql  = $vys = ""; // pre istotu vynulovanie premennych
					$vys  = mysql_query($sql);
                    header("Location:index.php");
                  }
                else
                  {
                    echo $message;
                  }
              } 
          ?>
      </td>
    </tr>
    <tr>
      <td>
        <p id="popis">Prečíťajte si najnovšie sťažnosti</p>
      </td>
    </tr>
        <?php
          include('db.php');
                  
          $sql="SELECT * FROM claims order BY id DESC LIMIT 10 ";
          $res=mysql_query($sql);
          $pocet=mysql_num_rows($res);
          
          $i=0;
          echo '<div id="pole_staznosti">';
      
          while($zaznam = mysql_fetch_assoc($res))
            {
              //$nick 	   = $zaznam['nick'];	
              $claim_at    = $zaznam['claim_at'];
             // $claime_date = $zaznam['claime_date']; toto je hlupost z toho pohladu kontorly a podobne kto si bude pamatat daum je to nepodstatne !!!
              $claim	   = $zaznam['claim'];
             // $email	   = $zaznam['email'];
              $claim_date  = $zaznam['claim_date'];
              $i++;

              echo '<tr><td colspan="2" align="center"><div id="hlavicka_staznosti">';
              echo "<b>Nick: </b>'.'NICK'.' | <b>Sťažnosť na: </b>'.$claim_at.' | <b>Sťažnosť kedy: </b>'.$claim_date.' | <b>E-mail: </b>'.'MAIL'.'" ;
              echo '<p id="staznost_a">'.$claim.'</p>';
              echo '<p class="add_comment"><a href="#">Pridať komentár</a></p>';
              
           }
         echo'</div>';
         
          if(isset($_POST['comment'] ))
              {
                $autor  = $_POST['autor'];
                $komentar  = $_POST['komentar'];

             //   if(!empty($autor)){$bool_staznost_na = true;} else {$bool_staznost_na = false; $message .= $error[1];}
             //  if(!empty($komentar)){$bool_staznost = true;} else {$bool_staznost = false; $message .= $error[2];}
                
              //  if ($bool_staznost_na==true && $bool_staznost==true && $bool_staznost_kedy==true &&  $bool_nick ==true && $bool_email==true)
              //    {
                    include('db.php');
                    $sql  = "INSERT INTO comments (id_staznosti, autor, comment, ip) 
                             VALUES ('1','$autor','$komentar', NOW(), '$ip')";
					$res  = mysql_query($sql);
					$id_s = mysql_insert_id(); // funkcia mysql_insert_id dostava poslednu autoinkrementovanu hodnotu primarneho kluca u nas to je id 
					
					$sql  = $vys = ""; // pre istotu vynulovanie premennych
                  
					$vys  = mysql_query($sql);
                    header("Location:index.php");
                //  }
                }
         
         
         $sql="SELECT * FROM claims ";
         $res=mysql_query($sql);
         $pocet=mysql_num_rows($res);
         
         if($pocet>10) 
            {
             echo '<p><a href="vypis.php">Ďalej</a></p>';
            }
		?>
      <p align="center" class="pata">Code and Design by <a href="www.am.6f.sk" target="_blank"><img src="images/am_logo.png"  height="15" alt="AM PAGE Andrej Majik Logo"></a>
      and <a href="www.obalco.sk" target="_blank"><img src="images/obalco.png" height="15" alt="OBALCO logo"></a></p>
    </td>
  </tr>
</tbody>
</table>

</body>
</html>