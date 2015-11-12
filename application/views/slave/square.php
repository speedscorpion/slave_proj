<!DOCTYPE html>
<html>
<head>
	<title>square</title>
	<meta charset="utf-8"/>
</head>
<body>
	<h1>being slaved</h1>
	<hr>
	<button id="raise">miss home</button>
	<hr>
	<div id="holder"></div>
	<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#raise").click(function(){
				$.ajax({
					type: "get",
					url: "http://www.hereprovides.com/slave/index.php/Slave/raise",
					dataType: "text",
					success: function(data){
						if(data == "victory")
							location.href="http://www.hereprovides.com/slave/index.php/Slave/victory";
						else
							$("#holder").append(data);
					}
				});
			});
		});
	</script>
</body>
</html>