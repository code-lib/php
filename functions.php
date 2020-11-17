<?php

/* ファイルの存在確認 */
function fileCheck($checkPath) {
	if(file_exists($checkPath)){
		return true;
	} else {
		return false;
	}
}
/* ファイルのオープン */
function fileOpen($fileName) {
	$listTxtFile = $fileName;
	$open_file = @fopen($listTxtFile,"r") or die("FILE NOTFOUND");
	flock($open_file,LOCK_EX);
	rewind($open_file);
	flock($open_file,LOCK_UN);
	return $open_file;
}
/* 日付の（曜日入り）の整形（英表記） */
function formatDate($ee) {
	$week = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$wday = strftime('%w', strtotime($ee));
	$dateStr = date("M j, Y", strtotime($ee))." [".$week[$wday]."]";
	return $dateStr;
}
/* 日付の（曜日入り）の整形（日本語表記） */
function formatDateJ($jj) {
	$week = array('日','月','火','水','木','金','土');
	$wday = strftime('%w', strtotime($jj));
	$dateStr = date("Y年n月j日", strtotime($jj))."（".$week[$wday]."）";
	return $dateStr;
}
/* 改行コードの変換 */
function covStr($str) {
	$str = nl2br($str);
	return $str;
}
/* 桁数を指定して０で埋める */
function funcZero($num,$keta) {
	$keta0 = "%0".$keta."d";
	$num = sprintf($keta0, $num);
	return $num;
}
/* 有効期限（年月）の確認 */
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
/* ファイルサイズの取得 */
function sizeCheck($getFile){
 if(isset($getFile)){
  $fsize = filesize($getFile);
  return $fsize;
 } else {
  return false;
 }
}
/* ファイルサイズの取得と補助単位の付与 */
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
/* 画像形式とファイル容量の取得 */
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
/* ファイルの削除 */
function up_file_del($delfile) {
	if(file_exists($delfile)) {
		unlink($delfile);
		global $imageFileName;
		$imageFileName = "";
	}
}
/* 概算での金額換算（JPY -> USD） */
function priceUSD($price,$rate) {
	if(!$rate){ $rate = 105; }
	$usd = $price / $rate;
	$result = round($usd, 2);
	return $result;
}
/* 金額換算（USD -> JPY） */
function priceJPY($price,$rate) {
	if(!$rate){ $rate = 105; }
	if(!$keta){ $keta = -2; }
	$jpy = $price * $rate;
	$result = round($jpy);
	return $result;
}

function priceTAX($price,$tax_rate) {
	if(!$tax_rate){ $tax_rate = 10; } // ％
	$tax = $price * $tax_rate / 100;
	$total = $price + $tax;
	$priceArray = array($total,$tax,$price);
	return $priceArray;
}

?>
