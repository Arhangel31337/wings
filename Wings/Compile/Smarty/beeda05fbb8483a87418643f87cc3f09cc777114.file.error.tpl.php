<?php /* Smarty version Smarty-3.1.8, created on 2013-05-06 14:12:53
         compiled from "C:/Program Files/Zend/Apache2/htdocs/wings/Templates/FrontEnd\error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3068251878225ef1511-37671033%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'beeda05fbb8483a87418643f87cc3f09cc777114' => 
    array (
      0 => 'C:/Program Files/Zend/Apache2/htdocs/wings/Templates/FrontEnd\\error.tpl',
      1 => 1367829589,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3068251878225ef1511-37671033',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51878225f19127_88114525',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51878225f19127_88114525')) {function content_51878225f19127_88114525($_smarty_tpl) {?><div class="page_error"><span>Ошибка <?php echo $_smarty_tpl->tpl_vars['error']->value['number'];?>
<?php if (isset($_smarty_tpl->tpl_vars['error']->value['message'])){?>:</span> <?php echo $_smarty_tpl->tpl_vars['error']->value['message'];?>
<?php }else{ ?>.</span><?php }?></div><?php }} ?>