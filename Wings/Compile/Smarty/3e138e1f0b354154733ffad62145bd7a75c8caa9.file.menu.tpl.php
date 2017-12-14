<?php /* Smarty version Smarty-3.1.21-dev, created on 2017-11-27 11:50:23
         compiled from "C:\Program Files (x86)\Zend\Apache24\htdocs\wings\Templates\BackEnd\menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21358140725a1bd1cf8eb602-43589723%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e138e1f0b354154733ffad62145bd7a75c8caa9' => 
    array (
      0 => 'C:\\Program Files (x86)\\Zend\\Apache24\\htdocs\\wings\\Templates\\BackEnd\\menu.tpl',
      1 => 1504690308,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21358140725a1bd1cf8eb602-43589723',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'nodes' => 0,
    'node' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5a1bd1cf9011f5_90439174',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a1bd1cf9011f5_90439174')) {function content_5a1bd1cf9011f5_90439174($_smarty_tpl) {?>			<ul>
<?php  $_smarty_tpl->tpl_vars['node'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['node']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['nodes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['node']->key => $_smarty_tpl->tpl_vars['node']->value) {
$_smarty_tpl->tpl_vars['node']->_loop = true;
?>
				<li>
					<a class="icon <?php echo $_smarty_tpl->tpl_vars['node']->value['alias'];?>
" href="#" page="1;<?php echo lcfirst($_smarty_tpl->tpl_vars['node']->value['mvc']);?>
;list"><?php echo $_smarty_tpl->tpl_vars['node']->value['name'];?>
</a>
	<?php if (isset($_smarty_tpl->tpl_vars['node']->value['childrens'])) {?>
		<?php echo $_smarty_tpl->getSubTemplate ("menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('nodes'=>$_smarty_tpl->tpl_vars['node']->value['childrens']), 0);?>

	<?php }?>
				</li>
<?php } ?>
			</ul>
<?php }} ?>
