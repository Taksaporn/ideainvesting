<?php
function CreateDataX($ideaID)
{
  include 'databaseConnect.php';

  $resultGetFirstdate = $conn->query("SELECT DateCreated FROM idea WHERE ideaID = $ideaID");
  $rowGetFirstdate= $resultGetFirstdate->fetch_array();  //Get price when create the idea
  $GetFirstdate = $rowGetFirstdate[0];


  $resultGetDateCreated = $conn->query("SELECT dateToday FROM idea WHERE ideaID = $ideaID");
  $rowDateCreated= $resultGetDateCreated->fetch_array();  //Get price when create the idea
  $dateToday = $rowDateCreated[0];

   // check getfirstdate
    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$GetFirstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];
    if(empty($Firstdatetemp))
    {
      $GetFirstdate = date('Y-m-d', strtotime($Firstdate .' -1 day'));
      
    }

    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$GetFirstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];
    if(empty($Firstdatetemp))
    {
      $GetFirstdate = date('Y-m-d', strtotime($GetFirstdate .' -1 day'));
      
    }

    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$GetFirstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];
    if(empty($Firstdatetemp))
    {
      $GetFirstdate = date('Y-m-d', strtotime($GetFirstdate .' -1 day'));
    }

    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$GetFirstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];
    if(empty($Firstdatetemp))
    {
      $Firstdate = date('Y-m-d', strtotime($Firstdate .' -1 day'));
    }

    $resultfindfirstdate=$conn->query("SELECT DateIndex FROM setindexmarket WHERE DateIndex='$GetFirstdate'");
    $rowfindfirstdate = $resultfindfirstdate->fetch_array();
    $Firstdatetemp = $rowfindfirstdate[0];

    if(empty($Firstdatetemp))
    {
      $GetFirstdate = date('Y-m-d', strtotime($GetFirstdate .' -1 day'));
    }

    //end check GETfirstdate


    //check dateToday
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
    //end datetoday

  $arrValue = array();
  $resultSymbol = $conn->query("SELECT * FROM stockidea Where ideaID = $ideaID");
  while($rowSymbol = $resultSymbol->fetch_array()) { // 5 รอบ
    $Symbol = $rowSymbol['Symbol'];
    $Weight = $rowSymbol['Percent'];
    
    $resultGetPriceDateCreated = $conn->query("SELECT Priceclose FROM historyprice WHERE Symbol = '$Symbol'AND datePrice <= '$dateToday' ");
    $rowpriceCreatedDate = $resultGetPriceDateCreated->fetch_array();
    $PriceDateCreated = $rowpriceCreatedDate[0];
    
    $resultValue = $conn->query("SELECT datePrice, (($Weight/$PriceDateCreated)*Priceclose) AS Value FROM historyprice WHERE Symbol = '$Symbol'");
    $arrValue["'".$Symbol."'"] = array();
    while($rowValue = $resultValue->fetch_array()) 
    {
      // $tmpValue = array();
      // $tmpValue['datePrice'] = $rowValue['datePrice'];
      // $tmpValue['Value'] = $rowValue['Value'];
      $arrValue["'".$Symbol."'"]["'".$rowValue['datePrice']."'"] = $rowValue['Value'];
      // print_r($rowValue);
    }
    // echo $rowSymbol['Symbol'];
   //  print_r($arrValue);
  }
  // print_r($arrValue);
  //$datePrice= $conn->query("SELECT datePrice FROM historyprice WHERE Symbol = '$Symbol'");
  $arrDate = array();
  $resultdatePrice = $conn->query("SELECT DISTINCT datePrice FROM historyprice WHERE datePrice >= '$GetFirstdate' and datePrice <= '$dateToday' ");
  //$resultdatePrice = $conn->query("SELECT DISTINCT datePrice FROM historyprice WHERE datePrice <= '$DateCreated' ");

  while($rowdatePrice = $resultdatePrice->fetch_array()) 
  {
    array_push($arrDate, $rowdatePrice['datePrice']);  
  }
  // print_r($arrDate);
$arrSum = array();
  foreach ($arrDate as $dateToday) 
  {
    $resultSymbol = $conn->query("SELECT * FROM stockidea where ideaID = $ideaID");
    $sum = 0;
    while($rowSymbol = $resultSymbol->fetch_array()) 
    { // 5 รอบ
      $Symbol = $rowSymbol['Symbol'];
      
        if(array_key_exists("'".$dateToday."'", $arrValue["'".$Symbol."'"])) 
        {
          $sum += $arrValue["'".$Symbol."'"]["'".$dateToday."'"];
        }
    }
    $arrSum["'".$dateToday."'"] = array();
    $arrSum["'".$dateToday."'"] = $sum;
  }
  $SumFirstDate = $arrSum["'".$GetFirstdate."'"];
  $arrIdeaIndex = array();
  foreach ($arrSum as $key => $value) {
    $sum = 0;
    $sum = ($value/$SumFirstDate) -1;
    $arrIdeaIndex[$key] = array();
    $arrIdeaIndex[$key] = $sum;
 } //echo$SumFirstDate;
  return $arrIdeaIndex;
  }
?>
