<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Contact Me</title>
</head>

<body>
	<h1>Contact Me</h1>

	<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	// Array of captcha images and their correct text
	$captcha_images = [
		'captcha1.PNG' => '6T9JBCDS',
		'captcha2.PNG' => 'captcha246',
		'captcha3.PNG' => '8Z8ME',
		'captcha4.PNG' => 'MY5N5',
		'captcha5.PNG' => 'Td4eva',
		'captcha6.PNG' => 'W68HP',
		'captcha7.PNG' => 'CAPTCHA',
		'captcha8.PNG' => '6345262',
	];

	// If the form has been submitted, check the captcha text
	if (!isset($_POST['captcha'])) {

		// Select a random captcha image
		$captcha_image = array_rand($captcha_images);
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// If the form has been submitted, check the captcha text
		if (!isset($captcha_image)) {
			$captcha_image = $_POST['captcha_image']; // Get the file name of the captcha image from the form
		}
		if ($_POST['captcha'] == $captcha_images[$captcha_image]) { // Use the correct text for the selected captcha image

			// If the captcha text is correct, send the email
			if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comments'])) {

				$body = "Name: {$_POST['name']}\n\nEmail: {$_POST['email']}\n\nComments: {$_POST['comments']}";

				$body = wordwrap($body, 70);

				$to = 'bellKevin@pm.me';
				mail($to, 'Contact Form Submission', $body, "From: {$_POST['email']}");

				echo '<p><em>Thank you for contacting me. I will reply some day.</em></p>';

				// Clear the posted values:
				$_POST = [];
			} else {
				echo '<p style="font-weight: bold; color: #C00">Please fill out the form completely.</p>';
			}
		} else {
			echo '<p style="font-weight: bold; color: #C00">Please enter the correct text from the captcha image.</p>';
			// Select a random captcha image
			$captcha_image = array_rand($captcha_images);
		}
	}

	?>
	<p>Please fill out this form to contact me.</p>
	<form action="email.php" method="post">
		<label for="name">Name:</label><br>
		<input type="text" id="name" name="name"><br>
		<label for="email">Email:</label><br>
		<input type="email" id="email" name="email"><br>
		<label for="comments">Comments:</label><br>
		<textarea id="comments" name="comments"></textarea><br>
		<!-- Display the captcha image -->
		<img src="./captcha-image/<?php echo $captcha_image; ?>" <br>
		<br>
		<label for="captcha">Enter the text from the image:</label><br>
		<input type="text" id="captcha" name="captcha"><br><br>
		<!-- Add a hidden input field to store the file name of the captcha image -->
		<input type="hidden" name="captcha_image" value="<?php echo $captcha_image; ?>">
		<input type="submit" value="Submit">
	</form>
</body>

</html>
