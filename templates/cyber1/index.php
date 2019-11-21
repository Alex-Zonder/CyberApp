<!DOCTYPE html>
<html>
<head>
	<?php /*                            Head                                  */ ?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $title; ?></title>

	<link rel="shortcut icon" href="/public/images/favicon/favicon.gif" type="image/x-gif">
	<link rel="apple-touch-icon" href="/public/images/favicon/iphone_icon.png">

	<?php /*   Scripts   */ ?>
	<script src="/public/scripts/useragent.js"></script>
	<script src="/public/scripts/json.js"></script>
	<script src="/public/scripts/fullscreen.js"></script>

	<?php /*                            Template                              */ ?>
	<link rel="stylesheet" type="text/css" href="/templates/cyber1/css/main.css" />
	<script src="/templates/cyber1/js/main.js"></script>
</head>
<body>
	<?php /*   Header   */ ?>
	<div class='header' id="syteHeader">
		<div class='float_left'><img src="/templates/cyber1/icons/menu.png" style="height:28px;"></div>
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

	<?php /*                           Left Menu                             */ ?>
	<div class='left_menu' id="syteLeftMenu">
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

	<?php /*                             Content                              */ ?>
	<div class='content' id="syteContent">
		<?php echo $content; ?>
	</div>

	<?php /*                             Footer                               */ ?>
	<div class='float_clear' id="syteFooter"></div>
	<div class='footer'>
		<p style="text-align: center; margin: 5px 0;">
			&copy; <a href="http://cyber-light.ru/" target="_blank">Киберлайт</a> <?php echo date("Y");?> | Все права защищены.
			<br>Тел.: <a href="tel:+7(495)507-9111">+7 (495) 507-9111</a>, E-mail: <a href="mailto:cyber-light@bk.ru">cyber-light@bk.ru</a>
		</p>
	</div>
</body>
</html>
