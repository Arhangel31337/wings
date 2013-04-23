<?php /* Smarty version Smarty-3.1.8, created on 2012-06-20 12:50:10
         compiled from "/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Ajax/CinemaTable.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5321870524fe18d848473e6-74094352%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a93a5270c7fe070f89dcef2d0715cdc5c6dc330d' => 
    array (
      0 => '/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Ajax/CinemaTable.tpl',
      1 => 1340182206,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5321870524fe18d848473e6-74094352',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fe18d84865351_93400873',
  'variables' => 
  array (
    'cinemas' => 0,
    'key' => 0,
    'cinema' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fe18d84865351_93400873')) {function content_4fe18d84865351_93400873($_smarty_tpl) {?>					<div class="divCinema"><!--divCinema-->
						<div class="jorange-scroll-pane">
							<table class="jorange-scroll-content tableCinema" border="0">
                            	<col width="75" />
                                <col width="255" />
                                <col width="265" />
                                <col width="220" />
                                <col width="109" />
								<tr class="even">
									<th></th>
									<th>кинотеатр</th>
									<th>адрес</th>
									<th>метро</th>
									<th>рейтинг</th>
								</tr>
<?php  $_smarty_tpl->tpl_vars['cinema'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cinema']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cinemas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cinema']->key => $_smarty_tpl->tpl_vars['cinema']->value){
$_smarty_tpl->tpl_vars['cinema']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cinema']->key;
?>
								<tr<?php if (($_smarty_tpl->tpl_vars['key']->value%2)){?> class="even"<?php }?>>
									<td class="like"></td>
									<td class="theater"><a href="#"><?php echo $_smarty_tpl->tpl_vars['cinema']->value['cinemaName'];?>
</a></td>
									<td class="address"><?php echo $_smarty_tpl->tpl_vars['cinema']->value['cinemaAddress'];?>
</td>
									<td class="metro"><?php echo $_smarty_tpl->tpl_vars['cinema']->value['cinemaMetro'];?>
</td>
									<td>
										<div class="starSmall" style="width:50px;">
											<div class="starSmallCur" style="width:<?php echo $_smarty_tpl->tpl_vars['cinema']->value['cinemaReit'];?>
%;"></div>
										</div>
									</td>
								</tr>
<?php } ?>
							</table>
						</div>
						<div class="scroll-bar-wrap ui-widget-content ui-corner-bottom">
							<div class="scroll-bar"></div>
						</div>                 
					</div><!--divCinema-->   <?php }} ?>