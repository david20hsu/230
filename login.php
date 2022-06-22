<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="css/style0.css">
</head>

<body>
	<?php
	if (isset($_POST['submit'])) {
		$xcode = $_POST['xcode'];
		$acode = $_POST['acode'];
		if ($acode != $xcode) {
			echo "您輸入驗證碼錯誤!! " . $xcode . " <> " . $acode;
			echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
			exit();
		}
	}
	require 'conn.php';
	session_start();
	// If form submitted, insert values into the database.
	if (isset($_POST['username'])) {
		// removes backslashes
		$username = stripslashes($_REQUEST['username']);
		//escapes special characters in a string
		$username = mysqli_real_escape_string($conn, $username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($conn, $password);
		//Checking is user existing in the database or not
		$query = "SELECT * FROM `sys_uemp` WHERE emp_active='1' and  emp_id='$username' and emp_pd='" . $password . "'";
		#and password='" . md5($password) . "'";
		$result = mysqli_query($conn, $query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
		if ($rows == 1) {
			$_SESSION['username'] = $username;
			// Redirect user to index.php
			header("Location: index.php");
		} else {
			echo "<div class='form'>
<h3>使用者帳號 / 使用者密碼 不正確.</h3>
<br/>請重新點選登入&nbsp&bnsp<a href='login.php'> 登入作業</a></div>";
		}
	} else {
		?>
		<div class="form">
			<h1>使用者登入作業</h1>
			<form action="" method="post" name="login">
				<input type="text" name="username" placeholder="輸入帳號" required />
				<input type="password" name="password" placeholder="輸入密碼" required />
				<br>
				<?php
					$rcode = rand(10000, 99999); //產生亂數5位碼 
					?>
				<label for="xcode" style="color:red;">驗證碼<font color="red"> <?php echo $rcode; ?></font>
					<font color="green">必須輸入</font><label>
						<input type="text" name="xcode" maxlength="5" size="5" value="" ,placeholder="必須正確輸入驗證碼" ,required>
						<br>
						<input type="hidden" name="acode" value="<?php echo $rcode; ?>"> </font>
						<br>
						<input name="submit" type="submit" value="Login" />
			</form>
			<!--
			<p>請問您註冊了嗎? &nbsp&nbsp<a href='registration.php'>在此註冊</a></p>
	-->
		</div>
	<?php } ?>
</body>

</html>