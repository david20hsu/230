<?php
session_start();    //啟用 session
session_unset();    //清除所有SESSION
session_destroy();  //將重置session，您將失去所有已存儲的session數據。
header('location:index.php');
exit();