<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body>
    <form action="" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>


<?php

  //POST送信が行われたら、下記の処理を実行
  var_dump($_POST);
  if(isset($_POST)&&!empty($_POST)){
  //データベースに接続

  //SQL文作成（INSERT文）

  //INSERT文実行
        $dsn='mysql:dbname=online_bbs;host=localhost';
        $user='root';
        $password='';

        $dbh =new PDO($dsn,$user,$password);
        $dbh->query('SET NAMES utf8');

          $nickname=$_POST['nickname'];
          $comment=$_POST['comment'];

          $nickname=htmlspecialchars($nickname);
          $comment=htmlspecialchars($comment);
          // XSS(クロスサイトスクリプティング)でのいたずら防止


          echo $nickname;
          echo '様<br />';
          echo '意見ありがとne！<br />';
          echo '頂いたご意見『';
          echo $comment;
          echo '』<br />';


        $sql ='INSERT INTO `posts`(`nickname`,`comment`,`created`) VALUES("'.$nickname.'","'.$comment.'",now())';
        
        $stmt =$dbh->prepare($sql);
        // この二構文がセットでsql文を実行できる

        $sql ='SELECT * FROM `posts` WHERE 1';

        $stmt =$dbh->prepare($sql);
        var_dump($sql);

        $stmt->execute();

          while (1) 
              {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                // fetch・・・データを一行取り出し、カーソルを次の行に移動する
                //次の行が何もない時はfalseが返され、break(終了)となる
                if($rec==false)
                {
                  break;
                }
                echo $rec['id'];
                echo ' ';
                echo '&nbsp;';
                //上記のどちらかの文を入れることで半角スペースを空けることができる
                echo $rec['nickname'];
                echo $rec['comment'];
                echo $rec['created'];
                echo '<br />';
              }
  }

  //データベースから切断
  $dbh = null;
// var_dump($a);

?>

<!-- <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body> -->
    
</body>
</html>



