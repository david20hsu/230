<?php
include_once 'conn.php';
if (isset($_POST["btnSubmit"])) {
	$errors = array();

	$extension = array("jpeg", "jpg", "png", "gif", "pdf", "doc", "docx", "ppt", "pptx");

	$bytes = 4096;
	$allowedKB = 100;
	$totalBytes = $allowedKB * $bytes;

	if (isset($_FILES["files"]) == false) {
		echo "<b> 請您, 必須點選上傳檔案!!!</b>";
		return;
	}

	//$conn = mysqli_connect("localhost","root","","goal_pp");	
	//mysqli_query($conn,'SET NAMES UTF8');

	foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
		$uploadThisFile = true;

		$file_name = $_FILES["files"]["name"][$key];
		$file_tmp = $_FILES["files"]["tmp_name"][$key];

		$ext = pathinfo($file_name, PATHINFO_EXTENSION);

		if (!in_array(strtolower($ext), $extension)) {
			array_push($errors, "上傳檔案錯誤. 檔名:- " . $file_name);
			$uploadThisFile = false;
		}

		if ($_FILES["files"]["size"][$key] > $totalBytes) {
			array_push($errors, "上傳檔案錯誤 , 必須 小於 400KB. 檔名::- " . $file_name);
			$uploadThisFile = false;
		}

		if (file_exists("Upload/" . $_FILES["files"]["name"][$key])) //Upload ...是目錄參數
		{
			array_push($errors, "上傳檔案,檔名重覆, 檔名:- " . $file_name);
			$uploadThisFile = false;
		}

		if ($uploadThisFile) {
			$filename = basename($file_name, $ext);
			$newFileName = $filename . $ext;
			$create_date = date("Y-m-d H:i:s");
			move_uploaded_file($_FILES["files"]["tmp_name"][$key], "Upload/" . $newFileName);

			$query = "INSERT INTO file_pdf (FilePath, FileName,create_at) VALUES('Upload','" . $newFileName . "','" . $create_date . "')";
			echo $query;
			mysqli_query($conn, $query);
		}
	}

	mysqli_close($conn);

	$count = count($errors);

	if ($count != 0) {
		foreach ($errors as $error) {
			echo $error . "<br/>";
		}
	}
}
