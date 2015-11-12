<!DOCTYPE html>
<html>
<head>
	<title>palace</title>
	<meta charset="utf-8"/>
</head>
<body>
	<h1>in my palace</h1>
	<hr/>
	<button id="go_jail">to jail</button>
	<button id="go_stand">to stand</button>
	<button id="neigborhood">neigborhood</button>
	<br/>
	<hr/>
	<div id="holder"></div>

	<script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
		$(function() {

			$("#go_stand").click(function(){

			});
			
			$("#go_jail").click(function(){

			});

			$("#neigborhood").click(function(){
				$.ajax({
					type: "get",
					url: "http://www.hereprovides.com/slave/index.php/User/nearby",
					dataType: "json",
					success: function(data){
						for(var item in data){
							var node = "<a href='" + item.id + "'>" + item.nickname + "</a>";
							$("#holder").append(node);
						}
					}
				});
			});
		});
	</script>
</body>
</html>