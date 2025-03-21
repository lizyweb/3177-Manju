<?php
include_once("RealCRMWebAPI.php");
    
    /* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "fyuorejf_contact", "*A(KD5k]DB0f", "fyuorejf_contactform");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$name = mysqli_real_escape_string($link, $_REQUEST['name']);
$the_link= mysqli_real_escape_string($link, $_REQUEST['the_link']);
$number = mysqli_real_escape_string($link, $_REQUEST['number']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$city = mysqli_real_escape_string($link, $_REQUEST['city']);
// Attempt insert query execution
$sql = "INSERT INTO tblcontactdata (FullName, Pageurl, PhoneNumber, EmailId, ClientCity, Message) VALUES ('$name', '$the_link', '$number', '$email', '$city')";
if(mysqli_query($link, $sql)){
    echo "Successfully Submited Your Form.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

//mail function for sending mail
$to='webenquiry@manjugroups.in';
$subject='Enquiry Form';
$headers .= "MIME-Version: 1.0"."\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:Website Enquiry<webenquiry@manjugroups.in>'."\r\n";
$ms.="<html></body><div>
<div><b>Name:</b> $name,</div>
<div><b>Pageurl:</b> $the_link,</div>
<div><b>Phone Number:</b> $number,</div>
<div><b>Client City:</b> $city,</div>
<div><b>Email Id:</b> $email,</div><div></div></body></html>";
mail($to,$subject,$ms,$headers);
    
    $lead = new RealCRMWebClient();
	
	$lead->PrimaryCampaign = "Web";
	$lead->SecondaryCampaign = "";			// Optional
	$lead->ContactName = $name;
	$lead->MobileNumber = $number;
	$lead->EmailId = $email;					// Optional
	$lead->Budget = "";						// Optional
	$lead->ClientCity = "$city";					// Optional
	$lead->LeadReferenceId = "";			// Optional, reference from the database, if available.
	
	try{
		$lead->PostData();
		echo 'Successfully posted the data.';
	}
	catch(Exception $e)
	{
		echo "Caught exception: $e->getMessage()";
	}	
	
	header('Location: https://www.manjugroups.in/thank-you');
?>