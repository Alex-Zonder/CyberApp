<!DOCTYPE html>
<html>
<head>
	<?php /* Head */ ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title; ?></title>

	<?php /*   Scripts   */ ?>
	<script src="/public/scripts/useragent.js"></script>
	<script src="/public/scripts/json.js"></script>
	<script src="/public/scripts/fullscreen.js"></script>

	<?php /*   Template   */ ?>
	<link rel="stylesheet" type="text/css" href="/public/templates/default/main.css" />
	<script src="/public/templates/default/main.js"></script>
</head>
<body>
	<?php /*   Header   */ ?>
	<div class='header'>
		<div class='float_left'>Меню</div>
		<div class='float_right'>
			<?php if (isset($user['name'])): ?>
				<?php echo $user['name']; ?>
				| <a href="/account/logout">Выход</a>
			<?php else: ?>
				<a href="/account/login">Вход</a>
			<?php endif; ?>
		</div>
		<div class='float_clear'></div>
	</div>

	<?php /*   Left Menu   */ ?>
	<div class='left_menu'>
		<a href="/">Главная</a>
		<?php if (isset($user['name'])): ?>
			<?php if (isset($user['group']) && $user['group'] == 'admin'): ?>
				<br><a href="/admin/">Админ</a>
			<?php endif; ?>
			<br><a href="/account/settings">Настройки</a>
			<br><a href="/account/logout">Выход</a>
		<?php else: ?>
			<br><a href="/account/login">Вход</a>
		<?php endif; ?>
	</div>

	<?php /*   Content   */ ?>
	<div class='content'>
		<?php echo $content; ?>
	</div>

	<?php /*   Footer   */ ?>
	<div class='float_clear'></div>
	<div class='footer'>
		<p style="text-align: center; margin: 5px 0;">
			&copy; Киберлайт <?php echo date("Y");?> | Все права защищены.
			<br>Тел.: <a href="tel:+7(495)507-9111">+7 (495) 507-9111</a>, E-mail: <a href="mailto:cyber-light@bk.ru">cyber-light@bk.ru</a>
		</p>
	</div>
</body>
</html>
