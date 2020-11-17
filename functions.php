<?php

$now = strtotime("now");
/* clearstatcache(); */

/* DATABASE OPEN */

	error_reporting(0);

function fileCheck($checkPath) {
	if(file_exists($checkPath)){
		return true;
	} else {
		return false;
	}
}

function fileOpen($fileName) {
	$listTxtFile = $fileName;
	$open_file = @fopen($listTxtFile,"r") or die("FILE NOTFOUND");
	flock($open_file,LOCK_EX);
	rewind($open_file);
	flock($open_file,LOCK_UN);
	return $open_file;
}

function formatDateE($ee) {
	$week = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$wday = strftime('%w', strtotime($ee));
	$dateStr = date("M j, Y", strtotime($ee))." [".$week[$wday]."]";
		return $dateStr;
}
function formatDateJ($jj) {
	$week = array('日','月','火','水','木','金','土');
	$wday = strftime('%w', strtotime($jj));
	$dateStr = date("Y年n月j日", strtotime($jj))."（".$week[$wday]."）";
		return $dateStr;
}
function covStr($str) {
	$str = nl2br($str);
		return $str;
}
function funcZero($num,$keta) {
	$keta0 = "%0".$keta."d";
	$num = sprintf($keta0, $num);
		return $num;
}
function dateCheck($yy,$mm,$limit) {
	$nowY = date('Y');
	$nowM = date('n');
	$yLimit = $yy;
	$mLimit = $mm + $limit;
	if($mLimit > 12){
		$yLimit++;
		$mLimit -= 12;
	}
	if(($nowY==$yy)&&($nowY == $yLimit)&&($mLimit>=$nowM)){
		return true;
	} else if (($nowY<$yLimit)){
		return true;
	} else if(($nowY == $yLimit)&&($mLimit>=$nowM)){
		return true;
	} else {
		return false;
	}
}
/* ファイルサイズの取得関数 */
function sizeCheck($getFile){
 if(isset($getFile)){
  $fsize = filesize($getFile);
  return $fsize;
 } else {
  return false;
 }
}
/* ファイルサイズの取得と補助単位をつける関数 */
function FileSizeConvert($filePath){
 $bytes = sizeCheck($filePath);
 if($bytes){
  $bytes = floatval($bytes);
  $arBytes = array( 0 => array(
   "UNIT" => "TB","VALUE" => pow(1024, 4)
  ), 1 => array(
   "UNIT" => "GB", "VALUE" => pow(1024, 3)
  ), 2 => array(
   "UNIT" => "MB", "VALUE" => pow(1024, 2)
  ), 3 => array(
   "UNIT" => "KB", "VALUE" => 1024
  ), 4 => array(
   "UNIT" => "B", "VALUE" => 1
  ), );
  foreach($arBytes as $arItem){
   if($bytes >= $arItem["VALUE"]){
    $result = $bytes / $arItem["VALUE"];
    $result = str_replace("", "" , strval(round($result, 1)))." ".$arItem["UNIT"];
    break;
   }
  }
  return $result;
 } else {
  return false;
 }
}
/* /ファイルサイズの取得と補助単位をつける関数 */
//
function get_image_tag($ff,$ww,$hh,$alt,$posi) { 
	if (!file_exists($ff)) {
		return false;
	}
 list($width, $height, $extension, $attr) = getimagesize($ff);
		if($width > $ww){
			return "<a href=\"{$ff}\" title=\"{$alt}\" rel=\"lightbox[ar]\"><img src=\"{$ff}\" width=\"{$ww}\" alt=\"{$alt}\" id=\"{$posi}\" border=\"0\" /></a>";
		} else if($height > $hh){
			return "<a href=\"{$ff}\" title=\"{$alt}\" rel=\"lightbox[ar]\"><img src=\"{$ff}\" height=\"{$hh}\" alt=\"{$alt}\" id=\"{$posi}\" border=\"0\" /></a>";
		} else {
			return "<a href=\"{$ff}\" title=\"{$alt}\" rel=\"lightbox[ar]\"><img src=\"{$ff}\" alt=\"{$alt}\" id=\"{$posi}\" border=\"0\" /></a>";
		}
}
function get_logo_tag($ff,$ww,$hh,$alt,$posi) { 
	if (!file_exists($ff)) {
		return false;
	}
 list($width, $height, $extension, $attr) = getimagesize($ff);
		if($width > $ww){
			return "<img src=\"{$ff}\" width=\"{$ww}\" alt=\"{$alt}\" id=\"{$posi}\" />";
		} else if($height > $hh){
			return "<img src=\"{$ff}\" height=\"{$hh}\" alt=\"{$alt}\" id=\"{$posi}\" />";		
		} else {
			return "<img src=\"{$ff}\" alt=\"{$alt}\" id=\"{$posi}\" />";		
		}
}

function up_file_check($checkfile) {
		global $file_size, $file_width, $file_height, $ex10sion;
		$file_size = filesize($checkfile); // ファイル容量の取得
		$file_type = getimagesize($checkfile); // 画像の３属性情報の取得
		$file_width = $file_type[0]; // 画像幅の取得
		$file_height = $file_type[1]; // 画像高の取得
		if($file_type[2] == 1) { $ex10sion ='gif'; } // 画像の種類（拡張子）を取得
		if($file_type[2] == 2) { $ex10sion ='jpg'; }
		if($file_type[2] == 3) { $ex10sion ='png'; }
		if($file_type[2] == 4) { $ex10sion ='swf'; }
}
function up_file_del($delfile) {
	if(file_exists($delfile)) {
		unlink($delfile);
		global $imageFileName;
		$imageFileName = "";
	}
}

function priceUSD($number) {
	$block = floor($number);
	$block0 = round($number-$block,2);
	$block2 = $block0*100;
	$block1 = number_format($block);
	$price_usd = "<span class=\"largeLL\">".$block1."</span>.".$block2;
	return $price_usd;
}

function priceJPY($number,$keta) {
	if((!$keta)||($keta =="")){ $keta = -2; }
	$pjpy = $number * JPY;
	$price_jpy = number_format(round($pjpy,$keta));
	return $price_jpy;
}

function priceTAX($number,$keta) {
	if((!$keta)||($keta =="")){ $keta = -2; }
	/*$pjpy = $number * TAX;*/
	$pjpy = $number * TAX;
	$price = number_format($pjpy);
	return $price;
}

?>
