# php code notes

独自関数の定義ファイル「functions.php」を先に読込む。

## ■ファイル情報の取得
### ●ファイルの存在確認
#### fileCheck(ファイルパス)

### ●読込ファイルのオープン
#### fileOpen(ファイルパス)

## ■日付の（曜日入り）の整形
### ●英表記（デフォルト）
#### formatDate(日付)

### ●日本語表記
#### formatDate(日付,"ja")

## ■改行コードの変換
#### covStr(複数行テキスト)

## ■桁数を指定して０で埋める
#### funcZero(番号, 桁数)

## ■有効期限の確認
#### dateCheck(登録年月日, 有効期間)

## ■ファイル情報の取得
### ●ファイルサイズの取得
#### sizeCheck(ファイルパス)

### ●ファイルサイズの取得と補助単位の付与
#### FileSizeConvert(ファイルパス)

### ●画像形式とファイル容量の取得
#### up_file_check(ファイルパス)</h4>

### ●ファイルの削除
#### up_file_del(ファイルパス)

## ■金額換算

### ●JPY -> USD
#### priceUSD(数値,レート)

### ●USD -> JPY
#### priceJPY(数値,レート)

### ●税込計算
#### priceTAX(本体価格,税率％)

## ■ファイルの操作
#### fileOpen(ファイルパス,モード)
ポインターを設定して、操作が終わったらfclose(ポインター)で閉じる。  
### ●CSVファイルの操作
ファイルの内容は「fgetcsv(ポインター)」関数で取り出す。  
追記は「fputcsv(ポインター, Array)」関数で操作。

★<a href="https://demo.s1jp.com/php-func/" target="_blank">サンプル</a>	

&copy; 2020
