<?php

header('Content-Type: application/json;charset=utf-8');

header('Access-Control-Allow-Origin: *');
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use juno_okyo\Chatfuel;
$chatfuel=new Chatfuel(TRUE);
include "simple_html_dom.php";
// lấy token qua html
function getStr($string,$start,$end){
 $str = explode($start,$string,2);
 $str = explode($end,$str[1],2);
 return $str[0];
}
// đăng nhập
function _curl($url,$post="",$usecookie = false,$_sock = false,$timeout = TRUE,$ref = false,$header = false) {  
  $ch = curl_init();
  if($post) {
  curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);;
  }
  if($header){
  curl_setopt($ch,CURLOPT_HTTPHEADER,$header); 
  }
  if($_sock){
  curl_setopt($ch, CURLOPT_PROXY, $_sock);
  curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
  }
  if($timeout){
  curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  }
  if($ref){
  curl_setopt($ch,CURLOPT_REFERER,$ref); 
  }
  curl_setopt($ch, CURLOPT_URL, $url); 
  curl_setopt($ch, CURLOPT_COOKIE, $usecookie);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE); 
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.79 Safari/537.36"); 
  if ($usecookie) { 
  curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie); 
  curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);    
  }
  curl_setopt($ch, CURLOPT_HEADER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
  $result=curl_exec ($ch); 
  curl_close ($ch); 
  return $result; 
 }
$cookie = tempnam('cookie','ccv'.rand(1000000,9999999).'cookie.txt');
 $url = "https://ums-husc.hueuni.edu.vn/Student/Account/Login";
 $result = _curl($url,'',$cookie,'','','','');
$loginID = '16T1021041';
 $pass = 'duongtrunghieu';
 $token = getStr($result,'name="__RequestVerificationToken" type="hidden" value="','"');
 $url2 = "https://ums-husc.hueuni.edu.vn/Student/Account/Login";
 $post = "__RequestVerificationToken=$token&loginID=$loginID&password=$pass";
 $result2 = _curl($url2,$post,$cookie,'',1000,'','');
 $url3 = "https://ums-husc.hueuni.edu.vn/Student/TimeTable/Week";
 $result3 = _curl($url3,'',$cookie,'',1000,'','');
 $html = str_get_html($result3);



$theData = array();
foreach($html->find('tr') as $row) {

    
    $rowData = array();
    foreach($row->find('td') as $cell) {
        $rowData[] = $cell->innertext;
    }
    $theData[] = ($rowData);
}


function kiemtra($string)
{
  $i=preg_replace('/\s+/', '', strip_tags($string));
  if(empty($i)==TRUE)
    {return $string="Nghỉ";}
  else return strip_tags($string);
}
function chuanhoa($value)
{
  return preg_replace('/\s+/', '', strip_tags($value));
}

$t2=chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][0])." ".chuanhoa($theData[3][0])." : ".kiemtra($theData[4][0])."  ".chuanhoa($theData[5][0])." : ".kiemtra($theData[6][0]);
$t3=chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][1])." ".chuanhoa($theData[3][0])." : ".kiemtra($theData[4][1])." ".chuanhoa($theData[5][0])." : ".kiemtra($theData[6][1]);
$t4=chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][2])." ".chuanhoa($theData[3][0])." : ".kiemtra($theData[4][2])." ".chuanhoa($theData[5][0])." : ".kiemtra($theData[6][2]);
$t5=chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][3])." ".chuanhoa($theData[3][0])." : ".kiemtra($theData[4][3])." ".chuanhoa($theData[5][0])." : ".kiemtra($theData[6][3]);
$t6=chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][4])." ".chuanhoa($theData[3][0])." : ".kiemtra($theData[4][4])." ".chuanhoa($theData[5][0])." : ".kiemtra($theData[6][4]);
$t7=chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][5])." ".chuanhoa($theData[3][0])." : ".kiemtra($theData[4][5])." ".chuanhoa($theData[5][0])." : ".kiemtra($theData[6][5]);
// Buổi sáng

if (isset($_GET['type'])&& !empty($_GET['type'])) {
  $type=($_GET['type']);
  $s="địt đéo đúng";
       
  switch ($type) {
    case 2:
      
      $chatfuel->sendText(array(chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][0]), chuanhoa($theData[3][0])." : ".kiemtra($theData[4][0]) ,chuanhoa($theData[5][0])." : ".kiemtra($theData[6][0])  ));
      break;
    case 3:
      $chatfuel->sendText(array(chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][1]), chuanhoa($theData[3][0])." : ".kiemtra($theData[4][1]),chuanhoa($theData[5][0])." : ".kiemtra($theData[6][1])));
      break;
    case 4:
      $chatfuel->sendText(array(chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][2]),chuanhoa($theData[3][0])." : ".kiemtra($theData[4][2]),chuanhoa($theData[5][0])." : ".kiemtra($theData[6][2])));
      break;
    case 5:
      $chatfuel->sendText(array(chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][3]),chuanhoa($theData[3][0])." : ".kiemtra($theData[4][3]),chuanhoa($theData[5][0])." : ".kiemtra($theData[6][3])));
      break;
    case 6:
      $chatfuel->sendText(array(chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][4]),chuanhoa($theData[3][0])." : ".kiemtra($theData[4][4]),chuanhoa($theData[5][0])." : ".kiemtra($theData[6][4])));
      break;
    case 7:
      $chatfuel->sendText(array(chuanhoa(" ".$theData[1][0])." : ".kiemtra($theData[2][5]),chuanhoa($theData[3][0])." : ".kiemtra($theData[4][4]),chuanhoa($theData[5][0])." : ".kiemtra($theData[6][5])));
      break;
    
    default:
      $chatfuel->sendText($s);
      break;
  }
}
?>
