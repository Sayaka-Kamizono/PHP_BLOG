<?php 

// require_once:１回しか読み込まない
// input.phpと共通しているdbConnectを使う
require_once('input.php');

// 詳細ページでidを受け取って
// getBlogに引数として反映
$result = getBlog($_GET['id']);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>詳細画面</title>
</head>
<style>

  body {
    background: darkgray;
  }

  .nakami {
    width: 350px;
    height: 400px;
    margin: 200px auto 0 auto;
    text-align: center;
    color: darkgray;
    background: white;
    padding-top: 50px;
    padding-left: 50px;
    padding-right: 50px;
  }

  a {
    text-decoration: none;
  }
  
</style>

<body>
  
 <div class ="nakami">
  <h2>タイトル:<?php echo $result['title'] ?></h2>
  <p>投稿日時:<?php echo $result['created_at'] ?></p>
  <p>カテゴリー:<?php echo setCategoryName($result['category']) ?></p>
  <hr>
  <p><?php echo $result['text'] ?></p>

  <a href ="index.html">一覧へ戻る</a>
</div>
</body>
</html>