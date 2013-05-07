<?php /* Smarty version Smarty-3.1.8, created on 2013-05-06 17:04:53
         compiled from "C:/Program Files/Zend/Apache2/htdocs/wings/Templates/FrontEnd\default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3255851878225aea407-30447938%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f94e16f1ac0d798cfad1e6b7653fe73eee576e0' => 
    array (
      0 => 'C:/Program Files/Zend/Apache2/htdocs/wings/Templates/FrontEnd\\default.tpl',
      1 => 1367845490,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3255851878225aea407-30447938',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51878225e2aac5_36748224',
  'variables' => 
  array (
    'contentTPL' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51878225e2aac5_36748224')) {function content_51878225e2aac5_36748224($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	
	<link rel="stylesheet" type="text/css" href="/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
	
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript">window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>')</script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script type="text/javascript">$('body').mouse || document.write('<script src="/js/jquery-ui.min.js"><\/script>')</script>
	<script async type="text/javascript" src="/js/main.js"></script>
	
    <title>Arhangel31337</title>
</head>
<body>
<?php if (isset($_smarty_tpl->tpl_vars['contentTPL']->value)){?>
<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['contentTPL']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }elseif(isset($_smarty_tpl->tpl_vars['content']->value)){?>
<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }?>
</body>
</html><?php }} ?>