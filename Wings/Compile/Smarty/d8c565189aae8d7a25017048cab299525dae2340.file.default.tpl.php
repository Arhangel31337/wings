<?php /* Smarty version Smarty-3.1.8, created on 2013-05-01 19:19:08
         compiled from "C:/Program Files (x86)/Zend/Apache2/htdocs/wings//Templates/FrontEnd\default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24284518117c7549f91-15018445%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8c565189aae8d7a25017048cab299525dae2340' => 
    array (
      0 => 'C:/Program Files (x86)/Zend/Apache2/htdocs/wings//Templates/FrontEnd\\default.tpl',
      1 => 1367421487,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24284518117c7549f91-15018445',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_518117c75b3c58_85750387',
  'variables' => 
  array (
    'contentTPL' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_518117c75b3c58_85750387')) {function content_518117c75b3c58_85750387($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	
	<link rel="stylesheet" type="text/css" href="/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<script src="/js/main.js"></script>
	
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