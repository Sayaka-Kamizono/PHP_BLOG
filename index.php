<?php

require_once('input.php');

// 取得したデータを表示
// index.phpから移動してきた
$blogData = getAllBlog();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>一覧表示</title>
  
<style>

html {
  background: darkgray;
}  

body {
  width: 800px;
  margin: auto;
  background-image: url(SAVEANIMAL.png);
}

a {
  text-decoration:none;
}

a.newtext {
  margin-top: 500px;
  height: fit-content;
}

.newtext {
  margin-left: 700px;
  font-weight: bold;
  background: skyblue;
  color:white;
  padding:5px 10px;
  border-radius: 20px;
  font-family: 'Avenir','Arial';
}

.newtext:hover {
  background: silver;
  text-decoration: none;
}

.newtext:visited {
  color: gray;
}



table{
  margin-top: 100px;
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}

table tr{
  border-bottom: solid 1px #eee;
  cursor: pointer;
}

table tr:hover{
  background-color: whitesmoke;
}

table th,table td{
  text-align: center;
  width: 25%;
  padding: 15px 0;
}

.earth {
  position: relative;
  overflow: hidden;
  width: 200px;
  height: 200px;
  background-color: #ccc;
  border-radius: 50%;
  box-shadow: -20px 0 3px rgba(0, 0, 0, 0.3) inset;
}

.earth:before {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-repeat: repeat-x;
  background-image: url(https://drive.google.com/uc?export=view&id=11chGBx0vAj79X4ph_fUXDQIYdRy9uqBV);
  background-position: 0 0;
  background-size: auto 100%;
  transform: rotate(23.4deg);
  animation: rotation 16s linear infinite;
}

@keyframes rotation {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: -200% 0;
  }
}
  </style>
</head>

<body>

<div class="earth"></div>  

  <!-- <h1>投稿一覧表示</h1> -->
  <a class="newtext" href ="form.html">記事作成</a>

  <table>
      <tr>
      <th>No</th>
      <th>タイトル</th>
      <th>カテゴリー</th>
    </tr>
    

<!-- ↑で定義した変数$blogDataの中身をカラムにして回す(foreach) -->
<?php foreach ($blogData as $column): ?>

    <tr>
      <td><?php echo $column['id'] ?></td>
      <td><?php echo $column['title'] ?></td>
      <!-- categoryに数字が入った時↑の関数（setCategoryName）を実行 -->
      <td><?php echo setCategoryName($column['category']) ?></td>
      <td><a href ="create.php?id=<?php echo $column['id'] ?>">詳細</a></td>
    </tr>

<?php endforeach; ?>

  </table>




  
</body>
</html>


