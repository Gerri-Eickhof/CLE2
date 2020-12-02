<?php
include 'Swebtite.php';
$conn = OpenCon();

closeCon($conn);
?>

<html lang="en">
<head>
	<title>Reservering</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class= "contact-title">
		<h1>Thank you so much for making an appointment</h1>
		<h2> If you have any further questions, feel free to leave a comment in the message box below.  </h2>
	</div>


	<div class= "contact-form">
		<form id="contact-form" method="post" action="insert.php">
			<h3>Contact information</h3>
				<br>
			<input type="text" name="firstName" class="form-control" placeholder="First name" required>
				<br>
			<input type="text" name="lastName" class="form-control" placeholder="Last name" required>
				<br>
			<input type="text" name="emailAdress" class="form-control" placeholder="Your Email" required>
				<br>
			<input type="text" name="phoneNumber" class="form-control" placeholder="Phone number" >
				<br>
			<textarea name="message" class="form-control" placeholder="message">
			</textarea>
				<br>
			<h3>Pick the date</h3>
				<br>
            <label>Date</label>
                <select name ="date" required>
                    <option value="">--Select--</option>
                    <option value="Monday">Monday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            <h3>Pick the time</h3>
                <br>
            <label>Time</label>
                <select name ="time" required>
                    <option value="">--Select--</option>
                    <option value="10:00-10:15">10:00-10:15</option>
                    <option value="14:00-14:15">14:00-14:15</option>
                    <option value="20:00-20:15">20:00-20:15</option>
                </select>

				<br>

            <input id="submit" type="submit" name="submit" value="SUBMIT">
		</form>
	</div>
</body>
</html>