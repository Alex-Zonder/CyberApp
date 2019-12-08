<center>
<h3>Настройки пользователя</h3>

<hr>
<h3><?php echo $user['name']; ?></h3>
Id: <?php echo $user['id']; ?>
<br><?php echo $user['password']; ?>
<?php if (isset($user['email'])): ?>
	<br>Почта: <?php echo $user['email']; ?>
<?php endif; ?>




<hr>
<?php debug(session_id()); ?>
</center>



<hr>
<table>
	<tr>
		<td>Useragent</td>
		<td><?php echo($_SERVER["HTTP_USER_AGENT"]); ?></td>
	</tr>
	<tr>
		<td>User IP</td>
		<td><?php echo($_SERVER["REMOTE_ADDR"]); ?></td>
	</tr>
</table>

<?php
debug($_SERVER);
debug($_SERVER);
?>
