<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<title>Contacts</title>

	<style>
		@media only screen and (max-width: 576px) {
			.form-container {
				padding-left: 1em;
				padding-right: 1em;
			}

		}
	</style>
</head>

<body class="bg-warning">

	<div class="container form-container mb-5 p-5">
		<?php
		include 'session.php';
		?>
		<div class="row">
			<div class="col-12 mx-auto table-responsive ">
				<h1 class="mb-3"><strong>Contacts</strong></h1>
				<?php
				if (isset($_SESSION['error'])) {
					echo '<div class="alert alert-danger" role="alert">
							' . $_SESSION['error'] . '
							</div>';
					unset($_SESSION['error']);
				}
				if (isset($_SESSION['success'])) {
					echo '<div class="alert alert-success" role="alert">
							' . $_SESSION['success'] . '
							</div>';
					unset($_SESSION['success']);
				}
				?>
				<table class="table bg-light">
					<thead>
						<tr class="bg-primary text-white">
							<td>ID</td>
							<td>Name</td>
							<td>Email</td>
							<td>Phone</td>
							<td>Action</td>
						</tr>
					</thead>

					<tbody>
						<?php

						include 'config/dbconnect.php';

						$query = "SELECT id, name, email, phone FROM contacts ORDER BY id;";

						$result = $conn->query($query);

						if ($result->num_rows > 0) {

							while ($contact = $result->fetch_assoc()) {

								echo "<tr id='" . $contact['id'] . "'>";
								echo "<td>";
								echo $contact['id'];
								echo "</td>";
								echo "<td>";
								echo $contact['name'];
								echo "</td>";
								echo "<td>";
								echo $contact['email'];
								echo "</td>";
								echo "<td>";
								echo $contact['phone'];
								echo "</td>";
								echo "<td>";
								echo "<a href='edit-contact.php?id=" . $contact['id'] . "'>Edit</a>" . '&nbsp;&nbsp;&nbsp;' . "<a href='delete-contact.php?id=" . $contact['id'] . "'>Delete</a>";
								echo "</td>";
								echo "</tr>";
							}
						} else {
							echo '<div class="alert alert-danger" role="alert">
                No contacts available!"                        
              </div>';
						}

						?>
					</tbody>
				</table>
			</div>
			<a href="add-contact.php" class="my-2"><button class="btn btn-primary">Add Contact</button></a>
		</div>
	</div>

</body>

</html>