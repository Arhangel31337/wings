<?php /* Smarty version Smarty-3.1.8, created on 2013-05-07 17:38:09
         compiled from "C:/Program Files (x86)/Zend/Apache2/htdocs/wings/Templates/FrontEnd\error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12728518903c18bc0b9-90600919%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef0fa5c7dd35637423d32fe581d01719d403c0a9' => 
    array (
      0 => 'C:/Program Files (x86)/Zend/Apache2/htdocs/wings/Templates/FrontEnd\\error.tpl',
      1 => 1367930888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12728518903c18bc0b9-90600919',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_518903c18ec768_31266583',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_518903c18ec768_31266583')) {function content_518903c18ec768_31266583($_smarty_tpl) {?><div class="page_error"><span>Ошибка <?php echo $_smarty_tpl->tpl_vars['error']->value['number'];?>
<?php if (isset($_smarty_tpl->tpl_vars['error']->value['message'])){?>:</span> <?php echo $_smarty_tpl->tpl_vars['error']->value['message'];?>
<?php }else{ ?>.</span><?php }?></div><?php }} ?>