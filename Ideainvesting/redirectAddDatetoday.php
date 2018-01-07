<?php
  include 'databaseConnect.php';

    $userid =1;
    $dateToday=$_POST['setdateToday'];

    // find firstdate
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


    //$dateToday='2016-01-02';
    echo $dateToday.'<br>';

    $sql = "UPDATE idea SET dateToday = '$dateToday'";
    $conn->query($sql); 
    

    //$sqltrunc = $conn->query("TRUNCATE TABLE sumcalculatestock");
    //$conn->query($sqltrunc);
    mysqli_close($conn);
    header('Location: performance.php');
?>
