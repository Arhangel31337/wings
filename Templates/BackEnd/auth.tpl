<!DOCTYPE html>
<html>
{include file="head.tpl"}
<body>
	<div class="authtorize card blockInCenter">
		<div class="background" style="display: none;">
			<div class="cssload-loader progress blockInCenter">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
			<div class="cl-b"></div>
		</div>
		<h3>Авторизация</h3>
		<form>
			<div id="login">
				<div class="input">
					<input name="mail" placeholder="Логин или e-mail" type="text" value="" />
					<div class="inputExtra">
						<div class="icon"></div>
						<div class="text"></div>
					</div>
					<div class="cl-b"></div>
				</div>
				<input class="fl-r" name="verifyLogin" type="button" value="Далее" />
				<div class="cl-b"></div>
			</div>
			<div id="password" style="display: none;">
				<p class="ta-c userName"></p>
				<div class="input">
					<input name="password" placeholder="Пароль" type="password" value="" />
					<div class="inputExtra">
						<div class="icon"></div>
						<div class="text"></div>
					</div>
					<div class="cl-b"></div>
				</div>
				<input class="fl-l" name="back" type="button" value="Назад" />
				<input class="fl-r" name="login" type="button" value="Войти" />
				<div class="cl-b"></div>
			</div>
		</form>
	</div>
</body>
</html>