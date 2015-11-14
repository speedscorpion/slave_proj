<!DOCTYPE html>
<html>
<head>
	<title>join game</title>
</head>
<body>
	<h1>welcome</h1>
	<input id="name" placeholder="please input" type="text" />
	<br/>
	<button id="start">let's rock</button>
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$("#start").click(function(){
				location.href="http://www.hereprovides.com/slave/index.php/Player/change/" + $("#name").val();
			});
		});
	</script>
</body>
</html>
