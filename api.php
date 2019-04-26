<?php
	//查总数
	$total = $_GET['total']??0;
	if (!empty($total)) {
		// 创建连接
		$conn = mysqli_connect('localhost', 'root', '12345678');
		// 检测连接
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		$sql = "SELECT SQL_CACHE count(1) as total FROM `short-words`.words WHERE `status`=1";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // 输出数据
		    $row = $result->fetch_assoc();
			$conn->close();
	    	echo json_encode(['error'=>0, 'msg'=>'ok', 'data'=>$row['total']], true);
	    	exit;
		} else {
			$conn->close();
	    	echo json_encode(['error'=>1, 'msg'=>'查询总数出错', 'data'=>[]]);
	    	exit;
		}
	} else {
		$short = $_GET['short']??$_POST['short']??'';
		$full = $_GET['full']??$_POST['full']??'';
		$desc = $_GET['desc']??$_POST['desc']??'';
		$author = $_GET['author']??$_POST['author']??'';

		//添加词条
		if (!empty($short)&&!empty($full)&&!empty($desc)) {
			$short = htmlspecialchars(stripslashes(strip_tags(trim($short))));
			$lower = strtolower($short);
			$full = htmlspecialchars(stripslashes(strip_tags(trim($full))));
			$desc = htmlspecialchars(stripslashes(strip_tags(trim($desc))));
			$author = htmlspecialchars(stripslashes(strip_tags(trim($author))));
			
			// 创建连接
			$conn = mysqli_connect('localhost', 'root', '12345678');
			 
			// 检测连接
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}
			//查询词条是否已存在
			$sql = "SELECT SQL_CACHE * FROM `short-words`.words WHERE `lower`='{$lower}' LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
		    	echo json_encode(['error'=>1, 'msg'=>'词条已存在', 'data'=>[]], true);
		    	exit;
			}

			//插入词条
			$sql = "INSERT INTO `short-words`.words (`short`, `lower`, `full`, `desc`, `author`) VALUES ('{$short}', '{$lower}', '{$full}', '{$desc}', '{$author}')";
			if ($conn->query($sql) === TRUE) {
				$conn->close();
		    	echo json_encode(['error'=>0, 'msg'=>'插入成功，审核通过后即可查询'], true);
		    	exit;
			} else {
				$conn->close();
	    		echo json_encode(['error'=>1, 'msg'=>'插入词条出错', 'data'=>[]]);
		    	exit;
			}
		} elseif (!empty($short)) {
			//查缩写词
			$short = htmlspecialchars(stripslashes(strip_tags(strtolower(trim($short)))));
			// 创建连接
			$conn = mysqli_connect('localhost', 'root', '12345678');
			 
			// 检测连接
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "SELECT SQL_CACHE * FROM `short-words`.words WHERE `lower`='{$short}' AND `status`=1 LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    // 输出数据
			    $row = $result->fetch_assoc();
				$conn->close();
		    	echo json_encode(['error'=>0, 'msg'=>'', 'data'=>['full'=>$row['full'], 'desc'=>$row['desc']]], true);
		    	exit;
			} else {
				$conn->close();
		    	echo json_encode(['error'=>0, 'msg'=>'词条不存在']);
		    	exit;
			}
		} else {
			echo json_encode(['error'=>1, 'msg'=>'参数错误', 'data'=>[]]);
		    exit;
		}
	}
	
?>
