    </article>
    <aside class="col-sm-4 sidenav">
      <div class="well">
<?php
if(!$sesja->isLogged()) {
	include("logowanie.php");
} else {
	echo "<h2>Witaj <strong>".$sesja->getLogin()."</strong>!</h2>";
	echo '<div class="alert alert-info">';
	echo '<a href="index.php?strona='.htmlentities($strona).'&logout">Kliknij tutaj aby się wylogować.</a>';
	echo '</div>';
}
?>
      </div>
      <div class="well">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
      </div>
    </div>
  </div>
</div>

<footer class="container text-center">
	<p>Copyright © 2016 <strong>PAI</strong></p>
</footer>

</body>
</html>
