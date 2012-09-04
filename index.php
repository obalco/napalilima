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
  $("#staznost").autocomplete("js/autocomplete.php", {
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
      <td class="hlavicka">
        <form class="hladat" action="hladat.php" method="post">
        Hladat <input name="hladat" type="text" id="staznost" size="20" /><input name="search" type="submit" value="Hlada�" />
        </form>
      </td>
    <tr/>
    <tr>
      <td colspan="2" class="popis">
        Vyu�ite mo�nos� ventilova� svoj hnev a pom��te in�m vyhn�� sa probl�mom
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <div class="staznost">
          <?php
            session_start();
            include('errors.php');
            include('functions.php');
      
            echo '<form  method="post">
                    Co/Kto:<br /><textarea cols="100" rows="1" name="staznost_na"></textarea><br/>
                    Ako/Cim:<br /><textarea name="staznost" rows="5" cols="100"></textarea><br/><br/>
                    Nick: <input type="text" name="nick" cols="35"> 
                    Kedy: <input type="text" name="staznost_kedy" cols="35">
                    E-mail: <input type="text" name="email" cols="35"><br/>
                    <p><input type="submit" value="Odosla� s�a�nos�" name="send"></p>
                  </form></div>';
                
            if(isset($_POST['send'] ))
              {
                $staznost_na   = $_POST['staznost_na'];
                $staznost      = $_POST['staznost'];
                $staznost_kedy = $_POST['staznost_kedy'];
                $nick 		   = $_POST['nick'];
                $email 		   = $_POST['email'];
                $ip			   = getIpAddress();
                $message="";

                if(!empty($staznost_na)){$bool_staznost_na = true;}		else {$bool_staznost_na = false; $message .= $error[1];}
                if(!empty($staznost)){$bool_staznost = true;}			else {$bool_staznost = false; $message .= $error[2];}
                if(!empty($staznost_kedy)){$bool_staznost_kedy = true;}	else {$bool_staznost_kedy = false; $message .= $error[3];}
                if(!empty($nick)){$bool_nick = true;}					else {$bool_nick = false; $message .= $error[4];}
                if(!empty($email)){$bool_email = true;}					else {$bool_email = false; $message .= $error[5];}
            
                if ($bool_staznost_na==true && $bool_staznost==true && $bool_staznost_kedy==true &&  $bool_nick ==true && $bool_email==true)
                  {
                    include('db.php');
                    $sql = "INSERT INTO staznosti (staznost_na, staznost, staznost_kedy, nick, email, datum_staznost , ip  , browser) 
                            VALUES ('$staznost_na','$staznost','$staznost_kedy', '$nick', '$email', NOW(), '$ip', 'browser')";
                    $res = mysql_query($sql);
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
      <td class="popis">
        Pre��ajte si najnov�ie s�a�nosti
      </td>
    </tr>
        <?php
          include('db.php');

          $sql="SELECT * FROM staznosti";
          $res=mysql_query($sql);
          $pocet=mysql_num_rows($res);
          
          $i=0;
          echo '<div id="pole_staznosti">';
      
          while($zaznam = mysql_fetch_assoc($res))
            {
              $nick 		   = $zaznam['nick'];	
              $staznost_na   = $zaznam['staznost_na'];
              $staznost_kedy = $zaznam['staznost_kedy'];
              $staznost 	   = $zaznam['staznost'];
              $email		   = $zaznam['email'];
              $datum         = date("d.m.Y \o H:i",strtotime($zaznam['datum_staznost']));
              $i++;

              echo '<tr><td id="vypis" colspan="2"><div id="hlavicka_staznosti">';
              echo '<b>Nick: </b>'.$nick.' | <b>S�a�nos� na: </b>'.$staznost_na.' | <b>S�a�nos� na: </b>'.$staznost_kedy.' | <b>E-mail: </b>'.$email.' | <b>D�tum odoslania: </b>'.$datum;
              echo '<div id="staznost_a">'.$staznost.'</div>';
              echo'</div></td></tr>';
           }
         echo'</div>';
      ?>
    </td>
  </tr>
</tbody>
</table>
<p align="center" class="pata">Code and Design by <a href="www.am.6f.sk" target="_blank"><img src="images/am_logo.png"  height="15" alt="AM PAGE Andrej Majik Logo"></a>
and <a href="www.obalco.sk" target="_blank"><img src="images/obalco.png" height="15" alt="OBALCO logo"></a></p>
</body>
</html>