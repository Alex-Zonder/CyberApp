<center>
<h3>Настройки пользователя</h3>

<hr>
<h3><?php echo $user['name']; ?></h3>
Id: <?php echo $user['id']; ?>
<br><?php echo $user['password']; ?>
<?php if (isset($user['email'])): ?>
	<br>Почта: <?php echo $user['email']; ?>
<?php endif; ?>
</center>
