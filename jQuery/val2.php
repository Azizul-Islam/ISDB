
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" >
		<title>jQuery</title>
		
	</head>
	<body>
	<button>Go</button>
	<input type="text" name="txtId" id="txtId" />
	<div id="output"></div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
		$(function(){
			$('button').on("click",function(){
				$.ajax({
				url:'get_data.php?user_id=id',
				method:'get',
				let id=$('#txtId').val();
				$('#output').html(id);
				});
				
				
			});
		});
	</script>
	</body>
</html>