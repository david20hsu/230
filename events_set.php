<?php
include_once 'conn.php';
ini_set('date.timezone','Asia/Taipei');   //台北時間
$sdate =""
$sql = "select * from events_set where set_code in('W','M','Q','Y') ";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
while($row=mysqli_fetch_assoc($result))
{  
    $tp=$row['tp'];
	$title=$row['title'];
	$desp=$row['description'];
	$dutyer=$row['dutyer'];
	$color=$row['color'];
	$status=$row['$status'];
	$ty =date($row['start'],'Y'); //今年
	$tm =date($row['start'],'M'); //本年
	$sql="";
	switch ($row['set_code'])
    {
     case "W":
	     $sql ="insert into events(tp,title,description,dutyer,color,status,start,end)
		 values('".$tp,"','".$title,"','".$desp."','".$dutyer."','"$status."'."
		 $sdate=$row['start'];
		 $edate =$row['end'];
         while (true) { // 這裡看上去這個迴圈會一直執行
		       $start =date('Y-m-d H:i:s',$sdate.strtotime('+7 day'))
			   $end =date('Y-m-d H:i:s',$edate.strtotime('+7 day'))
			   if $ty ==date($start,'Y')
			   {
				   $sql=$sql ."'".start."','".$end ."')";
				   echo $sql; 
				  // $result = mysqli_query($conn, $sql);
			   }else{
				   exit;
			   }
			  
		 }
        break;
    case "M":
    
        break;
	case "Q":
    
        break;
	case "Y":
    
        break;
     default:
    
    }
}
?>

?>