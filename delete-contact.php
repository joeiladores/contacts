<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<title>Delete Contact</title>
</head>

<body class="bg-warning">

	<div class="container mb-5 p-5">
		<?php
		include 'session.php';
		?>
		<div class="row">
			<div class="col-6 mx-auto bg-warning px-5 py-3 rounded-3">
				<h1 class="text-center"><strong>Delete Contact</strong></h1>
				<?php
				if (isset($_SESSION['error'])) {
					echo '<div class="alert alert-danger" role="alert">
							' . $_SESSION['error'] . '
							</div>';
					unset($_SESSION['error']);
				}
				?>
				<div class="container mb-5 p-3 bg-light rounded-3">
					<form method="post" action="delete-contact.php">
						<?php
						require 'config/dbconnect.php';
						if ($_SERVER["REQUEST_METHOD"] == "GET") {
							$id = $_GET['id'];
							$query = "SELECT * FROM contacts WHERE id = $id";
							$result = $conn->query($query);
							$contact = $result->fetch_assoc();
							$conn->close();
						}			
						?>
						<div class="mb-3">
							<label for="id" class="form-label">ID</label>
							<input type="text" class="form-control" id="id" name="id" value="<?php echo $contact['id']; ?>" readonly>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Name</label>
							<input type="text" class="form-control" id="name" name="name" value="<?php echo $contact['name']; ?>" readonly>
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $contact['email']; ?>" readonly>
						</div>
						<div class="mb-3">
							<label for="phone" class="form-label">Phone</label>
							<input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $contact['phone']; ?>" readonly>
						</div>
						<div clas="d-flex justify-content-between">
							<p>Are you sure you want to delete contact?</p>
							<a href="contacts.php" class="btn btn-primary">Cancel</a>
							<button type="submit" class="btn btn-primary">Delete Contact</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$id = $_POST['id'];

		$query = "DELETE FROM contacts WHERE id = '{$id}'";

		if ($conn->query($query)) {
			$_SESSION['success'] = "Contact was deleted successfully.";
			header('Location: contacts.php');
		} else {
			$_SESSION['error'] = "Error deletingcontact";
			header('location: contacts.php');
		}
	}

	$conn->close();

	?>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
	</script>

</body>

</html>