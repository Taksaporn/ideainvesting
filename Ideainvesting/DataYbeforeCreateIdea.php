<?php
include 'databaseConnect.php';

  $resultGetdateToday = $conn->query("SELECT dateToday FROM idea ");
  $rowGetdateToday= $resultGetdateToday->fetch_array();  
  $dateToday = $rowGetdateToday[0];

  $startDate = date_create($dateToday);
  date_modify($startDate, '-365 days');
  $firstDate=date_format($startDate, 'Y-m-d');

  // find firstdate
  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  if(empty($Firstdatetemp))
  {
    $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day')); 
  }

  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];

  if(empty($Firstdatetemp))
  {
    $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day')); 
  }


  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];

  if(empty($Firstdatetemp))
  {
    $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day'));
  }


  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];

  if(empty($Firstdatetemp))
  {
    $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day'));
  }

  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$firstDate'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];

  if(empty($Firstdatetemp))
  {
      $firstDate = date('Y-m-d', strtotime($firstDate .' -1 day'));
  }
 

	$arrIndex = array();
	$firstIndex_ingraph = 0;

  $resultDateToday=$conn->query("SELECT SETindex FROM setindexmarket WHERE DateIndex = '$firstDate' ");
  while($rowFirstdateSet = $resultDateToday->fetch_array())
  {
    $firstIndex_ingraph = $rowFirstdateSet[0];
  }

 	/*$resultSetFirstdate=$conn->query("SELECT SETindex FROM setindexmarket WHERE DateIndex = '$firstDate'");
 	while($rowFirstdateSet = $resultSetFirstdate->fetch_array())
  {
 		$firstIndex_ingraph = $rowFirstdateSet[0];
 	}*/

  $resultIndex = $conn->query("SELECT * FROM setindexmarket WHERE DateIndex >= '$firstDate' and DateIndex <='$dateToday' ");
  $sum = 0;
  while($rowIndex = $resultIndex->fetch_array()) 
  { // 5 รอบ
    $date = $rowIndex['DateIndex'];
    $SETIndex = $rowIndex['SETindex'];
    $arrIndex["'".$date."'"] = ($SETIndex/$firstIndex_ingraph)-1;
    
  }
   //print_r($arrIndex);
?>
