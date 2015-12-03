<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">

</head>
<body>
    <form action="" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>

<!-- 一戸コピー参考用 　始まり-->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fa fa-linux"></i> Oneline bbs</span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
<!--                   <li class="hidden">
                      <a href="#page-top"></a>
                  </li>
                  <li class="page-scroll">
                      <a href="#portfolio">Portfolio</a>
                  </li>
                  <li class="page-scroll">
                      <a href="#about">About</a>
                  </li>
                  <li class="page-scroll">
                      <a href="#contact">Contact</a>
                  </li> -->
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-4 content-margin-top">
        <form action="bbs.php" method="post">
          <div class="form-group">
            <div class="input-group">
              <?php // echo '<input type="text" name="nickname" class="form-control" id="validate-text" placeholder="nickname" value="' . $_SESSION["nickname"] . '" required>'  ?>
              
              <?php 
                  if (isset($_SESSION["nickname"])) {
                      echo sprintf('<input type="text" name="nickname" class="form-control"
                       id="validate-text" placeholder="nickname" value="%s" required>',
                          $_SESSION["nickname"]
                      );
                  } else {
                      echo '<input type="text" name="nickname" class="form-control"
                       id="validate-text" placeholder="nickname" required>';
                  }
              ?>

              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
            
          </div>

          <div class="form-group">
            <div class="input-group" data-validate="length" data-length="4">
              <textarea type="text" class="form-control" name="comment" id="validate-length" placeholder="comment" required></textarea>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>

          <button type="submit" class="btn btn-primary col-xs-12" disabled>つぶやく</button>
        </form>
      </div>

      <div class="col-md-8 content-margin-top">
        <?php
            // データの取得と表示
            $sql = 'SELECT * FROM posts ORDER BY `created` DESC';
            $posts = mysqli_query($db,$sql) or die(mysqli_error($db));
        ?>

        <div class="timeline-centered">

        <?php while ($post = mysqli_fetch_assoc($posts)): ?>

        <article class="timeline-entry">

            <div class="timeline-entry-inner">

                <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                    <i class="fa fa-cogs"></i>
                </div>

                <div class="timeline-label">
                    <h2><a href="#"><?php echo $post['nickname'] ?></a> <span><?php echo $post['created'] ?></span></h2>
                    <p><?php echo $post['comment'] ?></p>
                </div>
            </div>

        </article>
        <?php endwhile; ?>

        <article class="timeline-entry begin">

            <div class="timeline-entry-inner">

                <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
                    <i class="entypo-flight"></i> +
                </div>

            </div>

        </article>

      </div>

    </div>
  </div>

  <!-- 一戸コピー参考用 　終わり-->



<?php
    // セッションを使うことを定義
    session_start();

    // セッションへデータの保存
    // $_SESSION["site_title"] = "Online_bbs";


    // if (isset($_SESSION["nickname"])) {
    //     // セッションからデータの取得
    //     echo $_SESSION["nickname"];
    // }

    $db = mysqli_connect('localhost','root','');
    mysqli_select_db($db,'oneline_bbs');
    mysqli_set_charset($db,'utf8');

?>
<!-- ichinohe 1~18 copy -->

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

          echo '<br />';
          echo $nickname;
          echo '様<br />';
          echo '意見ありがとne！<br />';
          echo '頂いたご意見『';
          echo $comment;
          echo '』<br />';
          echo '<br />';
          echo '<br />';


        $sql ='INSERT INTO `posts`(`nickname`,`comment`,`created`) VALUES("'.$nickname.'","'.$comment.'",now())';
        $stmt =$dbh->prepare($sql);
        $stmt->execute();
        // この3構文がセットでsql文を実行できる.sql文１つにつき１セット

        var_dump($sql);
        echo '<br />';
        //phpmyadminでsql文のエラー確認を行う為、入れておくこと

        $sql ='SELECT * FROM `posts` WHERE 1';
        $stmt =$dbh->prepare($sql);
        $stmt->execute();
        var_dump($sql);
        echo '<br />';

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



