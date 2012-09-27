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
 
 	$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });

				// Tabs
				$('#tabs').tabs();

				// Dialog
				$('#dialog').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() {
							$(this).dialog("close");
						},
						"Cancel": function() {
							$(this).dialog("close");
						}
					}
				});

				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});

				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});

				// Slider
				$('#slider').slider({
					range: true,
					values: [17, 67]
				});

				// Progressbar
				$("#progressbar").progressbar({
					value: 20
				});

				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
				);

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
            include('db.php');
            include('errors.php');
            include('functions.php');
      
            echo '<form  method="post">
                    Co/Kto:<br /><textarea cols="100" rows="1" name="claim_at"></textarea><br/>
                    Ako/Cim:<br /><textarea name="claim" rows="5" cols="100"></textarea><br/><br/>
                    Nick: <input type="text" name="nick" cols="35"> 
                    Kedy: <input type="text" name="claim_when" cols="35">
                    E-mail: <input type="text" name="email" cols="35"><br/>
                    <p align="center"><input type="submit" id="button" value="Odoslať sťažnosť" name="send"></p>
                  </form></div>';
                
            if(isset($_POST['send'] ))
              {
                $message="";
                $claim_at   = mysql_real_escape_string(trim($_POST['claim_at']));
                $claim      = mysql_real_escape_string(trim($_POST['claim']));
                $claim_when = mysql_real_escape_string(trim($_POST['claim_when']));
                $nick 		   = mysql_real_escape_string(trim($_POST['nick']));
                $email 		   = mysql_real_escape_string(trim($_POST['email']));
                $ip			   = getIpAddress();
          
                $id_u =     1;
				// slovo ln spojene s premennou bude oznacovat dlzku retazca premennej
				// slovo ok budeme spajat s premenou a bude typu boolean
				$ln_claim_at = strlen($claim_at);
				$ln_claim    = strlen($claim);

				if($ln_claim_at >3 && $ln_claim_at < 50) {$ok_claim_at = true; } else {$ok_claim_at = false;$message.=$error[6];}
				if($ln_claim >5 && $ln_claim < 200) {$ok_claim = true; } 		  else {$ok_claim = false; $message.=$error[7];}
			
				// blo by fajn keby nick a mail sa dava do session :) teda pri logovaní :)
				
            
            if ($ok_claim_at === true && $ok_claim === true)
                  {
               
                    $sql  = "INSERT INTO claims (id_u, who, how, date, ip, sys_date) 
                             VALUES ('$id_u','$claim_at','$claim', '$claim_when', '$ip', NOW())";
                    $res  = mysql_query($sql);
                    $id_s = mysql_insert_id(); // funkcia mysql_insert_id dostava poslednu autoinkrementovanu hodnotu primarneho kluca u nas to je id 
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
         
                  
          $sql="SELECT * FROM claims order BY id DESC LIMIT 10 ";
          $res=mysql_query($sql);
          $pocet=mysql_num_rows($res);
          
          $i=0;
          echo '<div id="pole_staznosti">';
      
          while($zaznam = mysql_fetch_assoc($res))
            {
              $user 		 = $zaznam['id_u'];	
              $who   = $zaznam['who'];
              $when = $zaznam['date'];
              $how 	 = $zaznam['how'];
              $sys_date         = date("d.m.Y \o H:i",strtotime($zaznam['sys_date']));
              $i++;

              echo '<tr><td colspan="2" align="center"><div id="hlavicka_staznosti">';
              echo '<b>Nick: </b>'.$user.' | <b>Sťažnosť na: </b>'.$who.' | <b>Sťažnosť kedy: </b>'.$when.' | <b>Dátum odoslania: </b>'.$sys_date;
              echo '<p id="staznost_a">'.$how.'</p>';
              echo'</div>';
           }
         echo'</div>';
         
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