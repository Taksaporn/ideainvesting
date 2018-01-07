<?php
	//fetch.php
	$connect = mysqli_connect("localhost", "taksa", "chaikeawmay", "ideadatabase");
	$request = mysqli_real_escape_string($connect, $_POST["query"]);
	//$request= "chiangmai";
	$data = array();
	$flag = 0;
	$set_text = array();
	if(strlen($request) > 4){
		$query = "SELECT * FROM listofcompanies WHERE Company LIKE '%".$request."%'";
		//echo $query.'<br>';
		$result = mysqli_query($connect, $query);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result))
			 {
			 	$set_text[] = "'".$row['Symbol']."'";
			  	$flag = 1;
			 }
		}
	}
	//echo "<pre>";
	//print_r($set_text);
	//echo "</pre>";
	$text_where_not_in = ($flag == 1 ? 'or Symbol in ('.implode(',', $set_text).')':'');
	//echo $text_where_not_in;
	$query3 = "SELECT * FROM listofcompanies WHERE  Symbol LIKE '".$request."%'  {$text_where_not_in} group by setID";
	//echo $query3;
	$result3 = mysqli_query($connect, $query3);
	if(mysqli_num_rows($result3) > 0)
	{
		while($row3 = mysqli_fetch_assoc($result3))
	    {
				$data[] = array
				(
			 		'Symbol' => $row3["Symbol"],
			 		'Company' => $row3["Company"]
			 	);
			  	
	    }
	}
	echo json_encode($data);
?>
