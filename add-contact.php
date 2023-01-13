<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Add Contact</title>
</head>

<body class="bg-warning">

	<div class="container mb-5 p-5">
		<?php
		include 'session.php';
		?>
		<div class="row">
			<div class="col-6 mx-auto px-5 py-3 rounded-3">
				<h1 class="mb-3 text-center"><strong>Add New Contact</strong></h1>
				<?php
				if (isset($_SESSION['error'])) {
					echo '<div class="alert alert-danger" role="alert">
							' . $_SESSION['error'] . '
							</div>';
					unset($_SESSION['error']);
				}
				?>
				<div class="container p-3 bg-light rounded-3">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
						<div class="mb-3">
							<label for="name" class="form-label">Name</label>
							<input type="text" class="form-control" id="name" name="name">
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" id="email" name="email">
						</div>
						<div class="mb-3">
							<label for="phone" class="form-label">Phone</label>
							<input type="tel" class="form-control" id="phone" name="phone">
						</div>
						<button type="submit" class="btn btn-primary">Add Contact</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php

	require 'config/dbconnect.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		// All info must be filled in
		if ($name == '' || $email == '' || $phone == '') {

			$_SESSION['error'] = "Please fill out the form completely!";
			header('location: add-contact.php');
		} else {

			$query = "INSERT INTO contacts (name, email, phone) VALUES ('{$name}', '{$email}', '{$phone}');";

			if ($conn->query($query)) {
				$_SESSION['success'] = "New contact was created successfully.";
				header("Location: contacts.php");
			} else {
				$_SESSION['error'] = "Error adding contact";
				header('location: contacts.php');
			}

			$conn->close();
		}
	}


	?>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
	</script>

</body>

</html>