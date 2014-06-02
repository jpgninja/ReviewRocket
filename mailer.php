<?php

	session_start();
	
	function getRealIp() {
	   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
		 $ip=$_SERVER['HTTP_CLIENT_IP'];
	   } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
		 $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	   } else {
		 $ip=$_SERVER['REMOTE_ADDR'];
	   }
	   return $ip;
	}

	function writeLog($where) {
	
		$ip = getRealIp(); // Get the IP from superglobal
		$host = gethostbyaddr($ip);    // Try to locate the host of the attack
		$date = date("d M Y");
		
		// create a logging message with php heredoc syntax
		$logging = <<<LOG
			\n
			<< Start of Message >>
			There was a hacking attempt on your form. \n 
			Date of Attack: {$date}
			IP-Adress: {$ip} \n
			Host of Attacker: {$host}
			Point of Attack: {$where}
			<< End of Message >>
LOG;
// Awkward but LOG must be flush left
	
			// open log file
			if($handle = fopen('hacklog.log', 'a')) {
			
				fputs($handle, $logging);  // write the Data to file
				fclose($handle);           // close the file
				
			} else {  // if first method is not working, for example because of wrong file permissions, email the data
			
				$to = 'chris@clientcoffee.com';  
				$subject = 'ReviewRocket Hack Attempt';
				$header = 'From: noreply@clientcoffee.com';
				if (mail($to, $subject, $logging, $header)) {
					echo "Sent notice to admin.";
				}
	
			}
	}

	function verifyFormToken($form) {
		
		// check if a session is started and a token is transmitted, if not return an error
		if(!isset($_SESSION[$form.'_token'])) { 
			return false;
		}
		
		// check if the form is sent with token in it
		if(!isset($_POST['token'])) {
			return false;
		}
		
		// compare the tokens against each other if they are still the same
		if ($_SESSION[$form.'_token'] !== $_POST['token']) {
			return false;
		}
		
		return true;
	}
	
	function generateFormToken($form) {
	
		// generate a token from an unique value, took from microtime, you can also use salt-values, other crypting methods...
		$token = md5(uniqid(microtime(), true));  
		
		// Write the generated token to the session variable to check it against the hidden field when the form is sent
		$_SESSION[$form.'_token'] = $token; 
		
		return $token;
	}
	
	// VERIFY LEGITIMACY OF TOKEN
	if (verifyFormToken('form1')) {
	
		// CHECK TO SEE IF THIS IS A MAIL POST
		if (isset($_POST['name'])) {
		
			// Building a whitelist array with keys which will send through the form, no others would be accepted later on
			$whitelist = array('token','name','phone','feedback');
			
			// Building an array with the $_POST-superglobal 
			foreach ($_POST as $key=>$item) {
					
				// Check if the value $key (fieldname from $_POST) can be found in the whitelisting array, if not, die with a short message to the hacker
				if (!in_array($key, $whitelist)) {
					
					writeLog('Unknown form fields');
					die("Hack-Attempt detected. Please use only the fields in the form.");
					
				}
			}

			// Lets check the URL whether it's a real URL or not. if not, stop the script
			// if(!filter_var($_POST['URL-main'],FILTER_VALIDATE_URL)) {
			// 			writeLog('URL Validation');
			// 		die('Hack-Attempt detected. Please insert a valid URL');
			// }

			// SAVE INFO AS COOKIE, if user wants name and email saved
			$saveCheck = $_POST['save-stuff'];
			if ($saveCheck == 'on') {
				setcookie("WRCF-Name", $_POST['req-name'], time()+60*60*24*365);
				setcookie("WRCF-Email", $_POST['req-email'], time()+60*60*24*365);
			}
			

			// PREPARE THE BODY OF THE MESSAGE
			$message  = '<html>'
			$message .= '<body>';
			$message .= '<img src="http://css-tricks.com/examples/WebsiteChangeRequestForm/images/wcrf-header.png" alt="Client Feedback" />';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<tr><td><strong>Name:</strong> </td><td>" 			. strip_tags($_POST['name']) 			. "</td></tr>";
			$message .= "<tr><td><strong>Phone:</strong> </td><td>" 		. strip_tags($_POST['phone']) 		. "</td></tr>";
			$message .= "<tr><td><strong>Feedback:</strong> </td><td>" 	. strip_tags($_POST['feedback']) 	. "</td></tr>";
			$message .= "</table>";
			$message .= "</body>";
			$message .= "</html>";

			
			//  MAKE SURE THE "NAME" DOESN'T HAVE ANY NASTY STUFF IN IT
			$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i"; 
			if (preg_match($pattern, trim(strip_tags($_POST['name'])))) { 
				$cleanedName = trim(strip_tags($_POST['name'])); 
			} else { 
				return "The name you entered was invalid. Please try again!"; 
			} 

			//  MAKE SURE THE "PHONE" DOESN'T HAVE ANY NASTY STUFF IN IT
			if (preg_match($pattern, trim(strip_tags($_POST['phone'])))) { 
				$cleanedPhone = trim(strip_tags($_POST['phone'])); 
			} else { 
				return "The phone number you entered was invalid. Please try again!"; 
			}

			//  MAKE SURE THE "FEEDBACK" DOESN'T HAVE ANY NASTY STUFF IN IT
			if (preg_match($pattern, trim(strip_tags($_POST['feedback'])))) { 
				$cleanedFeedback = trim(strip_tags($_POST['feedback'])); 
			} else { 
				return "Your feedback was invalid. Please try again!"; 
			} 

			//   CHANGE THE BELOW VARIABLES TO YOUR NEEDS
			 
			$to = 'JUNKKKKK@gmail.com';
			
			$subject = 'Website Change Reqest';
			
			$headers = "From: noreply@clientcoffee.com\r\n";
			$headers .= "Reply-To: noreply@clientcoffee.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			// if (mail($to, $subject, $message, $headers)) {
			//   echo 'Your message has been sent.';
			// } else {
			//   echo 'There was a problem sending the email.';
			// }
			
			// DON'T BOTHER CONTINUING...
			die();

		}
	} else {
	
		if (!isset($_SESSION[$form.'_token'])) {
		
		} else {
			echo "Hack-Attempt detected. Got ya!.";
			writeLog('Formtoken');
		}
   
	}

   // generate a new token for the $_SESSION superglobal and put them in a hidden field
	$newToken = generateFormToken('form1');   
?>