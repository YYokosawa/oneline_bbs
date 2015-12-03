<?php

  //POST送信が行われたら、下記の処理を実行
  if(isset($_POST)){

  //データベースに接続

  //SQL文作成（INSERT文）

  //INSERT文実行


  $dsn='mysql:dbname=phpkiso;host=localhost';
  $user='root';
  $password='';

  $dbh =new PDO($dsn,$user,$password);
  $dbh->query('SET NAMES utf8');

  $sql ='SELECT * FROM `survey` WHERE 1';

  $stmt =$dbh->prepare($sql);

  $stmt->execute();

 }

  //データベースから切断
  $dbh = null;
// var_dump($a);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body>
    <form action="bbs.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>

    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:20</span></h2>
    <p>つぶやきコメント</p>

    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:10</span></h2>
    <p>つぶやきコメント2</p>
</body>
</html>



