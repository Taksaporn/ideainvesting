<?php
function CreateDataY($Ideanumber){
include 'databaseConnect.php';

  $IdeaID=$_GET['id'];

  //$firstDate = '2016-01-05';
  $firstDate='2014-01-02';

  $resultGetFirstdate = $conn->query("SELECT DateCreated FROM idea WHERE IdeaID=$IdeaID");
  $rowGetFirstdate= $resultGetFirstdate->fetch_array();  
  $firstDate = $rowGetFirstdate[0];


  $resultGetdateToday = $conn->query("SELECT dateToday FROM idea ");
  $rowGetdateToday= $resultGetdateToday->fetch_array();  
  $dateToday = $rowGetdateToday[0];
  
  // check firstdate
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

  //end check $firstDate


  // check $dateToday
  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$dateToday'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  if(empty($Firstdatetemp))
  {
    $dateToday = date('Y-m-d', strtotime($dateToday .' -1 day')); 
  }

  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$dateToday'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  if(empty($Firstdatetemp))
  {
    $dateToday = date('Y-m-d', strtotime($dateToday .' -1 day')); 
  }

  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$dateToday'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  if(empty($Firstdatetemp))
  {
    $dateToday = date('Y-m-d', strtotime($dateToday .' -1 day'));
  }


  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$dateToday'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  if(empty($Firstdatetemp))
  {
    $dateToday = date('Y-m-d', strtotime($dateToday .' -1 day'));
  }

  $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$dateToday'");
  $rowfindfirstdate = $resultfindfirstdate->fetch_array();
  $Firstdatetemp = $rowfindfirstdate[0];
  if(empty($Firstdatetemp))
  {
      $dateToday = date('Y-m-d', strtotime($dateToday .' -1 day'));
  }

  //end check $dateToday

	$arrIndex = array();
	$firstIndex_ingraph = 0;

  $resultDateToday=$conn->query("SELECT SETindex FROM setindexmarket WHERE DateIndex = '$firstDate' ");
  while($rowFirstdateSet = $resultDateToday->fetch_array())
  {
    $firstIndex_ingraph = $rowFirstdateSet[0];
  }


 	//echo $firstIndex_ingraph;
  // generate graph set index
  $resultIndex = $conn->query("SELECT * FROM setindexmarket WHERE DateIndex >= '$firstDate' and DateIndex <='$dateToday' ");
  $sum = 0;
  while($rowIndex = $resultIndex->fetch_array()) 
  { // 5 รอบ
    $date = $rowIndex['DateIndex'];
    $SETIndex = $rowIndex['SETindex'];
    $arrIndex["'".$date."'"] = ($SETIndex/$firstIndex_ingraph)-1;
    
  }
   //print_r($arrIndex);
  return $arrIndex;
  }
?>
