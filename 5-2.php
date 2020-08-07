<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission5-1</title>
    </head>
    <body>
        <h1>mission5-1</h1>
        
        a-lot-ofです。ご協力ありがとうございます。<br>
            ここではコメントの<br>
            ・新規作成<br>
            ・削除<br>
            ・編集<br>
            ができます。<br>
            名前・コメント・パスワードを入れて投稿してください！<br><br><br>
            
            ＊投稿フォーム<br>
            
    <?php
       $dsn='データベース名';
       $user='ユーザー名';
       $password_db='パスワード';
       $pdo= new PDO($dsn,$user,$password_db,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
      
       

       $sql = "CREATE TABLE IF NOT EXISTS tb_5_1"
	   ." ("
  	   . "id INT AUTO_INCREMENT PRIMARY KEY,"
  	   . "name char(32),"
	   . "comment TEXT,"
	   . "password char(32)"
       .");"; 
       
     
       
     
       $text =$_POST["text"];
       $comment =$_POST["comment"];
       $date =date(Y年m月d日　H時i分s秒);
       $NO =$_POST["NO"];
       $edit_number=$_POST["number"];
       $toukou_num=$_POST["toukou_num"];        
       $password=$_POST["password"];
       $password_delete=$_POST["password_delete"];
       $password_edit=$_POST["password_edit"];
    
    
      //投稿フォーム
      if(!empty($text) && !empty($comment) && !empty($password) && $toukou_num==""){
          $sql=$pdo ->prepare("INSERT INTO tb_5_1 (name,comment,password) VALUES (:name,:comment,:password)");
          $sql -> bindParam(':name',$name, PDO::PARAM_STR);
          $sql -> bindParam(':comment',$comment, PDO::PARAM_STR);
          $sql -> bindParam(':password',$password, PDO::PARAM_STR);
          $name=$text;
          $comment =$comment;
          $password=$password;
          $sql -> execute();
      } 
       
       //削除フォーム
       if(!empty($NO) && !empty($password_delete)){                    //削除番号が空ではない場合
          $id=$NO;
          $password=$password_delete;
          $sql='delete from tb_5_1 WHERE id=:id AND password=:password';
          $stmt=$pdo->prepare($sql);
          $stmt -> bindParam(':id',$id,PDO::PARAM_INT);
          $stmt -> bindParam(':password',$password_delete, PDO::PARAM_STR);
          $stmt->execute();
          
       }
       
       ?>
           
        <form method ="POST" action="">
            <input type ="hidden" name="toukou_num" value=
            "<?php 
            $dsn='データベース名';
            $user='ユーザー名';
            $password_db='パスワード';
            $pdo= new PDO($dsn,$user,$password_db,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
             
            if(!empty($edit_number) && !empty($password_edit)){
                $password=$password_edit;
                $sql=$pdo->prepare('SELECT *FROM tb_5_1 where id=:id AND password=:password');
                $sql -> bindValue(':id',$edit_number,PDO::PARAM_INT);
                $sql -> bindValue(':password', $password_edit, PDO::PARAM_STR);
                $sql -> execute();
                $result=$sql -> fetch();
                echo $result[0];
            }
            ?>">
            <input type ="text" name="text" placeholder ="名前" value=
            "<?php 
            $dsn='データベース名';
            $user='ユーザー名';
            $password_db='パスワード';
            $pdo= new PDO($dsn,$user,$password_db,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
             
            if(!empty($edit_number) && !empty($password_edit)){
                $password=$password_edit;
                $sql=$pdo->prepare('SELECT *FROM tb_5_1 where id=:id AND password=:password');
                $sql -> bindValue(':id',$edit_number,PDO::PARAM_INT);
                $sql -> bindValue(':password', $password_edit, PDO::PARAM_STR);
                $sql -> execute();
                $result=$sql -> fetch();
                echo $result[1];
            }
            ?>">
            <input type ="comment" name="comment" placeholder ="コメント" value=
            "<?php
            $dsn='データベース名';
            $user='ユーザー名';
            $password_db='パスワード';
            $pdo= new PDO($dsn,$user,$password_db,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
             
            if(!empty($edit_number) && !empty($password_edit)){
                $password=$password_edit;
                $sql=$pdo->prepare('SELECT *FROM tb_5_1 where id=:id AND password=:password');
                $sql -> bindValue(':id',$edit_number,PDO::PARAM_INT);
                $sql -> bindValue(':password', $password_edit, PDO::PARAM_STR);
                $sql -> execute();
                $result=$sql -> fetch();
                echo $result[2];
            }
            ?>">
            <input type ="text" name="password" placeholder="パスワード">
            <input type ="submit" name="submit"><br><br>
            ＊削除フォーム<br>
        <form method ="POST" action ="">
            <input type = "number" name="NO" placeholder ="削除対象番号">
            <input type = "test" name="password_delete" placeholder ="パスワード">
            <input type = "submit" name="delete" value ="削除"><br><br>
            ＊編集フォーム<br>
        <form method="POST" action="">
            <input type= "number" name="number" placeholder="編集対象番号">
            <input type= "text" name="password_edit" placeholder="パスワード">
            <input type= "submit" name="submit" value="編集">
            <br><br>
            ＊投稿一覧<br>
        </form>
        
       <?php
       $dsn='データベース名';
       $user='ユーザー名';
       $password_db='パスワード';
       $pdo= new PDO($dsn,$user,$password_db,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
       
       //編集後の動き
       if(!empty($toukou_num) && !empty($password)){
         $id=$toukou_num;                              //変更する投稿番号
         $name=$text;
         $comment=$comment;
         $password=$password;
         $sql='UPDATE tb_5_1 SET name=:name,comment=:comment,password=:password WHERE id=:id';  //投稿フォーム内の「名前」「コメント」「パスワード」を編集
         $stmt = $pdo->prepare($sql);
         $stmt->bindParam(':name',$name, PDO::PARAM_STR);
         $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
         $stmt->bindParam(':password',$password,PDO::PARAM_STR);
         $stmt->bindParam(':id',$id ,PDO::PARAM_INT);
         $stmt->execute();  
       }  
       
       $sql='SELECT * FROM tb_5_1';
       $stmt=$pdo ->query($sql);
       $results=$stmt->fetchAll();
       foreach($results as $row){       //$rowのなかにはテーブルのカラム名が入る
          echo $row['id'].',';
          echo $row['name'].',';
          echo $row['comment'].'<br>';
       echo "<hr>";
       }
       
       ?> 
    </body>
</html>