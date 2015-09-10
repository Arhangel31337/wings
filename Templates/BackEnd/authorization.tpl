<!DOCTYPE html>
<html>
{include file="head.tpl"}
<body>
	<div class="main">
		<header class="auth">
			<div class="menu">
				<div class="main-wrapper">
					<div class="logo"></div>
				</div>
			</div>
		</header>
		<div>
			<div class="main-wrapper">
				<form class="auth" method="post">
					<h1>Авторизация</h1>
					<dl>
						<dd class="login-field glyphicons user">
							<i></i>
							<input type="text" name="login" value="" placeholder="Логин" tabindex="0" required />
						</dd>
						<dd class="login-field glyphicons lock">
							<i></i>
							<input type="password" name="password" value="" placeholder="Пароль" tabindex="0" required />
						</dd>
						<dd>
{if !empty($errors)}
							<div class="error">
	{foreach from=$errors item=error}
								{$error}<br />
	{/foreach}
							</div>
{/if}
						</dd>
						<dd>
							<input class="fl-r" type="submit" name="logIn" value="Войти" placeholder="Войти" tabindex="0" />
						</dd>
					</dl>
					<div class="cl-b"></div>
				</form>
			</div>
		</div>
		<footer>
			<div class="copyright">© 2015 Arhangel31337</div>
		</footer>
	</div>
</body>
</html>