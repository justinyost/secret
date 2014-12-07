<?php
require_once ( dirname(dirname(__FILE__)) . '/vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
require_once ( dirname(dirname(__FILE__)) . '/config/config.php');

/**
 * SendEmails
 *
 * Send emails
 */
class SendEmails {

	/**
	 * send the emails for the system
	 *
	 * @param  array $shuffledPeople   the array of shuffled people
	 * @param  array $unshuffledPeople the array of unshuffled people
	 * @param  string $giftValue       the suggested gift value
	 * @return array|bool
	 */
	public function send($shuffledPeople, $unshuffledPeople, $giftValue = "$25.00") {
		foreach ($shuffledPeople as $key => $person) {
			try {
				$this->sendEmail($person, $key, $unshuffledPeople, $giftValue);
			} catch (Exception $e) {
				return false;
			}
			$success[] = $person['name'] . " has been assigned to a random person.";
		}

		return $success;
	}

	/**
	 * send a single email
	 *
	 * @param  [type] $person           [description]
	 * @param  [type] $key              [description]
	 * @param  [type] $unshuffledPeople [description]
	 * @param  [type] $giftValue        [description]
	 * @return void
	 * @throws Exception If PHPMailer throws an error
	 */
	public function sendEmail($person, $key, $unshuffledPeople, $giftValue) {
		$PHPMailer = new PHPMailer(true);
		$PHPMailer->isSMTP();
		$PHPMailer->Host = MAIL_SERVER;
		$PHPMailer->SMTPAuth = SMTP_AUTH;
		$PHPMailer->Username = MAIL_USERNAME;
		$PHPMailer->Password = MAIL_PASSWORD;
		$PHPMailer->SMTPSecure = SMTP_SECURE;
		$PHPMailer->Port = SMTP_PORT;

		$PHPMailer->From = FROM_EMAIL;
		$PHPMailer->FromName = FROM_NAME;
		$PHPMailer->addReplyTo(FROM_EMAIL, FROM_NAME);
		$PHPMailer->isHTML(true);

		$PHPMailer->addAddress($unshuffledPeople[$key]['email'], $unshuffledPeople[$key]['name']);

		$PHPMailer->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$PHPMailer->Subject = "Secret Santa Assigned To You: " . $person['name'];

		$messageHtml = "<p>Hi " . $unshuffledPeople[$key]['name'] . ",</p>";
		$messageHtml .= "<p>You are assigned to purchase a " . $giftValue . " dollar or less gift for " . $person['name'] . ". Their email address is: " . $person['email'] . "</p>";

		if (!empty($person['other'])) {
			$messageHtml .= "<p>Some other information: " . $person['wishlist'] . "</p>";
		}

		$messageHtml .= "<p>Have a safe and fun holiday season!</p><p>This Message brought to you via Secret Santa App at <a href='" . CANONICAL_URL . "' title='" . CANONICAL_URL . "'>" . CANONICAL_URL . "</a><p>";

		$PHPMailer->MsgHTML($messageHtml);
		$PHPMailer->Send();
	}
}
