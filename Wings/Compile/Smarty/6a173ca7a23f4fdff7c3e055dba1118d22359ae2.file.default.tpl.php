<?php /* Smarty version Smarty-3.1.8, created on 2013-05-08 14:21:05
         compiled from "C:/Program Files (x86)/Zend/Apache2/htdocs/wings/Templates/BackEnd\default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8787518a2711449792-84566164%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a173ca7a23f4fdff7c3e055dba1118d22359ae2' => 
    array (
      0 => 'C:/Program Files (x86)/Zend/Apache2/htdocs/wings/Templates/BackEnd\\default.tpl',
      1 => 1367930888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8787518a2711449792-84566164',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'contentTPL' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_518a27115c9014_14284436',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_518a27115c9014_14284436')) {function content_518a27115c9014_14284436($_smarty_tpl) {?><!DOCTYPE html>
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