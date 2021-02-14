<?php
    //4-1
	$dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));//=>:ダブルアロー演算子
	//array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);エラーが起きた場合のエラー表示
	
	//4-2
	$sql = "CREATE TABLE IF NOT EXISTS tbtest"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT"
	.");";
	$stmt = $pdo->query($sql);//->:アロー演算子
	
	
	//4-3
	$sql ='SHOW TABLES';
	$result = $pdo -> query($sql);
	
	//4-4
	$sql ='SHOW CREATE TABLE tbtest';
	$result = $pdo -> query($sql);
	
	//4-5(投稿)
	$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)"); 
	if(!(empty($_POST["YourName"]) && empty($_POST["comment"]))){
	    if($_POST["password"] == $password){
	        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
	        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	    }
	}
	$name = $_POST["YourName"];
	$comment = $_POST["comment"]; //好きな名前、好きな言葉は自分で決めること
	$sql -> execute();
	
	//4-8(削除)
	$id = $_POST["DeleteNumber"];
	if(!empty($id)){
	    $sql = 'delete from tbtest where id=:id';
	    $stmt = $pdo->prepare($sql);
	    if(!empty($_POST["DeleteNumber"])){
	        if($_POST["DeletePassword"] == $password){
	            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	            $stmt->execute();
	        }
	    }
	}
	
	//4-7(編集)
	$id = $_POST["UpdateNumber"]; //変更する投稿番号
	$name = $_POST["YourName"];
	$comment = $_POST["comment"]; //変更したい名前、変更したいコメントは自分で決めること
	$sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
	$stmt = $pdo->prepare($sql);
	if(!empty($_POST["UpdateNumber"])){
	    if($_POST["UpdatePassword"] == $password){
	        if(!(empty($_POST["YourName"]) && empty($_POST["comment"]))){
	            echo $id;
	            echo $_POST["YourName"];
	            echo $_POST["comment"];
	            $stmt->bindParam(':name', $_POST["YourName"], PDO::PARAM_STR);
	            $stmt->bindParam(':comment', $_POST["comment"], PDO::PARAM_STR);
	            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	            $stmt->execute();
	        }
	    }
	}
	
	/*
	$sql = 'SELECT * FROM tbtest WHERE id='.$id;
	$stmt = $pdo->prepare($sql);
	$results = $stmt->fetchAll();
	var_dump($results);
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		$update_name = $row['name'];
		$update_comment = $row['comment'];
	}
	*/
	
	$sql = 'SELECT * FROM tbtest WHERE id = :id';
	$stmt = $pdo->prepare($sql);
    //$stmt = $pdo->prepare("SELECT * FROM tbtest WHERE id = :id");
    //$stmt -> bindParam(':name', $update_name, PDO::PARAM_STR);
    $stmt->bindParam(':name', $update_name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $update_comment, PDO::PARAM_STR);
	$stmt->execute();
	echo $update_name."です<br>";
	echo $update_comment."です<br>";
	
	$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
	    if ($row['id'] == $_POST["UpdateNumber"]){
		    $update_name = $row['name'];
		    $update_comment = $row['comment'];
		    echo $update_name."です<br>";
		    echo $update_comment."です<br>";
		    echo $row['id'].',';
		    echo $row['name'].',';
		    echo $row['comment'].'<br>';
	    }
	}
?>
        
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1.php</title>
</head>
<body>
    <!--フォーム；最初に出てくる静的ページ-->
    <form action="" method="post">
    <input type="text" name="YourName" placeholder="名前" value="<?php echo $update_name?>"><br>
    <input type="text" name="comment" placeholder="コメント" value="<?php echo $update_comment?>"><br>
    <input type="text" name="password" placeholder="パスワード">
    <input type="hidden" name="number" value="<?php echo $update_number?>" >
    <input type="submit" name="submit"><br><br>
    
    <input type="text" name="DeleteNumber" placeholder="削除番号"><br>
    <input type="text" name="DeletePassword" placeholder="パスワード">
    <input type="submit" name="delete" value="削除"><br><br>
    
    <input type="text" name="UpdateNumber" placeholder="編集番号"><br>
    <input type="text" name="UpdatePassword" placeholder="パスワード">
    <input type="submit" name="update" value="編集">
    </form>
</body>
</html>
    <?php
	
	//4-6(表示)
	$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
	
	/*
	//4-9
	$sql = 'DROP TABLE tbtest';
	$stmt = $pdo->query($sql);
	*/
        
    ?>