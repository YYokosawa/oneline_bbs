<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

  <!-- CSS 一戸参照-->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">

  <link rel="stylesheet" href="assets/css/boot_snipp_css/CommentBox_by_mohsinirshad.css">


</head>
<body>
    <!-- <form action="" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form> -->

<!-- http://bootsnipp.com/snippets/featured/comment-box　参照 -->
<div class="container">
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
              <a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fa fa-bullhorn"></i> 思い立ったらつぶやき</span></a>
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
  <br /><br /><br />
<!--   <div class="row">
    <h3>思い立ったらつぶやき</h3>
  </div>
  タイトルのみの表示の時使用
     -->
          <div class="form-group">
            <div class="input-group">
              <?php // echo '<input type="text" name="nickname" class="form-control" id="validate-text" placeholder="nickname" value="' . $_SESSION["nickname"] . '" required>'  ?>
              
              <?php 
                  if (isset($_SESSION["nickname"])) {
                      echo sprintf('<input type="text" name="nickname" class="form-control"
                       id="validate-text" placeholder="名前はなんてゆ〜の？" value="%s" required>',
                          $_SESSION["nickname"]
                      );
                  } else {
                      echo '<input type="text" name="nickname" class="form-control"
                       id="validate-text" placeholder="名前はなんてゆ〜の？" required>';
                  }
              ?>
            </div>
            
          </div>

    <div class="row">
            <div class="col-md-6">
              <div class="widget-area no-padding blank">
                <div class="status-upload">
                  <form>
                    <textarea type="text" name="comment" placeholder="最近どう?" required></textarea>
                    <ul>
                      <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Audio"><i class="fa fa-music"></i></a></li>
                      <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Video"><i class="fa fa-video-camera"></i></a></li>
                      <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Sound Record"><i class="fa fa-microphone"></i></a></li>
                      <li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture"><i class="fa fa-picture-o"></i></a></li>
                    </ul>
                    <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> つぶやく</button>
                  </form>
                </div><!-- Status Upload  -->
              </div><!-- Widget Area -->
            </div>
        
    </div>
</div>
<!-- http://bootsnipp.com/snippets/featured/comment-box　参照終わり -->

<?php

  //POST送信が行われたら、下記の処理を実行
  var_dump($_POST);
  if(isset($_POST)&&!empty($_POST)){
  //データベースに接続

  //SQL文作成（INSERT文）

  //INSERT文実行
        // $dsn='mysql:dbname=online_bbs;host=localhost';
        // $user='root';
        // $password='';
        //XAMPPデータベースに接続する際の入力

        $dsn='mysql:dbname=LAA0685924-onelinebbs;host=mysql105.phy.lolipop.lan';
        $user='LAA0685924';
        $password='nexseed1204';
        //ロリポップサーバーに接続する際はこのように変更
        //https://mysqladmin.lolipop.jp/pma/index.php?db=LAA0685924-onelinebbs&server=129&token=4e9c1730b46dd28f1f33551cec8990c9#PMAURL:db=LAA0685924-onelinebbs&table=posts&target=sql.php&server=129&token=4e9c1730b46dd28f1f33551cec8990c9

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



  <div class="container">
    <div class="row">
      <div class="col-md-4 content-margin-top">
        <form action="bbs.php" method="post">
          

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

<!-- <!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body> -->
  <div id="f">
    <div class="container">
      <div class="row">
        <p>Crafted with <i class="fa fa-heart"></i> by Y_Yokosawa.co.</p>
      </div>
    </div>
  </div>
    
</body>
</html>



