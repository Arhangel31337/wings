<?php /* Smarty version Smarty-3.1.8, created on 2012-05-21 15:53:15
         compiled from "/home/webservers/vprokate.ru/www/Templates/FrontEnd/Main/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15964194314fb0e90504d235-67670148%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17ba7e5a90ea6f1ecc7b0d1f1419bee441edae34' => 
    array (
      0 => '/home/webservers/vprokate.ru/www/Templates/FrontEnd/Main/template.tpl',
      1 => 1337601194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15964194314fb0e90504d235-67670148',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fb0e9051a5a98_19268825',
  'variables' => 
  array (
    'tplContent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fb0e9051a5a98_19268825')) {function content_4fb0e9051a5a98_19268825($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ru">
<?php echo $_smarty_tpl->getSubTemplate ("Main/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


  <body style="background-image:url(/images/main-bg1.jpg);">

    <div id="h-cont">

<?php echo $_smarty_tpl->getSubTemplate ("Main/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


      <div class="clear"></div>
<?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['tplContent']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="clear"></div>
<?php echo $_smarty_tpl->getSubTemplate ("Main/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div class="clear"></div>

    </div>   <!-- [ff] end #h-cont -->
  </body>
</html>


<?php }} ?>