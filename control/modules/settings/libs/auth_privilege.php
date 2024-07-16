<?
	$project_name = PROJECTNAME;
	if(base64_decode($_SESSION['role']) != 1){ echo "<script>alert('Access Denied!');document.location.href='.?$project_name=Control Panel'</script>"; }
?>