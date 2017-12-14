<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-27 11:50:15
         compiled from "C:\Program Files (x86)\Zend\Apache24\htdocs\wings\Templates\BackEnd\auth.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13638724185a1bd1c76e4f40-96761934%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b550e4d724aa028c3122b21379071fe79464c90f' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache24\\htdocs\\wings\\Templates\\BackEnd\\auth.tpl',
      1 => 1504690849,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13638724185a1bd1c76e4f40-96761934',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1bd1c774c816_34232839',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1bd1c774c816_34232839')) {function content_5a1bd1c774c816_34232839($_smarty_tpl) {?><!DOCTYPE html>
<html>
<?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
				<div class="cl-b"></div>
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
</html><?php }} ?>
