<?php /* Smarty version Smarty-3.1.8, created on 2012-06-20 17:38:55
         compiled from "/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Ajax/ShedulesTable.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15907446584fe1b5b4693409-25467081%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d75f9f6fca740fd684ac0d12d4ffc5cf30f4de8' => 
    array (
      0 => '/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Ajax/ShedulesTable.tpl',
      1 => 1340199508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15907446584fe1b5b4693409-25467081',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fe1b5b46cae80_21358474',
  'variables' => 
  array (
    'cinemas' => 0,
    'cinema' => 0,
    'event' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fe1b5b46cae80_21358474')) {function content_4fe1b5b46cae80_21358474($_smarty_tpl) {?>				<div class="vis-part jorange-scroll-pane">
<!--Start Ticket widget-->
<rb:rich key="64605e60-8a9a-4d24-b01d-e086b448fb9d" xmlns:rb="http://kassa.rambler.ru"></rb:rich>
<script type="text/javascript" src="http://s2.kassa.rl0.ru/widget/js/ticketmanager.js"></script>
<!--End Ticket widget-->
                	<table class="jorange-scroll-content" >
                    	<colgroup>
                        	<col width="35" />
                            <col width="35" />
                            <col width="245" />
                            <col width="490" />
                        </colgroup>
<?php  $_smarty_tpl->tpl_vars['cinema'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cinema']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cinemas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cinema']->key => $_smarty_tpl->tpl_vars['cinema']->value){
$_smarty_tpl->tpl_vars['cinema']->_loop = true;
?>
                		<tr>
                  			<td class="layer active"></td>
                  			<td class="like"></td>
                  			<td class="film"><?php echo $_smarty_tpl->tpl_vars['cinema']->value['cinemaName'];?>
</td>
                  			<td class="time">
	<?php  $_smarty_tpl->tpl_vars['event'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['event']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cinema']->value['events']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['event']->key => $_smarty_tpl->tpl_vars['event']->value){
$_smarty_tpl->tpl_vars['event']->_loop = true;
?>
		<?php if ($_smarty_tpl->tpl_vars['event']->value['status']=='going'){?>
                    			<a href="javascript:ticketManager.hallPlanV2(<?php echo $_smarty_tpl->tpl_vars['cinema']->value['cinemaID'];?>
,<?php echo $_smarty_tpl->tpl_vars['cinema']->value['movieID'];?>
,<?php echo $_smarty_tpl->tpl_vars['event']->value['ramblerTime'];?>
);"><?php echo $_smarty_tpl->tpl_vars['event']->value['time'];?>
</a>
		<?php }elseif($_smarty_tpl->tpl_vars['event']->value['status']=='start'){?>
								<span class="active"><?php echo $_smarty_tpl->tpl_vars['event']->value['time'];?>
</span>
		<?php }else{ ?>
								<span><?php echo $_smarty_tpl->tpl_vars['event']->value['time'];?>
</span>
		<?php }?>
	<?php } ?>
                  			</td>
                		</tr>
<?php } ?>
              		</table>
                </div>
				<div class="scroll-bar-wrap ui-widget-content ui-corner-bottom">
					<div class="scroll-bar"></div>
				</div><?php }} ?>