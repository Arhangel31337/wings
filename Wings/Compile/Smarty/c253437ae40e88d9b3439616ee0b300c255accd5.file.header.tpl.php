<?php /* Smarty version Smarty-3.1.8, created on 2012-06-20 12:44:52
         compiled from "/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Main/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18729673744fc2035ec72ad1-31732970%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c253437ae40e88d9b3439616ee0b300c255accd5' => 
    array (
      0 => '/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Main/header.tpl',
      1 => 1340181889,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18729673744fc2035ec72ad1-31732970',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fc2035ec81591_19768049',
  'variables' => 
  array (
    'genres' => 0,
    'genre' => 0,
    'partys' => 0,
    'party' => 0,
    'words' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fc2035ec81591_19768049')) {function content_4fc2035ec81591_19768049($_smarty_tpl) {?>		<header>
            <nav>
                <div class="headerLogo">
                    <a href="/"></a>
                </div>
                <ul class="menuTop">
                    <li><a selmenu="main" href="/"><span>в прокате</a></span></li>
                    <li><a selmenu="films" href="/films/"><span>фильмотека</a></span></li>
                    <li><a selmenu="soon" href="/soon/"><span>скоро</a></span></li>
                    <li><a selmenu="info" href="/social/top/"><span>информация</a></span></li>
                    <li><a selmenu="prof" href="/professional/"><span>профи</a></span></li>
                    <li><a selmenu="login" href="#">вход</a></li>
                    <li><a selmenu="search" href="#">поиск</a></li>
                </ul>
            </nav>
            <div class="clear"></div>
            <div class="dropDownMenu" id="main"> <!--main-->
                <div class="label">жанр:</div>
                <ul dropdown="genre">
<?php  $_smarty_tpl->tpl_vars['genre'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['genre']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['genres']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['genre']->key => $_smarty_tpl->tpl_vars['genre']->value){
$_smarty_tpl->tpl_vars['genre']->_loop = true;
?>
                    <li><?php echo $_smarty_tpl->tpl_vars['genre']->value['genreName'];?>
</li>
<?php } ?>
                </ul>                           
                <div class="label">с кем:</div>
                <ul dropdown="whoGo">
<?php  $_smarty_tpl->tpl_vars['party'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['party']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['partys']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['party']->key => $_smarty_tpl->tpl_vars['party']->value){
$_smarty_tpl->tpl_vars['party']->_loop = true;
?>
                    <li><?php echo $_smarty_tpl->tpl_vars['party']->value['partyName'];?>
</li>
<?php } ?>
				</ul>
                <div class="link">
                	<a href="#">выбрать кинотеатр</a>
                    <div class="arSelect" style="display:none;"></div>
               	</div>
                <div class="date">
                    <div class="left"><a href="#"></a></div>
                    <div class="right"><a href="#"></a></div>
                    <div class="wrapWeek">
                        <article class="today">
                            <div class="line"></div>
                            <div class="numberDay">28</div>
                            <div class="moonToday">
                                <p class="p1">сегодня</p>
                                <p>марта</p>
                            </div>
                        </article>
                        <article class="day">
                            <div class="week active">вс
                                <p class="numberWeek">29</p>
                            </div>
                        </article>
                        <article class="day">
                            <div class="week">пн
                            	<p class="numberWeek">30</p>
                            </div>
                        </article>
                        <article class="day">
                            <div class="week">вт
                            	<p class="numberWeek">31</p>
                            </div>
                        </article>
                        <article class="day">
                            <div class="week">ср
                            	<p class="numberWeek">01</p>
                            </div>
                        </article>
                        <article class="day">
                            <div class="week">чт
                            	<p class="numberWeek">02</p>
                            </div>
                        </article>
                        <article class="day">
                            <div class="week">пт
                                <p class="numberWeek">03</p>
                            </div>
                        </article>
                    </div>
                </div>
                
               
                
                <div class="selectCinema"><!--selectCinema-->
					<div class="cityCinema">
					  <span>(Москва)</span>
					  <a href="#">выбрать город</a>
					</div>
					<div class="locationCinema">
					  <a href="#">мое место нахождения</a>
					</div>
					<div class="clear"></div>
					<div style="padding:0 15px 0 20px;">
						<div class="label">метро:</div> 
						<ul dropdown="metro">
							<li>Крылатское</li>
							<li>Крылатское</li>
							<li>Крылатское</li>
						</ul>                          
						<div class="label">ТЦ:</div> 
						<ul dropdown="TC">
							<li>Матрица</li>
							<li>Матрица</li>
							<li>Матрица</li>
						</ul>                          
						<div class="label">ул:</div> 
						<ul dropdown="street">
							<li>Осенний бул</li>
							<li>Осенний бул</li>
							<li>Осенний бул</li>
						</ul>                         
						<div class="label">сеть:</div>
						<ul dropdown="net">
							<li>Каро Фильм</li>
							<li>Каро Фильм</li>
							<li>Каро Фильм</li>
						</ul>                                            
						<div class="slidCinema">
							<a href="#" style="float:left;">карта</a>
							<a href="#" style="float:right;">список</a>
							<div class="onSlidCinema">
								<div class="offSlidCinema" style="float:right;"></div>
							</div>
							
						</div>
						<div class="clear"></div>
					</div> 
                    
                    <div class="divMaps"></div>
                       
<?php echo $_smarty_tpl->getSubTemplate ("Ajax/CinemaTable.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
             
				</div> <!--selectCinema-->
                  
           </div><!--main-->  
            
            
            
            
            
            
            
            
            <div class="dropDownMenu" id="films"> <!--films-->
                <div class="label">жанр:</div>
                <ul dropdown="genre">
<?php  $_smarty_tpl->tpl_vars['genre'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['genre']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['genres']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['genre']->key => $_smarty_tpl->tpl_vars['genre']->value){
$_smarty_tpl->tpl_vars['genre']->_loop = true;
?>
                    <li><?php echo $_smarty_tpl->tpl_vars['genre']->value['genreName'];?>
</li>
<?php } ?>
                </ul>                           
                <div class="label">с кем:</div>
                <ul dropdown="whoGo">
<?php  $_smarty_tpl->tpl_vars['party'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['party']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['partys']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['party']->key => $_smarty_tpl->tpl_vars['party']->value){
$_smarty_tpl->tpl_vars['party']->_loop = true;
?>
                    <li><?php echo $_smarty_tpl->tpl_vars['party']->value['partyName'];?>
</li>
<?php } ?>
                </ul> 
                <div class="link"><span>рейтинг:</span></div>
                <div class="rating">
                    <div class="starSmall">
                        <div class="starSmallCur" style="width:100%;"></div>
                    </div>
                    <div class="ratingSlid">
                        <div class="ratingSlidCur" style="width:100%;"></div>
                        <a class="ratingSlidHandle" href="#"></a>
                    </div>
                </div>
                <div class="link">
                	<a href="#">выбрать актеров</a>
                    <div class="arSelect" style="display:none;"></div>
                </div>
                <div class="label">премии:</div>                        
                 <ul dropdown="award">
                  	<li>оскар2</li>
                    <li>оскар3</li>
                    <li>оскар4</li>
                </ul>
				
				
				
				
				<div class="selectCinema"><!--selectCinema-->
					<div class="filmsLang">
                    	<div class="langEng">
                        	<a href="#">a</a>
                            <a href="#">b</a>
                            <a href="#">c</a>
                            <a href="#">d</a>
                            <a href="#">e</a>
                            <a href="#">f</a>
                            <a href="#" class="noCol">g</a>
                            <a href="#">h</a>
                            <a href="#">i</a>
                            <a href="#" class="noCol">j</a>
                            <a href="#">k</a>
                            <a href="#">l</a>
                            <a href="#">m</a>
                            <a href="#">n</a>
                            <a href="#">o</a>
                            <a href="#">p</a>
                            <a href="#" class="noCol">q</a>
                            <a href="#">r</a>
                            <a href="#">s</a>
                            <a href="#">t</a>
                            <a href="#" class="noCol">u</a>
                            <a href="#" class="noCol">x</a>
                            <a href="#">y</a>
                            <a href="#">z</a>
                        </div>
                        <div class="langRus" style="display:none;">
                        	<a href="#">а</a>
                            <a href="#">б</a>
                            <a href="#">в</a>
                            <a href="#">г</a>
                            <a href="#">д</a>
                            <a href="#">е</a>
                            <a href="#" class="noCol">ж</a>
                            <a href="#">з</a>
                            <a href="#">и</a>
                            <a href="#" class="noCol">к</a>
                            <a href="#">л</a>
                            <a href="#">м</a>
                            <a href="#">н</a>
                            <a href="#">о</a>
                            <a href="#">п</a>
                            <a href="#">р</a>
                            <a href="#" class="noCol">с</a>
                            <a href="#">т</a>
                            <a href="#">у</a>
                            <a href="#">ф</a>
                            <a href="#" class="noCol">х</a>
                            <a href="#" class="noCol">ц</a>
                            <a href="#">ч</a>
                            <a href="#">ш</a>
                            <a href="#">щ</a>
                            <a href="#">э</a>
                            <a href="#">ю</a>
                            <a href="#">я</a>
                        </div>   
                        <div class="slidCinema scRight">
                            <a style="float:left;" href="#">рус</a>
                            <a style="float:right;" href="#">eng</a>
                            <div class="onSlidCinema">
                                <div class="offSlidCinema" style="float:right;"></div>
                            </div>
                        </div>
                        <div class="searchLang">
                            <form action="">
                                <input type="text" value="" name="" defaultvalue="" />
                                <button type="submit" name="" value="">
                                    <img src="/images/search.png">
                                </button>
                            </form>
                         </div>
                        
                        <div class="clear"></div>
                    </div>
                    
                    
                     
					<div class="divCinema"><!--divCinema-->
						<div class="jorange-scroll-pane">
							<table class="jorange-scroll-content tableCinema" border="0">
                            	<col width="80" />
                                <col width="310" />
                                <col width="290" />
                                <col width="120" />
                                <col width="120" />
								<tr class="even">
									<td class="like active"></td>
									<td><a href="#">Одед Фер (Oded Fehr)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:70%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>768</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:40%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr>
									<td width="75" class="like active"></td>
									<td><a href="#">Олег Тактаров (Oleg Taktarov)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:20%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>54</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:70%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr class="even">
									<td class="like active"></td>
									<td><a href="#">Оливер Джексон-Коэн (Oliver Jackson-Cohen)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:44%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>1254</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:20%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr>
									<td class="like active"></td>
									<td><a href="#">Оливер Платт (Oliver Platt)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:70%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>458</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:46%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr class="even">
									<td class="like"></td>
									<td><a href="#">Оливер Рид (Oliver Reed)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:88%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>241</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:90%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr>
									<td class="like active"></td>
									<td><a href="#">Оливье Грюнер (Olivier Gruner)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:45%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>61</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:5%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr class="even">
									<td class="like"></td>
									<td><a href="#">Оливье Мартинес (Olivier Martinez)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:15%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>594</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:34%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr>
									<td class="like"></td>
									<td><a href="#">Омар Эппс (Omar Epps)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:40%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>816</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:40%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr class="even">
									<td class="like"></td>
									<td><a href="#">Одед Фер (Oded Fehr)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:50%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>768</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:77%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr>
									<td class="like"></td>
									<td><a href="#">Олег Тактаров (Oleg Taktarov)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:20%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>54</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:60%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr class="even">
									<td class="like"></td>
									<td><a href="#">Оливер Джексон-Коэн (Oliver Jackson-Cohen)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:70%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>1254</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:80%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr>
									<td class="like"></td>
									<td><a href="#">Оливер Платт (Oliver Platt)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:10%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>458</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:33%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr class="even">
									<td class="like"></td>
									<td><a href="#">Оливер Рид (Oliver Reed)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:90%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>241</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:70%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr>
									<td class="like"></td>
									<td><a href="#">Оливье Грюнер (Olivier Gruner)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:40%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>61</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:40%;"></div>
                                        </div>
                                    </td>
								</tr>
								<tr class="even">
									<td class="like"></td>
									<td><a href="#">Оливье Мартинес (Olivier Martinez)</a></td>
									<td>
                                    	<div class="info">
                                        	<span class="rat">рейтинг:</span>
                                        	<div class="star">
                                        		<div class="starCur" style="width:30%;"></div>
                                        	</div>
                                        </div>
                                    </td>
									<td>
                                    	<div class="comments">
                                       		<p>451</p>
                                        </div>
                                    </td>
									<td>
                                    	<div class="batteryLeft marg2">
                                        	<div class="batteryCur" style="width:10%;"></div>
                                        </div>
                                    </td>
								</tr>
							</table>
						</div>
						<div class="scroll-bar-wrap ui-widget-content ui-corner-bottom">
							<div class="scroll-bar"></div>
						</div>                 
					</div><!--divCinema-->                
				</div> <!--selectCinema-->
            </div><!--films-->
			
			
			
			
            <div class="dropDownMenu" id="soon"> <!--soon-->
                <div class="label">год:</div>
                <div class="date" style="margin-left:0px; width:160px;">
                    <div class="left"><a href="#"></a></div>
                    <div class="right"><a href="#"></a></div>
                    <div class="wrapYear">
                        <article class="year">
                            <div class="line"></div>
                            <div class="numberYear">2012</div>
                        </article>
                    </div>
                </div>
                <div class="label">месяц:</div>
                <article class="month">
                    <div class="nameMonth notActive">январь
                        <p class="numberMouth notActive">01</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">февраль
                        <p class="numberMouth">02</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">март
                        <p class="numberMouth">03</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">апрель
                        <p class="numberMouth">04</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth active">май
                        <p class="numberMouth">05</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">июнь
                        <p class="numberMouth">06</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">июль
                        <p class="numberMouth">07</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">август
                        <p class="numberMouth">08</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">сентябрь
                        <p class="numberMouth">09</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">октябрь
                        <p class="numberMouth">10</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">ноябрь
                        <p class="numberMouth">11</p>
                    </div>
                </article>
                <article class="month">
                    <div class="nameMonth">декабрь
                        <p class="numberMouth">12</p>
                    </div>
                </article>
            </div><!--soon-->
            <div class="dropDownMenu" id="info"> <!--info-->
				<div class="switchGroup">
					<div class="label">статьи:</div>
					<div class="slidCinema">
						<a style="float:left;" href="#">top</a>
						<a style="float:right;" href="#">новые</a>
						<div class="onSlidCinema">
							<div style="float:right;" class="offSlidCinema"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="switchGroup">
					<div class="label">рецензии:</div>
					<div class="slidCinema">
						<a style="float:left;" href="#">top</a>
						<a style="float:right;" href="#">новые</a>
						<div class="onSlidCinema">
							<div style="float:right;" class="offSlidCinema"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="switchGroup">
					<div class="label">комментарии:</div>
					<div class="slidCinema">
						<a style="float:left;" href="#">top</a>
						<a style="float:right;" href="#">новые</a>
						<div class="onSlidCinema">
							<div style="float:right;" class="offSlidCinema"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
            </div><!--info-->
            <div class="dropDownMenu" id="prof"> <!--prof-->
            	
            </div><!--prof-->
            <div class="dropDownMenu" id="login"> <!--login-->
            	<form action="" method="POST">
                    <input class="eMail" defaultValue="<?php echo $_smarty_tpl->tpl_vars['words']->value['mail'];?>
" type="text" value="" name="mail" />
                    <input class="login" defaultValue="<?php echo $_smarty_tpl->tpl_vars['words']->value['pass'];?>
" type="password" value="" name="password" />
                    <button class="butAdit" value="" name="login" type="submit"><img src="/images/adit.png" /></button>
                    <div class="remember">
                        <span>запомнить меня</span>
                        <div class="offOn">
                            <a style="float:right;" href="#"></a>
                            <input type="hidden" />
                        </div>
                        <a href="#">восстановление пароля</a>
                    </div>
                </form>
            </div><!--login-->
            <div class="dropDownMenu" id="search"> <!--search-->
            	<form action="">
                    <input class="search" defaultValue="поиск:" type="text" name="" value="" />
                    <button class="butSearch" value="" name="" type="submit"><img src="/images/search.png" /></button>
                </form>
            </div><!--search-->
        </header><?php }} ?>