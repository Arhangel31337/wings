<?php /* Smarty version Smarty-3.1.8, created on 2013-05-01 19:06:54
         compiled from "C:/Program Files (x86)/Zend/Apache2/htdocs/wings//Templates/FrontEnd\error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94451812dc4d7a200-12217003%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82b83f3eda773fa6b139fd3d1d45fea95ff44deb' => 
    array (
      0 => 'C:/Program Files (x86)/Zend/Apache2/htdocs/wings//Templates/FrontEnd\\error.tpl',
      1 => 1367420810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94451812dc4d7a200-12217003',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51812dc4d94ee6_88607005',
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51812dc4d94ee6_88607005')) {function content_51812dc4d94ee6_88607005($_smarty_tpl) {?><div class="page_error"><span>Ошибка <?php echo $_smarty_tpl->tpl_vars['error']->value['number'];?>
<?php if (isset($_smarty_tpl->tpl_vars['error']->value['message'])){?>:</span> <?php echo $_smarty_tpl->tpl_vars['error']->value['message'];?>
<?php }else{ ?>.</span><?php }?></div><?php }} ?>