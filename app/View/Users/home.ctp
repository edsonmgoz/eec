<?php
if ($logged_in)
{?>
	<h2>Bienvenido <?php echo $current_user['role'] ." ".$current_user['username']; ?> </h2>
<?php
}
?>