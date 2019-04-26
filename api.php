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
		$sql = "SELECT count(1) as total FROM `short-words`.words";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // 输出数据
		    $row = $result->fetch_assoc();
			$conn->close();
	    	echo json_encode(['error'=>0, 'msg'=>'', 'data'=>$row['total']], true);
	    	exit;
		} else {
			$conn->close();
	    	echo json_encode(['error'=>0, 'msg'=>'', 'data'=>[]]);
	    	exit;
		}
	} else {
		//查缩写词
		$short = $_GET['short']??$_POST['short']??'';
		if (!empty($short)) {
			$short = htmlspecialchars(stripslashes(strip_tags(strtolower(trim($short)))));
			// 创建连接
			$conn = mysqli_connect('localhost', 'root', '12345678');
			 
			// 检测连接
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "SELECT SQL_CACHE * FROM `short-words`.words WHERE `lower`='{$short}' LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			    // 输出数据
			    $row = $result->fetch_assoc();
				$conn->close();
		    	echo json_encode(['error'=>0, 'msg'=>'', 'data'=>['full'=>$row['full'], 'desc'=>$row['desc']]], true);
		    	exit;
			} else {
				$conn->close();
		    	echo json_encode(['error'=>0, 'msg'=>'', 'data'=>[]]);
		    	exit;
			}
		} else {
			echo json_encode(['error'=>1, 'msg'=>'参数错误', 'data'=>[]]);
		    exit;
		}
	}
	
?>
