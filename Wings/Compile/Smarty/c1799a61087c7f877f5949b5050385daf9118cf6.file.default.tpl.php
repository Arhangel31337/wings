<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-27 11:50:23
         compiled from "C:\Program Files (x86)\Zend\Apache24\htdocs\wings\Templates\BackEnd\default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18621697585a1bd1cf888833-04418525%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1799a61087c7f877f5949b5050385daf9118cf6' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache24\\htdocs\\wings\\Templates\\BackEnd\\default.tpl',
      1 => 1510912343,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18621697585a1bd1cf888833-04418525',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pages' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1bd1cf89fd09_48856301',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1bd1cf89fd09_48856301')) {function content_5a1bd1cf89fd09_48856301($_smarty_tpl) {?><!DOCTYPE html>
<html>
<?php echo $_smarty_tpl->getSubTemplate ("head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<body>
	<div class="popup">
		<section class="blockInCenter">
			<h3></h3>
			<article></article>
			<input class="fl-r" type="button" value="" />
			<div class="cl-b"></div>
		</section>
	</div>
	<aside>
		<header>
			<a class="logo" href="/ru-ru/admin/">Wings</a>
			<div class="user">
				<div class="select">
					<div class="name">Arhangel31337</div>
					<div class="arrow"></div>
				</div>
				<ul>
					<li>
						<a class="icon settings" href="#">Настройки</a>
					</li>
					<li>
						<a class="icon exit" href="?logout">Выход</a>
					</li>
				</ul>
			</div>
		</header>
		<nav>
<?php echo $_smarty_tpl->getSubTemplate ("menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('nodes'=>$_smarty_tpl->tpl_vars['pages']->value[0]['childrens']), 0);?>

		</nav>
	</aside>
	<section>
		<article class="page1" page="1">
			<div class="background">
				<div class="cssload-loader progress blockInCenter">
					<div class="cssload-inner cssload-one"></div>
					<div class="cssload-inner cssload-two"></div>
					<div class="cssload-inner cssload-three"></div>
				</div>
				<div class="cl-b"></div>
			</div>
			<section></section>
		</article>
		<article class="page2" page="2">
			<div class="background">
				<div class="cssload-loader progress blockInCenter">
					<div class="cssload-inner cssload-one"></div>
					<div class="cssload-inner cssload-two"></div>
					<div class="cssload-inner cssload-three"></div>
				</div>
				<div class="cl-b"></div>
			</div>
			<section></section>
		</article>
		<article class="page3" page="3">
			<div class="background">
				<div class="cssload-loader progress blockInCenter">
					<div class="cssload-inner cssload-one"></div>
					<div class="cssload-inner cssload-two"></div>
					<div class="cssload-inner cssload-three"></div>
				</div>
				<div class="cl-b"></div>
			</div>
			<section></section>
		</article>
	</section>
</body>
</html><?php }} ?>
