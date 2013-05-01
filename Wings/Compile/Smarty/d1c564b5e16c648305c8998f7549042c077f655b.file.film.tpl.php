<?php /* Smarty version Smarty-3.1.8, created on 2012-06-14 15:47:29
         compiled from "/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Main/film.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3860037194fc3446725d339-49559087%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1c564b5e16c648305c8998f7549042c077f655b' => 
    array (
      0 => '/home/webservers/alpha.vprokate.ru/www/Templates/FrontEnd/Main/film.tpl',
      1 => 1339674445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3860037194fc3446725d339-49559087',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fc3446725da74_77406057',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fc3446725da74_77406057')) {function content_4fc3446725da74_77406057($_smarty_tpl) {?>		<div class="content"> <!--begin content-->
        
        <nav block="paperFilm">
        
        	<div class="social">
            	<a href="#"></a>
                <div class="socialBlock">test</div>
            </div>
           
            <section class="person"><!--person-->
            	<img src="/images/samples/americanPiepr.jpg" alt="" />
                <div class="film-all-info">
                	<h3>Американский пирог: Все в сборе</h3>
                    <div class="info">
                    	<span class="rat">рейтинг:</span>
                    	<div class="star">
                    	<div class="starCur" style="width:70%;"></div>
                    	</div>
                    </div>
                    <div class="info-soc">
                        <div class="battery">
                            <div class="batteryCur" style="width:30%;"></div>
                        </div>
                        <div class="see"></div>
                        <div class="views">
                        	<div class="viewsOff"></div>
                            <p>1375</p>
                        </div>
                        <div class="comments">
                            <p>451</p>
                        </div>
                    </div>                  
                </div>
                <table class="tablePersone">
                	<tr>
                    	<td class="align">год</td>
                        <td><a href="#">2012</a></td>
                    </tr>
                    <tr>
                    	<td class="align">страна</td>
                        <td><a href="#">США</a></td>
                    </tr>
                    <tr>
                    	<td class="align">режиссер</td>
                        <td><a href="#">Джон Харвитц,</a> <a href="#"> Хейден Шлоссберг</a></td>
                    </tr>
                    <tr>
                    	<td class="align">жанр</td>
                        <td><a href="#">комедия</a></td>
                    </tr>
                </table>
                <div class="socialReting">
                	<div>
                        <div class="retingBg">19025</div>
                        <div><a class="a1" href="#"></a></div>
                    </div>
                    <div>
                        <div class="retingBg">456</div>
                        <div><a class="a2" href="#"></a></div>
                    </div>
                    <div>
                        <div class="retingBg">975</div>
                        <div><a class="a3" href="#"></a></div>
                    </div>
                </div>
            </section><!--person-->
            
            
            
<!--основная информация begin-->
                    
					<div class="informationDiv" id="watchFilm" style="display:none;">
                        <!--<a href="#" class="bannerDisk"></a>-->
                        <section class="cinema" style="margin:0;">    
                            <video  width="880" height="364" id="videoBlock" class="video-js vjs-default-skin" controls preload="none"
								poster="/images/samples/article-3sm-bg.jpg" data-setup="{}">
								<source src="/video/Men-in-Black-III.mp4" type='video/mp4' />
								<source src="/video/Men-in-Black-III.webm" type='video/webm' />
								<source src="/video/Men-in-Black-III.ogv" type='video/ogg' />
							</video>
							<map id="showTimes" name="showTimes">
								<area shape="poly" coords="0,0,60,0,146,87,146,140" href="#" alt="Расписание" />
							</map>
							<div class="player" style="display:none;">
								<div class="play">
									<div class="pause"></div>
								</div>
								<div class="back">
									<div class="timeLine">
										<div class="switch" style="left:25%;">00:13</div>
										<div class="loaded" style="width:60%;">
											<div class="revise" style="width:30%;"><div class="endRevise"></div></div>
											<div class="endLoaded"></div>
										</div>
									</div>
									<div class="volume"><div style="width:50%;"></div></div>
									<div class="hd"></div>
									<div class="fullScreen noScreen"></div>
								</div>
							</div>
							<div class="infoFilm">
								<div class="arInfoFilm"></div>
								<div class="genre">
									<p>фантастика, боевик, комедия, приключения</p>
								</div>
								<div class="nameFilm">
									<a href="/film/">Люди в черном 3</a>
								</div>
								<div class="info">
									<div class="star">
										<div style="width:95%;" class="starCur"></div>
									</div>
									<div class="battery">
										<div style="width:80%;" class="batteryCur"></div>
									</div>
									<div class="see"></div>
									<div class="views">
                                    	<div class="viewsOff"></div>
										<p>1375</p>
									</div>
									<div class="comments">
										<p>451</p>
									</div>
								</div> 
							</div>
                     	</section>
                    </div>
                    
<!--основная информация end-->


<!--слайдер Обои begin-->                        
         	<section class="slPerson" id="paperFilm" style="display: none;">
            	<div class="lPerson"><a href="#"></a></div>
            	<div class="rPerson"><a href="#"></a></div>
            	<div class="wrapPerson">
                	<div style="width:10000px;">
						<div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg4.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a>|
                                    <a href="#">1024&times;768</a>|<a href="#">800&times;600</a>
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg1.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a>|
                                    <a href="#">1024&times;768</a>
                                </div>
                         	</article>
                       	</div>
                        <div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg5.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a>|
                                    <a href="#">1024&times;768</a>|<a href="#">800&times;600</a>
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg2.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a>|
                                    <a href="#">1024&times;768</a>|<a href="#">800&times;600</a>
                                </div>
                         	</article>
                       	</div>
                        <div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg6.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a> 
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg3.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a>|
                                    <a href="#">1024&times;768</a>|<a href="#">800&times;600</a>
                                </div>
                         	</article>
                       	</div>
						<div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg5.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a>|
                                    <a href="#">1024&times;768</a>|<a href="#">800&times;600</a>
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg2.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a>|
                                    <a href="#">1024&times;768</a>|<a href="#">800&times;600</a>
                                </div>
                         	</article>
                       	</div>
                        <div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg6.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a> 
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg3.jpg" />
                                <div class="infoPer">
                                	<a href="#">1600&times;1200</a>|<a href="#">1280&times;960</a>|
                                    <a href="#">1024&times;768</a>|<a href="#">800&times;600</a>
                                </div>
                         	</article>
                       	</div>


                    </div>
             	</div>
          	</section>
<!--слайдер Обои end-->




<!--слайдер постеры begin-->                        
         	<section class="slPerson" id="postersFilm" style="display: none;">
            	<div class="lPerson"><a href="#"></a></div>
            	<div class="rPerson"><a href="#"></a></div>
            	<div class="wrapPerson">
                	<div style="width:10000px;">
						<div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/poster1.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/poster2.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>
                        <div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg5.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg2.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>
                        <div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/poster1.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a> 
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/poster2.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>
						<div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg5.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg2.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>
                        <div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg6.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a> 
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/filmImg3.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>


                    </div>
             	</div>
          	</section>
<!--слайдер постеры end-->




<!--слайдер скриншоты begin-->                        
         	<section class="slPerson" id="screenshotsFilm" style="display: none;">
            	<div class="lPerson"><a href="#"></a></div>
            	<div class="rPerson"><a href="#"></a></div>
            	<div class="wrapPerson">
                	<div style="width:10000px;">
						<div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/screen1.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/screen2.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>
                        <div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/screen3.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/screen4.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>
                        <div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/screen1.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a> 
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/screen2.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>
						<div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/screen3.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/screen4.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>
                        <div class="films">
                            <article class="previewFilms">
                            	<img src="/images/samples/screen1.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a> 
                                </div>
                         	</article>
                            <article class="previewFilms">
                            	<img src="/images/samples/screen2.jpg" />
                                <div class="infoPer">
                                	<a href="#">1280&times;960</a>
                                </div>
                         	</article>
                       	</div>


                    </div>
             	</div>
          	</section>
<!--слайдер скриншоты end-->
                        
                                                
                        
                        
 <!--блок информация о фильме begin-->                       
                       	<div class="informationDiv" id="infoFilm" style="display:none;">
							<div class="information">
                            	<div style="width:400px; height:inherit; padding:10px 0 0 25px; float:left;">
                                	<h6>Описание</h6>
                                    <p>Герои «Американского пирога» встречаются вновь спустя 10 лет. Они докажут, что даже время и 
                                    расстояние не в силах разрушить их дружбу. Летом 1999-го четверо мичиганских парней решили расстаться 
                                    с невинностью. Прошли годы, и теперь друзья вернулись домой уже повзрослевшими, чтобы вспомнить 
                                    прошлое и оторваться на полную катушку. <br /><br />Герои «Американского пирога» встречаются вновь спустя 10 лет. 
                                    Они докажут, что даже время и расстояние не в силах разрушить их дружбу. Летом 1999-го четверо мичиганских 
                                    парней решили расстаться с невинностью.</p>
                                    
                                    <div class="retPerson" style="padding:0;">
                                        <div class="info">
                                        	<h6>Рейтинг фильма:</h6>
                                            <div class="star">
                                                <div class="starCur" style="width:70%;"></div>
                                            </div>
                                            <a href="#">8,76</a>
                                            <span class="numFilm">768</span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <table class="tablePersone">
                                    <tr>
                                        <td class="align">слоган</td>
                                        <td><a href="#">&laquo;Самый лакомый кусочек на конец&raquo;</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">сценарий</td>
                                        <td><a href="#">Джон Харвитц, </a><a href="#">Хейден Шлоссберг, </a><a href="#">Адам Херц</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">продюсер</td>
                                        <td><a href="#">Крис Мур, </a><a href="#">Крейг Перри, </a><a href="#">Крис Вайц, ...</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">оператор</td>
                                        <td><a href="#">Дарин Окада</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">композитор</td>
                                        <td><a href="#">Лайл Уоркмэн</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">художник</td>
                                        <td><a href="#">Уильям Арнольд, </a><a href="#">Эллиотт Глик, </a><a href="#">Мона Мэй, ...</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">монтаж</td>
                                        <td><a href="#">Джефф Бетанкорт</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">бюджет</td>
                                        <td><a href="#">$50 000 000</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">сборы в США</td>
                                        <td><a href="#">$21 500 000</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">сборы в мире</td>
                                        <td><a href="#">+ $19 300 000 = $40 800 000</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">сборы в России</td>
                                        <td><a href="#">$5 100 000</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">премьера (мир)</td>
                                        <td><a href="#">4 апреля 2012, ...</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">премьера (РФ)</td>
                                        <td><a href="#">5 апреля 2012, «UPI»</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">релиз на DVD</td>
                                        <td><a href="#">9 августа 2012, «Двадцатый Век Фокс СНГ», ...</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">релиз на Blu-Ray</td>
                                        <td><a href="#">9 августа 2012, «Двадцатый Век Фокс СНГ», ...</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">рейтинг MPAA</td>
                                        <td><a href="#">лицам до 17 лет обязательно присутствие взрослого</a></td>
                                    </tr>
                                    <tr>
                                        <td class="align">время</td>
                                        <td><a href="#">113 мин. / 01:53</a></td>
                                    </tr>
                                </table>
                                
							</div>
                        </div>
                            
 <!--блок информация о фильме end-->
 
 
 
 
 <!--слайдер трейлеры begin-->               
			<section class="slPerson" id="trailerFilm" style="display:none;">
            	<div class="lPerson"><a href="#"></a></div>
            	<div class="rPerson"><a href="#"></a></div>
            	<div class="wrapPerson">
                	<div style="width:10000px;">
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
						<div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        
                        
					</div>
             	</div>
          	</section>      
<!--слайдер трейлеры end-->


 <!--слайдер трейлеры2 begin-->               
			<section class="slPerson" id="shootingFilm" style="display:none;">
            	<div class="lPerson"><a href="#"></a></div>
            	<div class="rPerson"><a href="#"></a></div>
            	<div class="wrapPerson">
                	<div style="width:10000px;">
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
						<div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        
                        
					</div>
             	</div>
          	</section>      
<!--слайдер трейлеры2 end-->



 <!--слайдер трейлеры3 begin-->               
			<section class="slPerson" id="promoFilm" style="display:none;">
            	<div class="lPerson"><a href="#"></a></div>
            	<div class="rPerson"><a href="#"></a></div>
            	<div class="wrapPerson">
                	<div style="width:10000px;">
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
						<div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        <div class="films">
                        	<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:10%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
							<article class="previewFilms">
								<img src="/images/samples/img1.jpg" width="287" poster="/images/samples/article-3sm-bg.jpg" mp4="/video/Men-in-Black-III.mp4" webm="/video/Men-in-Black-III.webm" ogv="/video/Men-in-Black-III.ogv" />
								<div class="infoFilmSlide">
									<div class="arInfoFilm"></div>
									<div class="nameFilm">
										<h5><a href="#">Лето. Одноклассники. Любовь (2012)</a></h5>
									</div>
									<div class="genre">
										<p>драма, мелодрама, комедия</p>
									</div>
									<div class="description">
											<a href="#">На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и 
											телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного. Молодой лондонский юрист 
											Артур Киппс вынужден оставить...</a>
									</div>
									<div class="starSmall marg">
											<div class="starSmallCur"  style="width:70%;"></div>
										</div>
									<div class="info">
										<div class="comments">
											<p>451</p>
										</div>
										<div class="views">
                                        	<div class="viewsOff"></div>
											<p>1375</p>
										</div>
										
										<div class="battery">
											<div class="batteryCur" style="width:90%;"></div>
										</div>
										<div class="noSee"></div>
									 
									</div> 
                            </div>
							</article>
                        </div>
                        
                        
					</div>
             	</div>
          	</section>      
<!--слайдер трейлеры3 end-->
                        
        </nav>                     
            
            
            <nav>
            	<ul class="munuBottom">
                	<li><a href="#" selmenu="watchFilm">информация</a></li>
                    <li><a href="#" selmenu="infoFilm">о картине</a></li>
                    <li><a href="#" selmenu="trailerFilm">трейлер</a></li>
                    <li><a href="#" selmenu="#">обсуждения</a></li>
                    <li><a href="#" selmenu="paperFilm">обои</a></li>
                    <li><a href="#" selmenu="postersFilm">постеры</a></li>
                    <li><a href="#" selmenu="screenshotsFilm">скриншоты</a></li>
                    <li><a href="#" selmenu="shootingFilm">съемки</a></li>
                    <li><a href="#" selmenu="promoFilm">промо</a></li>
                </ul>
            </nav>
       
		</div><!--content--><?php }} ?>