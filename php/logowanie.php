	<form method="post" action="index.php?strona=<?=htmlentities($strona)?>">
		<h2>Logowanie</h2>
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Użytkownik" name="login" id="login" />
		</div>
			
		<div class="form-group">
			<input type="password" class="form-control" placeholder="Hasło" name="pass" id="pass" />
		</div>
			
		<div class="form-group">
			<button type="submit" class="btn btn-default" name="btn-save" id="btn-submit"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Zaloguj się</button> 
		</div>  
	 </form>
<?php
if($sesja->getError()) {
	echo '<div class="alert alert-danger">'.$sesja->getError().'</div>';
}
?>
