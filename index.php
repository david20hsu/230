<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Datatables Script</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <style>
        .navbar {
            height: 30px;
        }
    </style>
    <style>
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        li {
            display: inline;
        }

        a.active {
            background: red;
        }
    </style>
</head>

<body>
    <?php
    date_default_timezone_set("Asia/Taipei");
    //echo date_default_timezone_get();
    include('conn.php');
    //$conn = new PDO('mysql:host=localhost; dbname=myweb', 'root', '155300') or die(mysql_error());
    if (isset($_POST['submit']) != "") {
        $extension = array("doc", "docx", "ppt", "pptx", "jpeg", "jpg", "png", "gif", "pdf");
        $name = $_FILES['photo']['name'];
        $size = $_FILES['photo']['size'];
        $type = $_FILES['photo']['type'];
        $temp = $_FILES['photo']['tmp_name'];
        $muser = $_POST['author'];
        $mdate = date('Y-m-d H:i:s');
        $doc_id = $_POST['doc_id'];
        $file_name = $_POST['file_name'];
        $ext = substr($name, strrpos($name, '.') + 1);
        if (!in_array(strtolower($ext), $extension)) {
            $_SESSION['error'] = '檔案格式不符合:' . $ext;
        } else {
            $xfile = $doc_id . date('Ymd') . date('H') . date('i') . date('s') . '.' . $ext;
            //move_uploaded_file($temp, "upload/" . $name);
            move_uploaded_file($temp, "upload/" . $xfile);
            $query = $conn->query("INSERT INTO doc_file (file_id,file_name,doc_id,muser,mdate) VALUES ('$xfile','$file_name','$doc_id','$muser','$mdate')");
            if ($query) {
                header("location:doc.php");
            } else {
                die(mysqli_error($query));
            }
        }
    }
    ?>

    <nav class="navbar navbar-expand-sm bg-info navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">文件檔</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../cal/index.php">行事曆</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">登出</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
    </nav>
    <div class="row">
        <?php
        if (isset($_SESSION['error'])) {
            echo
                "
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						" . $_SESSION['error'] . "
					</div>
					";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo
                "
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						" . $_SESSION['success'] . "
					</div>
					";
            unset($_SESSION['success']);
        }
        ?>
    </div>
    <div class="card bg-secondary text-white" style="width: 100%;">
        <form enctype="multipart/form-data" action="" method="post">
            <table style="width:840px;">
                <tr>
                    <td style="width:18%;">文件名稱</td>
                    <td>
                        <input type="text" name="file_name" od="file_name" classs="form-control" required placeholder="文件名稱">
                    </td>
                    <td style="width:20%;">文件類別:</td>
                    <td>
                        <select name="doc_id" id=" doc_id" classs="form-control" required style="width:250px;">
                            <?php
                            include_once("conn.php");

                            $sql = "select doc_id,doc_name from doc_type order by doc_id";

                            $result = mysqli_query($conn, $sql);

                            ?>

                            <?php while ($row = mysqli_fetch_assoc($result)) :; ?>

                                <h4>
                                    <option value="<?php echo $row['doc_id']; ?>"><?php echo $row['doc_name']; ?></option>
                                </h4>

                            <?php endwhile; ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width:18%;">文件編審</td>
                    <td>
                        <input type="text" name="author" id="author" placeholder="文件編審" required value=<?php echo $_SESSION['username']; ?>>
                    </td>
                    <td style="width:20%;">
                        上傳檔案
                    </td>
                    <td>
                        <input type="file" name="photo" id="photo" class="form-control-file" style="width:400px;height:30px;border:2px blue none;" required>
                    </td>
                </tr>
                <tr>
                    <td style="width:18%;">
                        <input type="submit" name="submit" style="height:30px;border:2px blue none;background-color:pink;" value="送出表單">
                    </td>
                    <td>
                    <td style="width:20%;">
                        <font color="Yellow">檔案格式</font>
                    </td>
                    <td>

                        <font color="white">pdf,doc,docx,ppt,pptx,jpeg,jpg,png,gif
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <hr>
    <div class="container-fluid">
        <!--
        <table id="example" class="table table-striped table-bordered" style="width:100%">
-->
        <div class="col-sm-12 col-sm-offset-0">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-condensed" id="example">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>文件編號</th>
                        <th>文件名稱</th>
                        <th>文件類別</th>
                        <th>維護人</th>
                        <th>上傳日期</th>
                        <th>檢視</th>
                        <th>下載</th>
                        <th>刪除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT *,b.doc_name FROM doc_file a left join doc_type b on a.doc_id=b.doc_id ";

                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {

                        $id = $row['id'];
                        $file_id = $row['file_id'];
                        $file_name = $row['file_name'];
                        $doc_name = $row['doc_name'];

                        $date = $row['mdate'];
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['file_id'] ?></td>
                            <td><?php echo $row['file_name'] ?></td>
                            <td><?php echo $row['doc_name'] ?></td>
                            <td><?php echo $row['muser'] ?></td>
                            <td><?php echo $row['mdate'] ?></td>

                            <td><a href="upload/<?php echo $row['file_id']; ?>" target="_blank">View</a></td>
                            <td><a href="upload/<?php echo $row['file_id']; ?>" download>Download</td>

                            <td>
                                <a href="delete.php?del=<?php echo $row['id'] ?>">delete<span class="glyphicon glyphicon-trash" style="font-size:20px; color:red"></span></a>
                            </td>

                        </tr>

                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>文件編號</th>
                        <th>文件名稱</th>
                        <th>文件類別</th>
                        <th>維護人</th>
                        <th>上傳日期</th>
                        <th>檢視</th>
                        <th>下載</th>
                        <th>刪除</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            //inialize datatable
            $('#example').DataTable({
                "sPaginationType": "full_numbers",
                "bPaginate": true,
                "oLanguage": {
                    "sLengthMenu": "顯示 _MENU_ 筆記錄",
                    "sZeroRecords": "無符合資料",
                    "sInfo": "目前記錄：_START_ 至 _END_, 總筆數：_TOTAL_",
                    "sSearch": "搜尋",
                    "oPaginate": {
                        "sFirst": "首頁",
                        "sPrevious": "上頁",
                        "sNext": "下頁",
                        "sLast": "末頁"
                    }

                }
            });

            //hide alert
            $(document).on('click', '.close', function() {
                $('.alert').hide();
            })
        });
    </script>
    <script>
        for (var i = 0; i < document.links.length; i++) {
            if (document.links[i].href == document.URL) {
                document.links[i].className = 'active';
            }
        } <
        /body> <
        /html>