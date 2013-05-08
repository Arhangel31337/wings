<?php /* Smarty version Smarty-3.1.8, created on 2013-05-08 14:21:05
         compiled from "C:/Program Files (x86)/Zend/Apache2/htdocs/wings/Templates/BackEnd\error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10225518a27115dfe55-97933501%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ebaf66b9a07f8b4c6deebf5c14c09a8e95493de6' => 
    array (
      0 => 'C:/Program Files (x86)/Zend/Apache2/htdocs/wings/Templates/BackEnd\\error.tpl',
      1 => 1367930888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10225518a27115dfe55-97933501',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_518a27115ee685_00424198',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_518a27115ee685_00424198')) {function content_518a27115ee685_00424198($_smarty_tpl) {?><div class="page_error"><span>Ошибка <?php echo $_smarty_tpl->tpl_vars['error']->value['number'];?>
<?php if (isset($_smarty_tpl->tpl_vars['error']->value['message'])){?>:</span> <?php echo $_smarty_tpl->tpl_vars['error']->value['message'];?>
<?php }else{ ?>.</span><?php }?></div><?php }} ?>