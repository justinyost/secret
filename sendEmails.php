<?php
require_once("./config.php");

$input = array();
$errors = array();
$success = array();

$input['number_ppl'] = ($_GET['number_ppl']) ? $_GET['number_ppl'] : $_POST['number_ppl'];
$input['form_key'] = ($_GET['form_key']) ? $_GET['form_key'] : $_POST['form_key'];
$input['rand_key'] = ($_GET['rand_key']) ? $_GET['rand_key'] : $_POST['rand_key'];
$input['names'] = ($_GET['names']) ? $_GET['names'] : $_POST['names'];
$input['emails'] = ($_GET['emails']) ? $_GET['emails'] : $_POST['emails'];
$input['gift_value'] = ($_GET['gift_value']) ? $_GET['gift_value'] : $_POST['gift_value'];

try{
	if(validate_input($input, $errors) && validate_form($input, $errors) && eliminate_blank_values($input) && validate_emails($input, $errors) && (count($input['names']) >= 1)){
		if(send_emails($input, $errors, $success)){ return_success($success); } else { return_errors($errors); }
	} else {
		return_errors($errors);
	}
} catch (Exception $e) {
	return_errors($errors, $input, $e);
}

function validate_input(&$input, &$errors){
	$return_val = true;
	
	//Testing Form Key
	if(!isset($input['form_key']) || empty($input['form_key']) || !is_numeric($input['form_key'])){
		$errors['form'] = "Form is not valid";
		$return_val = false;
	}
	
	//Testing Random Key
	if(!isset($input['rand_key']) || empty($input['rand_key']) || !is_numeric($input['rand_key'])){
		$errors['form'] = "Form is not valid";
		$return_val = false;
	}
	
	//Testing Number of People
	if(!isset($input['number_ppl']) || empty($input['number_ppl']) || !is_numeric($input['number_ppl'])){
		$errors['form'] = "Form is not valid";
		$return_val = false;
	}
	
	//Testing Names
	if(!isset($input['names']) || empty($input['names']) || !is_array($input['names']) ){
		$errors['names'] = "One of the names is empty";
		$return_val = false;
	}
	
	//Testing Random Key
	if(!isset($input['gift_value']) || empty($input['gift_value']) || !is_numeric($input['gift_value'])){
		$errors['gift_value'] = "Gift Value is not valid";
		$return_val = false;
	}
	
	//Testing Emails
	if(!isset($input['emails']) || empty($input['emails']) || !is_array($input['emails']) ){
		$errors['names'] = "One of the emails is empty";
		$return_val = false;
	}
	
	return $return_val;
}

function validate_form(&$input, &$errors){
	mt_srand($input['rand_key']);
	if(mt_rand() != $input['form_key']){
		$errors['form'] = "Form is not valid";
		return false;
	}
	return true;
}

function array_shuffle($array){
	// shuffle using Fisher-Yates
	$i = count($array);
	
	while(--$i){
		$j = mt_rand(0,$i);
		if($i != $j){
			// swap items
			$tmp = $array[$j];
			$array[$j] = $array[$i];
			$array[$i] = $tmp;
		}
	} 
	return $array;
}

function return_success(&$success){
	?> <div class="success"><ul> <?php
		foreach($success as $sucs){ echo "<li>".$sucs."</li>"; }
	?> </ul><p><a href="#" onclick="displayForm();">Want to try again?</a></p></div> <?php
}

function send_emails(&$input, &$errors, &$success){
	require_once('./includes/phpmailer/class.phpmailer.php');

	$return_val = true;
	
	$shuffledArray = array();
	$nonShuffledArray = array();
	foreach($input['emails'] as $key => $email){
		$shuffledArray[] = array(
			'email' => $input['emails'][$key],
			'name' => $input['names'][$key],
		);
		$nonShuffledArray[] = array(
			'email' => $input['emails'][$key],
			'name' => $input['names'][$key],
		);
	}
	
	for($i = 0; $i <= 10; $i++){
		$shuffledArray = array_shuffle($shuffledArray);
	}
	
	try{
		foreach($shuffledArray as $key => $data):
			$mail = new PHPMailer(true);
			$mail->IsSMTP();
			$mail->Host       = MAIL_SERVER;
  			$mail->SMTPDebug  = 0;
  			$mail->SMTPAuth   = SMTP_AUTH;
  			$mail->SMTPSecure = SMTP_SECURE;
  			$mail->Port       = SMTP_PORT;
  			$mail->Username   = MAIL_USERNAME;
  			$mail->Password   = MAIL_PASSWORD;
  			$mail->AddReplyTo(MAIL_USERNAME, MAIL_NAME);
  			$mail->SetFrom(MAIL_USERNAME, MAIL_NAME);
  			
  			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
  			
  			$mail->AddAddress($nonShuffledArray[$key]['email'], $nonShuffledArray[$key]['name']);
  			
			$mail->Subject = "Secret Santa Assigned To You: ".$data['name'];
			
			$messageHtml = "<p>Hi ".$nonShuffledArray[$key]['name'].",</p><p>You are assigned to purchase a ".$input['gift_value']." dollar or less gift for ".$data['name'].". Their email address is: ".$data['email']."</p><p>Have a safe and fun holiday season!</p><p>This Message brought to you via Secret Santa App at <a href='".CANONICAL_URL."' title='".CANONICAL_URL."'>".CANONICAL_URL."</a><p>";
			$mail->MsgHTML($messageHtml);
			$mail->Send();
			$success[] = $data['name']." has been assigned to a random person.";
		endforeach;
	} catch (Exception $e) { return_errors($errors, $input, $e); return false; }
	return true;
}

function return_errors(&$errors, &$input = null, &$e = null){
	?> <div class="error"><ul> <?php
	if(isset($errors) && !empty($errors)){
		foreach($errors as $error){ echo "<li>".$error."</li>"; }
		echo "</ul>";
	} else { ?> <li>Something Unknown Happened</li></ul> <?php }
	?> <p><a href="#" onclick="displayForm();">Want to try again?</a></p></div> <?php
	if(isset($e) && !empty($e) ){
		?> <div class="hidden">Exception: <?php echo $e->getMessage(); ?> </div> <?php
	}
}

function eliminate_blank_values(&$input){
	foreach($input['names'] as $i => $name){
		if(empty($name)){
			unset($input['names'][$i]);
			$input['names'] = array_values($input['names']);
			//Unset email associated with empty name
			unset($input['emails'][$i]);
			$input['emails'] = array_values($input['emails']);
		}
	}
	foreach($input['emails'] as $i => $email){
		if(empty($email)){
			unset($input['emails'][$i]);
			$input['emails'] = array_values($input['emails']);
			//Unset name associated with empty email
			unset($input['names'][$i]);
			$input['names'] = array_values($input['names']);
		}
	}
	return true;
}

function validate_emails(&$input, &$errors){
	$return_val = true;
	foreach($input['emails'] as $i => $email){
		if(!check_email_address($email)){
			$errors[] = $input['names'][$i]."'s email address is not valid";
			$return_val = false;
		}
	}
	return $return_val;
}

function check_email_address(&$email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
         if (!ereg("^(([A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
            return false;
        }
    }    
    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}
?>