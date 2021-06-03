<?php

require_once('input.php');
$blogs = $_POST;
// var_dump($blogs);

// 入力せず送信した場合のエラー表示
// emptyは無い場合、の意味
// →タイトルがない場合exit(エラー表示)

if (empty($blogs['title'])){
  exit('タイトルを入力して下さい');
}

// タイトルは767バイト÷４＝191.75で
// 191以下に設定したので
// mb_strlenで長さを取得してエラーを出す
if (mb_strlen($blogs['title']) > 191){
  exit('191文字以下で入力してください');
}

if (empty($blogs['text'])){
  exit('本文を入力して下さい');
}

if (empty($blogs['category'])){
  exit('カテゴリーを選択してください');
}

if (empty($blogs['private_key'])){
  exit('公開状態を設定してください');
}

$sql = 'INSERT INTO
          blog(title, text, category, private_key)
        VALUES
          (:title, :text, :category, :private_key)';

$dbh = dbConnect();
// データの整合性を保つトランザクション
$dbh->beginTransaction();


try {
     $stmt = $dbh->prepare($sql);
     $stmt->bindValue(':title',$blogs['title'],PDO::PARAM_STR);
     $stmt->bindValue(':text',$blogs['text'],PDO::PARAM_STR);
     $stmt->bindValue(':category',$blogs['category'],PDO::PARAM_INT);
     $stmt->bindValue(':private_key',$blogs['private_key'],PDO::PARAM_INT);
     $stmt->execute();

    //  大丈夫だったらコミット
     $dbh->commit();
     echo '投稿を完了しました';

    } catch(PDOException $e){

      // エラーだったらロールバック
      $dbh->rollBack();
      exit($e);
}

?>
<p><a href ="index.php">一覧へ戻る</a></p>