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

?>