<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-09-20 16:04:54
         compiled from "C:\Program Files (x86)\Zend\Apache24\htdocs\wings\Templates\BackEnd\head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153166904159afc184049163-28546523%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd9fae3c5e2ace6feb9c795091b2f1c7f42ff7a5' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache24\\htdocs\\wings\\Templates\\BackEnd\\head.tpl',
      1 => 1505912693,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153166904159afc184049163-28546523',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_59afc1841555a2_50744129',
  'variables' => 
  array (
    'charset' => 0,
    'meta' => 0,
    'key' => 0,
    'value' => 0,
    'page' => 0,
    'files' => 0,
    'css' => 0,
    'js' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59afc1841555a2_50744129')) {function content_59afc1841555a2_50744129($_smarty_tpl) {?><head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="<?php echo $_smarty_tpl->tpl_vars['charset']->value;?>
" />
	
	<meta name="viewport" content="width=1040px">
	
<?php if (isset($_smarty_tpl->tpl_vars['meta']->value)) {?>
	<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['meta']->value['httpEquiv']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
<meta http-equiv="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" content="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" />
	<?php } ?>
	
	<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['meta']->value['name']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
<meta name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" content="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" />
	<?php } ?>
<?php }?>
	
<?php if (isset($_smarty_tpl->tpl_vars['page']->value['pageDescription'])) {?>
	<meta name="Description" content="<?php echo $_smarty_tpl->tpl_vars['page']->value['pageDescription'];?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['page']->value['documentState'])) {?>
	<meta name="Document-state" content="<?php echo $_smarty_tpl->tpl_vars['page']->value['documentState'];?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['page']->value['pageKeywords'])) {?>
	<meta name="Keywords" content="<?php echo $_smarty_tpl->tpl_vars['page']->value['pageKeywords'];?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['page']->value['resourceType'])) {?>
	<meta name="Resource-type" content="<?php echo $_smarty_tpl->tpl_vars['page']->value['resourceType'];?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['page']->value['revisit'])) {?>
	<meta name="Revisit" content="<?php echo $_smarty_tpl->tpl_vars['page']->value['revisit'];?>
" />
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['page']->value['robots'])) {?>
	<meta name="Robots" content="<?php echo $_smarty_tpl->tpl_vars['page']->value['robots'];?>
" />
<?php }?>
	
<?php if (isset($_smarty_tpl->tpl_vars['page']->value['pageTitle'])) {?>
	<title><?php echo $_smarty_tpl->tpl_vars['page']->value['pageTitle'];?>
</title>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['files']->value['css'])&&!empty($_smarty_tpl->tpl_vars['files']->value['css'])) {?>	
	<?php  $_smarty_tpl->tpl_vars['css'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['css']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['files']->value['css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['css']->key => $_smarty_tpl->tpl_vars['css']->value) {
$_smarty_tpl->tpl_vars['css']->_loop = true;
?>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
" />
	<?php } ?>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['files']->value['js'])&&!empty($_smarty_tpl->tpl_vars['files']->value['css'])) {?>	
	<?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['files']->value['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value) {
$_smarty_tpl->tpl_vars['js']->_loop = true;
?>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js']->value['src'];?>
"<?php if ($_smarty_tpl->tpl_vars['js']->value['async']) {?> async<?php }?>><?php echo '</script'; ?>
>
	<?php } ?>
<?php }?>
	
</head><?php }} ?>
