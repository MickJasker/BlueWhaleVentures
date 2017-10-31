<?php
require '../../Main/Includes/PHP/functions.php';
$ID = secure($_GET["id"]);
$UserID = $_SESSION["UserID"];
?>
<!DOCTYPE html>
<html>
	<head>
	    <title> Client Portal </title>
	    <link rel="stylesheet" href="../../Main/Includes/CSS/main.css">
		<script src="../../Main/Includes/Javascript/functions.js"></script>
	</head>

	<body id="wrapper-experimentExecuteable">
	    <header class="wrapper-nav">
	        <?php require "../nav_nosearchmentor.php";?>
	    </header>
	    <main>
	        <?php 
	        echo "string"; 
	        getExperimentView($ID); ?>
			<h2> Feedback </h2>
			<div>
				<form id="form" action="#" method="POST">
					<textarea name="feedbackContent"> </textarea> <br>
					<input type="submit" name="addFeedback" value="Add feedback">
				</form>
				
				<?php 
				if (isset($_POST['addFeedback']))
					{
						$feedback = secure($_POST["feedbackContent"]);
						if (insertFeedback($ID, $UserID, $feedback))
						{
							header("Location: experiment.php?id=" . $ID);
						}
						else
						{
							echo "Error adding the feedback";
						}
							
					}
				?>
				<hr>
				<?php getFeedback($ID); ?>	
					
			</div>
	    </main>
	</body>
</html>