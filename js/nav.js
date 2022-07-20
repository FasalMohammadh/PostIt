function showUsers(event){
	$ajax({
		type:"POST",
		data:{text:event.value},
		url:"otherRes/search.php",
	}).done(function(result){
		
	})
}