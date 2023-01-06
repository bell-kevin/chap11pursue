<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Contact Me</title>
</head>

<body>
	<h1>Contact Me</h1>
	<?php # Script 11.1 - email.php

	// Check for form submission:
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// Check the captcha text:
		if ($_POST['captcha'] == "6T9JBCDS") {

			// Minimal form validation:
			if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comments'])) {

				// Create the body:
				$body = "Name: {$_POST['name']}\n\nEmail: {$_POST['email']}\n\nComments: {$_POST['comments']}";

				// Make it no longer than 70 characters long:
				$body = wordwrap($body, 70);

				// Send the email:
				//the email address is the one you want to send the email to
				//so bellKevin@pm.me can be changed to whoever you want to send the email to like kevinbellr@gmail.com or george.ray@davistech.edu
				//the subject is the subject line of the email, so Contact Form Submission can be changed to whatever you want
				$to = 'bellKevin@pm.me';
				mail($to, 'Contact Form Submission', $body, "From: {$_POST['email']}");

				// Print a message:
				echo '<p><em>Thank you for contacting me. I will reply some day.</em></p>';

				// Clear $_POST (so that the form's not sticky):
				$_POST = [];
			} else {
				echo '<p style="font-weight: bold; color: #C00">Please fill out the form completely.</p>';
			}
		} else {
			echo '<p style="font-weight: bold; color: #C00">Please enter the correct text from the captcha image.</p>';
		}
	} // End of main isset() IF.

	// Create the HTML form:
	?>
	<p>Please fill out this form to contact me.</p>

	<!-- this form is giving me an error. if i use the form from email.php from chap11exer, then it works-->
	<form action="/submit-form" method="post">
		<label for="name">Name:</label><br>
		<input type="text" id="name" name="name"><br>
		<label for="email">Email:</label><br>
		<input type="email" id="email" name="email"><br>
		<label for="subject">Subject:</label><br>
		<select id="subject" name="subject">
			<option value="general">General Inquiry</option>
			<option value="sales">Sales Inquiry</option>
			<option value="support">Support Request</option>
		</select><br>
		<label for="message">Message:</label><br>
		<textarea id="message" name="message"></textarea><br>
		<!-- <img src="/captcha-image/captcha.PNG" alt="Captcha"> -->
		<br>
		<label for="captcha">Enter the text from the image:</label><br>
		<input type="text" id="captcha" name="captcha"><br><br>
		<input type="submit" value="Submit">
	</form>
</body>

</html>
