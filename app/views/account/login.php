<div class="d-flex a-center" style="">
<center>
<?php if (isset($error)) echo $error; ?>

<h3>Вход</h3>
<form method="post">
	<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'] ?>" />

	<input type="text" name="name" placeholder="Имя или почта" /><br/>
	<input type="password" name="password" placeholder="Пароль" /><br/>
	<input type="checkbox" name="stay" /> Оставаться в системе<br/>
	<br/><input type="submit" value="Вход" /><br/>

	<br/><a href="#">Забыли пароль?</a><br/>
</form>
</center>
</div>
