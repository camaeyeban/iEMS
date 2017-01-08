<html lang="en">

	<head>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
		<script type="text/javascript" src="assets/js/materialize.min.js"></script>
		<script>
			$('.datepicker').pickadate({
				selectMonths: true, // Creates a dropdown to control month
				selectYears: 15 // Creates a dropdown of 15 years to control year
			});
		</script>
	</head>
	<body>
		<form action="#">
			<p>
				<input type="checkbox" class="filled-in" id="filled-in-box" />
				<label for="filled-in-box">Filled in</label>
			</p>
			
      <input name="group1" type="radio" id="test2" />
      <label for="test2">Yellow</label>
			<!--<input type="date" class="datepicker"> -->
		</form>
	</body>
</html>