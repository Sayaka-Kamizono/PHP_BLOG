<?php

// ●DB接続の関数
// 引き数：なし
// 返り値：接続結果を返す
function dbConnect(){

// データベースに接続
// dbnはデータベースネーム
// portはPCとネットワーク環境をつなぐ数字で
// MySQLに割り振られた数字が「３３０６」ってだけ
// user初期設定はroot
// password初期設定は空欄
$dbn = 'mysql:dbname=blog_app;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続に失敗したら$eにエラーメッセージを
// 返してねーの処理
// 失敗してたら「db error」が表示される
try {
  $dbh = new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
  };

  return $dbh;
}
  

// データを取得する関数
// 引き数：なし
// 返り値：取得したデータ
function getAllBlog(){
  $dbh = dbConnect();

// ①blogテーブルから(FROM blog)
//   全部( * )
//   とってくる(SELECT)
$sql = 'SELECT * FROM blog';

// ②sql文を($sql)
//   DB接続に成功したPDOオブジェクトに($pdo)
//   問い合わせる(->query)
//   stmtはstatement=陳述、声明
$stmt = $dbh->query($sql);

// ③stmtに($stmt->)
//   全部の値をとってくる(fetchall)
//   引数：カラム名だけ(PDO::FETCH_ASSOC)
$result =
$stmt->fetchall(PDO::FETCH_ASSOC);
return $result;
$dbh = null;
}

// 取得したデータを表示
// index.phpへ移動
// $blogData = getAllBlog();

// カテゴリー名を取得
// 引き数：数字
// 返り値：カテゴリーの文字列
function setCategoryName($category){
  if ($category === '1'){
      return "活動報告";
  } else if ($category === '2'){
      return "寄付状況";
  } else {
      return "その他";
  }
}

// 引き数：$id
// 返り値：$result

function getBlog($id){
  // idが受け取れなかった(empty:空)場合のエラー表示
  if(empty($id)){
  exit('IDが取得できませんでした');
  }

  $dbh = dbConnect();

  // idをもとにblogテーブルから全部持ってくるけど
  // プレースホルダーで後から指定
  $stmt = $dbh->prepare('SELECT * FROM blog Where id = :id');
  $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

  // ↑のSQL実行
  $stmt->execute();

  // 結果を取得
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  // var_dump($result);

  // DBにないブログを選択してしまった場合
  if(!$result){
   exit('ブログがありません');
  }
  return $result;
}

?>

