<!DOCTYPE html>
<html>
<head>
	<title>stand</title>
	<meta charset="utf-8"/>
</head>
<body>
	<h1>my stand</h1>
	<hr>
	<button id="line_up">one line</button>

	<button id="suspect">suspect</button>
	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$.ajax("#line_up").click(function(){
				$.ajax({
					type: "get",
					url: "http://www.hereprovides.com/slave/index.php/Owner/asset",
					success: function(data){

					}
				});
			});
		});
	</script>
</body>
</html>