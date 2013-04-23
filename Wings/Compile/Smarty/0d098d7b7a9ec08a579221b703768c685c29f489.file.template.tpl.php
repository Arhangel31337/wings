<?php /* Smarty version Smarty-3.1.8, created on 2012-06-01 16:11:40
         compiled from "/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Main/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9784316194fbc9002a02291-45096107%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d098d7b7a9ec08a579221b703768c685c29f489' => 
    array (
      0 => '/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Main/template.tpl',
      1 => 1338552689,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9784316194fbc9002a02291-45096107',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fbc9002a02c01_70432112',
  'variables' => 
  array (
    'tplContent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fbc9002a02c01_70432112')) {function content_4fbc9002a02c01_70432112($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ru">
<?php echo $_smarty_tpl->getSubTemplate ("Main/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  	<body style="background:url(/images/samples/mainBg1.jpg) center top no-repeat transparent;">
		<div class="conteiner">
<?php echo $_smarty_tpl->getSubTemplate ("Main/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

      <div class="clear"></div>
<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['tplContent']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="clear"></div>
<?php echo $_smarty_tpl->getSubTemplate ("Main/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="clear"></div>
		</div>   <!-- [ff] end conteiner -->
        
        <div class="blockAll"></div>
  	</body>
</html><?php }} ?>