<?php /* Smarty version Smarty-3.1.8, created on 2012-05-05 04:38:25
         compiled from "/home/webservers/vprokate.ru/www//Templates/FrontEnd/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10113649054fa47681e143e8-37851130%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '242653ed04b544f9d7f56aaf4230987d8b696e4a' => 
    array (
      0 => '/home/webservers/vprokate.ru/www//Templates/FrontEnd/index.tpl',
      1 => 1336118445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10113649054fa47681e143e8-37851130',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fa47681e7fd47_61935545',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa47681e7fd47_61935545')) {function content_4fa47681e7fd47_61935545($_smarty_tpl) {?><!DOCTYPE html>
<html lang="ru">
  <head>
    <title>ВПрокате</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <link rel="stylesheet" href="/css/main.css"/>
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <!-- [ff] создаем фиктивные копии всех новых элементов HTML5 для корректного отображения в IE -->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body class="main" style="background-image:url(/images/main-bg1.jpg);">

    <div id="h-cont">

<!-- [ff] begin header -->
      <header>
        <div class="head-logo">
          <a href="/"><img src="/images/head-logo-bg.png" alt="в прокате"></a>
        </div>  <!-- end .head-logo -->
        <nav>
          <ul class="horizontal">
            <li><a href="#" id="vprokate">в прокате</a></li>
            <li><a href="#" id="filmoteka">фильмотека</a></li>
            <li><a href="#" id="soon">скоро</a></li>
            <li><a href="#" id="info">информация</a></li>
            <li><a href="#" id="profi">профи</a></li>
            <li><a href="#" id="enter">вход</a></li>
            <li><a href="#" id="search">поиск</a></li>
          </ul>
        </nav>

        <div class="clear"></div>

        <div class="nav-hideblock">

          <div class="vprokate">
            <!-- <img class="banner" alt=""> -->
            <form action="">
              <div class="block-custom-sel" id="genre">                 
                <span class="text-item">жанр</span>
                <div class="custom-select">
                  <span class="sel"><p class="active">Комедия</p></span>
                  <div class="custom-sel-list">
                    <div class="custom-sel-list-top"></div>  <!-- end .custom-sel-list-top -->
                    <ul>
                      <li><a href="">Ужасы</a></li>
                      <li><a href="">Боевик</a></li>
                      <li><a href="">Детектив</a></li>
                      <li><a href="">Документальный</a></li>
                      <li><a href="">Драма</a></li>
                      <li><a href="">История</a></li>
                      <li><a href="">Комедия</a></li>
                      <li><a href="">Криминал</a></li>
                      <li><a href="">Мелодрама</a></li>
                      <li><a href="">Музыка</a></li>
                      <li><a href="">Мyльтфильм</a></li>
                      <li><a href="">Мюзикл</a></li>
                    </ul>
                    <div class="custom-sel-list-bottom"></div>  <!-- end .custom-sel-list-top -->
                  </div> <!-- end .custom-sel-list -->
                </div>  <!-- end .custom-select -->
              </div>  <!-- end .block-custom-sel -->

              <div class="block-custom-sel" id="with"> 
                <span class="text-item">с кем</span>
                <div class="custom-select">
                  <span class="sel"><p>Девушкой</p></span>
                  <div class="custom-sel-list">
                    <div class="custom-sel-list-top"></div>  <!-- end .custom-sel-list-top -->
                    <ul>
                      <li><a href="">Бабушкой</a></li>
                      <li><a href="">Дедушкой</a></li>
                    </ul>
                    <div class="custom-sel-list-bottom"></div>  <!-- end .custom-sel-list-top -->
                  </div> <!-- end .custom-sel-list -->
                </div>  <!-- end .custom-select -->
                
              </div>  <!-- end .block-custom-sel -->

              <a class="sel-link sel-cinema" href="#">выбрать кинотеатр</a>

              <div class="calendar">
                <div class="calendar-arrow-left">
                  <a href="#"><img src="/images/calendar-arrow-left.png" alt="Назад"></a>
                </div>  <!-- end .calendar-arrow-left -->

                <div class="calendar-item select">
                  <div class="calendar-digit">28</div>  <!-- end .calendar-digit -->
                  <div class="calendar-additional-text">сегодня</div>  <!-- end .calendar-additional-text -->
                  <div class="calendar-text">марта</div>  <!-- end .calendar-text -->
                </div>  <!-- end .calendar-item.select -->

                <div class="calendar-item">
                  <div class="calendar-text">вс</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">29</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">пн</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">30</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">вт</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">31</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">ср</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">01</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">чт</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">02</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">пт</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">03</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-arrow-right">
                  <a href="#"><img src="/images/calendar-arrow-right.png" alt="Вперед"></a>
                </div>  <!-- end .calendar-arrow-right -->
              </div>  <!-- end .calendar-sm -->
            </form>
          </div>  <!-- end .vprokate -->

          <div class="filmoteka">
            <!-- <img class="banner" alt=""> -->
            <form action="">
              <div class="block-custom-sel" id="genre">                 
                <span class="text-item">жанр</span>
                <div class="custom-select">
                  <span class="sel"><p class="active">Комедия</p></span>
                  <div class="custom-sel-list">
                    <div class="custom-sel-list-top"></div>  <!-- end .custom-sel-list-top -->
                    <ul>
                      <li><a href="">Ужасы</a></li>
                      <li><a href="">Боевик</a></li>
                      <li><a href="">Детектив</a></li>
                      <li><a href="">Документальный</a></li>
                      <li><a href="">Драма</a></li>
                      <li><a href="">История</a></li>
                      <li><a href="">Комедия</a></li>
                      <li><a href="">Криминал</a></li>
                      <li><a href="">Мелодрама</a></li>
                      <li><a href="">Музыка</a></li>
                      <li><a href="">Мyльтфильм</a></li>
                      <li><a href="">Мюзикл</a></li>
                    </ul>
                    <div class="custom-sel-list-bottom"></div>  <!-- end .custom-sel-list-top -->
                  </div> <!-- end .custom-sel-list -->
                </div>  <!-- end .custom-select -->
              </div>  <!-- end .block-custom-sel -->

              <div class="block-custom-sel" id="with"> 
                <span class="text-item">с кем</span>
                <div class="custom-select">
                  <span class="sel"><p>Девушкой</p></span>
                  <div class="custom-sel-list">
                    <div class="custom-sel-list-top"></div>  <!-- end .custom-sel-list-top -->
                    <ul>
                      <li><a href="">Бабушкой</a></li>
                      <li><a href="">Дедушкой</a></li>
                    </ul>
                    <div class="custom-sel-list-bottom"></div>  <!-- end .custom-sel-list-top -->
                  </div> <!-- end .custom-sel-list -->
                </div>  <!-- end .custom-select -->
              </div>  <!-- end .block-custom-sel -->

              <div class="sel-rating">
                <span class="text-item">рейтинг:</span>

                <div class="stars">
                  <div class="stars-cur"></div>

                  <div class="clear"></div> 
                  
                  <div class="rating-slide">
                    <div class="rating-cur"></div>  <!-- end .rating-cur -->
                    <div class="rating-handler"></div>  <!-- end .rating-handler -->
                  </div>  <!-- end .rating-slide -->
                </div>  <!-- end .stars -->
              </div>  <!-- end .sel-rating -->

              <a class="sel-link sel-actor" href="#">выбрать актеров</a>

              <div class="block-custom-sel" id="gift"> 
                <span class="text-item">премии:</span>
                <div class="custom-select">
                  <span class="sel"><p>оскар</p></span>
                  <div class="custom-sel-list">
                    <div class="custom-sel-list-top"></div>  <!-- end .custom-sel-list-top -->
                    <ul>
                      <li><a href="">тефи</a></li>
                      <li><a href="">грэмми</a></li>
                    </ul>
                    <div class="custom-sel-list-bottom"></div>  <!-- end .custom-sel-list-top -->
                  </div> <!-- end .custom-sel-list -->
                </div>  <!-- end .custom-select -->
              </div>  <!-- end .block-custom-sel -->

            </form>
          </div>  <!-- end .filmoteka -->

          <div class="soon">
            <!-- <img class="banner" alt=""> -->
            <form action="">
              <div class="calendar">
                <span class="text-item">год:</span>
                <div class="calendar-arrow-left">
                  <a href="#"><img src="/images/calendar-arrow-left.png" alt="Назад"></a>
                </div>  <!-- end .calendar-arrow-left -->

                <div class="calendar-item select">
                  <div class="calendar-digit">2012</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item.select -->

                <div class="calendar-arrow-right">
                  <a href="#"><img src="/images/calendar-arrow-right.png" alt="Вперед"></a>
                </div>  <!-- end .calendar-arrow-right -->
              </div>  <!-- end .calendar-sm -->
              
              <div class="calendar calendar-month">
                <span class="text-item">месяц:</span>
                <div class="calendar-item">
                  <div class="calendar-text">январь</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">01</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">февраль</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">02</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">март</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">03</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">апрель</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">04</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">май</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">05</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">июнь</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">06</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">июль</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">07</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">август</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">08</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">сентябрь</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">09</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">октябрь</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">10</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">ноябрь</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">11</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->

                <div class="calendar-item">
                  <div class="calendar-text">декабрь</div>  <!-- end .calendar-text -->
                  <div class="calendar-digit">12</div>  <!-- end .calendar-digit -->
                </div>  <!-- end .calendar-item -->
              </div>  <!-- end .calendar-sm -->
            </form>
          </div>  <!-- end .soon -->

          <div class="enter">
            <!-- <img class="banner" alt=""> -->
            <form action="">
              <input type="text" value="e-mail:" onfocus="if(this.value=='e-mail:'){ this.value=''; }" onblur="if(this.value==''){ this.value='e-mail:'; }">
              <input type="text" value="пароль:" onfocus="if(this.value=='пароль:'){ this.value=''; }" onblur="if(this.value==''){ this.value='пароль:'; }">
              <input class="button" type="submit" value="вход">
              <div class="enter-block">
                <div class="enter-block-remember">
                  <span class="text-item">запомнить меня</span>
                  <div class="on-off-slide">
                    <div class="on-off-slide-btn"></div>
                  </div>  <!-- end .on-off-slide -->
                </div>  <!-- end .enter-block-remember -->
                <div class="clear"></div>
                <div class="restore">
                  <span class="text-item"><a href="#">восстановление пароля</a></span>
                </div>  <!-- end .restore -->
              </div>  <!-- end .enter-block -->
            </form>
          </div>  <!-- end .enter -->

          <div class="search">
            <img class="banner" src="/images/hideblock-banner-01.jpg" alt="">
            <form action="">
              <input type="text" value="Наркоман Павлик 8 серия">
              <input class="button" type="submit" value="поиск">
            </form>
          </div>  <!-- end .search -->

        </div>  <!-- end .nav-hideblock -->

      </header>
<!-- [ff] end header -->

      <div class="clear"></div>

<!-- [ff] begin content -->

        <div id="wrap">

          <section class="banner-top">
          </section>  <!-- end section.banner-top -->

          <div class="clear"></div>

          <section class="main-sel-film">
            <img class="sel-film" src="/images/samples/woman-in-black.png" alt="">
            <div class=" ribbon ribbon-order"></div>  <!-- end .ribbon -->
            <div class="main-sel-film-info">
              <div class="genre">
                <p>драма, мелодрама, комедия</p>
              </div>  <!-- end .genre -->

              <div class="head">
                <h2>Лето. Одноклассники. Любовь (2012)</h2>
              </div>  <!-- end .head -->

              <div class="info">
                <div class="stars">
                  <div class="stars-cur"></div>  <!-- end .stars-cur -->
                </div>  <!-- end .stars -->

                <div class="battery">
                  <div class="battery-back">
                    <div class="battery-cur"></div>  <!-- end .battery-cur -->
                  </div>  <!-- end .battery-back -->
                </div>  <!-- end .battery -->

                <div class="views">
                  <p>1375</p>
                </div>  <!-- end .views -->

                <div class="comments">
                  <p>451</p>
                </div>  <!-- end .views -->

                <div class="i-not-see"></div>  <!-- end .i-not-see -->

              </div>  <!-- end .info -->
            </div>  <!-- end .main-sel-film-info -->
            <div class="main-sel-film-play"></div>
          </section>  <!-- end section.main-sel-film -->

          <section class="main-preview">
            <object id="t94528top" width="908" height="363" data="http://st.kinopoisk.ru/js/jw59/player-licensed.swf" name="t94528top" type="application/x-shockwave-flash">
              <param value="true" name="allowfullscreen">
              <param value="always" name="allowscriptaccess">
              <param value="transparent" name="wmode">
              <param value="file=http://tr.kinopoisk.ru/498707/kinopoisk.ru-Woman-in-Black-The-94528.mp4&skin=http://st.kinopoisk.ru/js/jw59/overlay.swf&controlbar=over&frontcolor=ffffff&lightcolor=ff6600&stretching=unified&provider=video&plugins=http://st.kinopoisk.ru/js/kinopoiskPlugin.swf&kinopoiskPlugin.genres=1:4:8&kinopoiskPlugin.url=http://www.kinopoisk.ru/level/16/film/498707/&kinopoiskPlugin.innerid=t94528top&captions.file=&captions.fontsize=12&autostart=true" name="flashvars">
            </object>

<!-- begin video-controls          
            <div class="video-controls">
              <div class="control play-pause">
                <a href="#"></a>
              </div>  
              <div class="control timeline">
                <div class="time-all">
                  <div class="time-preload"></div>
                  <div class="time-cur"></div>
                  <div class="time">00:13</div>
                </div>
                
              </div>  
              <div class="control volume">
                <div class="volume-back">
                  <div class="volume-cur"></div>
                </div>
              </div>  
              <div class="control hd"><a href="#"></a></div>  
              <div class="control fullscreen"><a href="#"></a></div>
            </div>  
end .video-controls -->
          </section>  <!-- end section.main-preview -->

          <div class="clear"></div>

<!-- begin slide -->
          <section class="slide">
            <div class="btn-left"><a href="#"><img src="/images/btn-left.png" alt="Назад"></a></div>  <!-- end .btn-left -->
            
            <div class="btn-right"><a href="#"><img src="/images/btn-right.png" alt="Вперед"></a></div>  <!-- end .btn-right -->
            
            <div class="wrapper">
              <div class="article-set">
                <article trailer="http://tr.kinopoisk.ru/498707/kinopoisk.ru-Woman-in-Black-The-94528.mp4" previmg="/images/samples/woman-in-black.png">
                  <img src="/images/article-1-bg.jpg" alt="">

                  <div class="main-sel-film-info">
                    <div class="genre">
                      <p>ужасы, триллер, драма</p>
                    </div>  <!-- end .genre -->

                    <div class="head">
                      <h5>Женщина в черном (2012)</h5>
                    </div>  <!-- end .head -->

                    <div class="stars">
                      <div class="stars-cur"></div>  <!-- end .stars-cur -->
                    </div>  <!-- end .stars -->
                    <div class="info">

                      <div class="i-not-see"></div>  <!-- end .i-not-see -->

                      <div class="comments">
                        <p>451</p>
                      </div>  <!-- end .views -->

                      <div class="views">
                        <p>1375</p>
                      </div>  <!-- end .views -->

                      <div class="battery">
                        <div class="battery-back">
                          <div class="battery-cur"></div>  <!-- end .battery-cur -->
                        </div>  <!-- end .battery-back -->
                      </div>  <!-- end .battery -->

                    </div>  <!-- end .info -->

                    <div class="description">
                      <p>На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного.</p>
                      <p>Молодой лондонский юрист Артур Киппс вынужден оставить своего 4-летнего сына и отправиться в командировку в уединенную северную деревушку, чтобы составить реестр документов...</p>
                    </div>  <!-- end .description -->
                  </div>  <!-- end .main-sel-film-info -->
                </article>

                <article trailer="http://tr.kinopoisk.ru/506251/kinopoisk.ru-American-Reunion-93870.mp4" previmg="/images/samples/american-reunion.png">
                  <img src="/images/article-2-bg.jpg" alt="">

                  <div class="main-sel-film-info">
                    <div class="genre">
                      <p>комедия</p>
                    </div>  <!-- end .genre -->

                    <div class="head">
                      <h5>Американский пирог: Все в сборе (2012)</h5>
                    </div>  <!-- end .head -->

                    <div class="stars">
                      <div class="stars-cur"></div>  <!-- end .stars-cur -->
                    </div>  <!-- end .stars -->
                    <div class="info">

                      <div class="i-not-see"></div>  <!-- end .i-not-see -->

                      <div class="comments">
                        <p>345</p>
                      </div>  <!-- end .views -->

                      <div class="views">
                        <p>2345</p>
                      </div>  <!-- end .views -->

                      <div class="battery">
                        <div class="battery-back">
                          <div class="battery-cur"></div>  <!-- end .battery-cur -->
                        </div>  <!-- end .battery-back -->
                      </div>  <!-- end .battery -->

                    </div>  <!-- end .info -->

                    <div class="description">
                      <p>На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного.</p>
                      <p>Молодой лондонский юрист Артур Киппс вынужден оставить своего 4-летнего сына и отправиться в командировку в уединенную северную деревушку, чтобы составить реестр документов...</p>
                    </div>  <!-- end .description -->
                  </div>  <!-- end .main-sel-film-info -->
                </article>

                <article trailer="http://tr.kinopoisk.ru/455773/kinopoisk.ru-Men-in-Black-III-99321.mp4" previmg="/images/samples/men-in-black.png">
                  <img src="/images/article-3-bg.jpg" alt="">

                  <div class="main-sel-film-info">
                    <div class="genre">
                      <p>фантастика, боевик, приключения</p>
                    </div>  <!-- end .genre -->

                    <div class="head">
                      <h5>Люди в черном 3 (2012)</h5>
                    </div>  <!-- end .head -->

                    <div class="stars">
                      <div class="stars-cur"></div>  <!-- end .stars-cur -->
                    </div>  <!-- end .stars -->
                    <div class="info">

                      <div class="i-not-see"></div>  <!-- end .i-not-see -->

                      <div class="comments">
                        <p>761</p>
                      </div>  <!-- end .views -->

                      <div class="views">
                        <p>1870</p>
                      </div>  <!-- end .views -->

                      <div class="battery">
                        <div class="battery-back">
                          <div class="battery-cur"></div>  <!-- end .battery-cur -->
                        </div>  <!-- end .battery-back -->
                      </div>  <!-- end .battery -->

                    </div>  <!-- end .info -->

                    <div class="description">
                      <p>На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного.</p>
                      <p>Молодой лондонский юрист Артур Киппс вынужден оставить своего 4-летнего сына и отправиться в командировку в уединенную северную деревушку, чтобы составить реестр документов...</p>
                    </div>  <!-- end .description -->
                  </div>  <!-- end .main-sel-film-info -->
                </article>

                <article trailer="http://tr.kinopoisk.ru/498707/kinopoisk.ru-Woman-in-Black-The-94528.mp4" previmg="/images/samples/woman-in-black.png">
                  <img src="/images/article-1-bg.jpg" alt="">

                  <div class="main-sel-film-info">
                    <div class="genre">
                      <p>ужасы, триллер, драма</p>
                    </div>  <!-- end .genre -->

                    <div class="head">
                      <h5>Женщина в черном (2012)</h5>
                    </div>  <!-- end .head -->

                    <div class="stars">
                      <div class="stars-cur"></div>  <!-- end .stars-cur -->
                    </div>  <!-- end .stars -->
                    <div class="info">

                      <div class="i-not-see"></div>  <!-- end .i-not-see -->

                      <div class="comments">
                        <p>451</p>
                      </div>  <!-- end .views -->

                      <div class="views">
                        <p>1375</p>
                      </div>  <!-- end .views -->

                      <div class="battery">
                        <div class="battery-back">
                          <div class="battery-cur"></div>  <!-- end .battery-cur -->
                        </div>  <!-- end .battery-back -->
                      </div>  <!-- end .battery -->

                    </div>  <!-- end .info -->

                    <div class="description">
                      <p>На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного.</p>
                      <p>Молодой лондонский юрист Артур Киппс вынужден оставить своего 4-летнего сына и отправиться в командировку в уединенную северную деревушку, чтобы составить реестр документов...</p>
                    </div>  <!-- end .description -->
                  </div>  <!-- end .main-sel-film-info -->
                </article>

                <article trailer="http://tr.kinopoisk.ru/506251/kinopoisk.ru-American-Reunion-93870.mp4" previmg="/images/samples/american-reunion.png">
                  <img src="/images/article-2-bg.jpg" alt="">

                  <div class="main-sel-film-info">
                    <div class="genre">
                      <p>комедия</p>
                    </div>  <!-- end .genre -->

                    <div class="head">
                      <h5>Американский пирог: Все в сборе (2012)</h5>
                    </div>  <!-- end .head -->

                    <div class="stars">
                      <div class="stars-cur"></div>  <!-- end .stars-cur -->
                    </div>  <!-- end .stars -->
                    <div class="info">

                      <div class="i-not-see"></div>  <!-- end .i-not-see -->

                      <div class="comments">
                        <p>345</p>
                      </div>  <!-- end .views -->

                      <div class="views">
                        <p>2345</p>
                      </div>  <!-- end .views -->

                      <div class="battery">
                        <div class="battery-back">
                          <div class="battery-cur"></div>  <!-- end .battery-cur -->
                        </div>  <!-- end .battery-back -->
                      </div>  <!-- end .battery -->

                    </div>  <!-- end .info -->

                    <div class="description">
                      <p>На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного.</p>
                      <p>Молодой лондонский юрист Артур Киппс вынужден оставить своего 4-летнего сына и отправиться в командировку в уединенную северную деревушку, чтобы составить реестр документов...</p>
                    </div>  <!-- end .description -->
                  </div>  <!-- end .main-sel-film-info -->
                </article>

                <article trailer="http://tr.kinopoisk.ru/455773/kinopoisk.ru-Men-in-Black-III-99321.mp4" previmg="/images/samples/men-in-black.png">
                  <img src="/images/article-3-bg.jpg" alt="">

                  <div class="main-sel-film-info">
                    <div class="genre">
                      <p>фантастика, боевик, приключения</p>
                    </div>  <!-- end .genre -->

                    <div class="head">
                      <h5>Люди в черном 3 (2012)</h5>
                    </div>  <!-- end .head -->

                    <div class="stars">
                      <div class="stars-cur"></div>  <!-- end .stars-cur -->
                    </div>  <!-- end .stars -->
                    <div class="info">

                      <div class="i-not-see"></div>  <!-- end .i-not-see -->

                      <div class="comments">
                        <p>761</p>
                      </div>  <!-- end .views -->

                      <div class="views">
                        <p>1870</p>
                      </div>  <!-- end .views -->

                      <div class="battery">
                        <div class="battery-back">
                          <div class="battery-cur"></div>  <!-- end .battery-cur -->
                        </div>  <!-- end .battery-back -->
                      </div>  <!-- end .battery -->

                    </div>  <!-- end .info -->

                    <div class="description">
                      <p>На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного.</p>
                      <p>Молодой лондонский юрист Артур Киппс вынужден оставить своего 4-летнего сына и отправиться в командировку в уединенную северную деревушку, чтобы составить реестр документов...</p>
                    </div>  <!-- end .description -->
                  </div>  <!-- end .main-sel-film-info -->
                </article>

                <article trailer="http://tr.kinopoisk.ru/498707/kinopoisk.ru-Woman-in-Black-The-94528.mp4" previmg="/images/samples/woman-in-black.png">
                  <img src="/images/article-1-bg.jpg" alt="">

                  <div class="main-sel-film-info">
                    <div class="genre">
                      <p>ужасы, триллер, драма</p>
                    </div>  <!-- end .genre -->

                    <div class="head">
                      <h5>Женщина в черном (2012)</h5>
                    </div>  <!-- end .head -->

                    <div class="stars">
                      <div class="stars-cur"></div>  <!-- end .stars-cur -->
                    </div>  <!-- end .stars -->
                    <div class="info">

                      <div class="i-not-see"></div>  <!-- end .i-not-see -->

                      <div class="comments">
                        <p>451</p>
                      </div>  <!-- end .views -->

                      <div class="views">
                        <p>1375</p>
                      </div>  <!-- end .views -->

                      <div class="battery">
                        <div class="battery-back">
                          <div class="battery-cur"></div>  <!-- end .battery-cur -->
                        </div>  <!-- end .battery-back -->
                      </div>  <!-- end .battery -->

                    </div>  <!-- end .info -->

                    <div class="description">
                      <p>На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного.</p>
                      <p>Молодой лондонский юрист Артур Киппс вынужден оставить своего 4-летнего сына и отправиться в командировку в уединенную северную деревушку, чтобы составить реестр документов...</p>
                    </div>  <!-- end .description -->
                  </div>  <!-- end .main-sel-film-info -->
                </article>

                <article trailer="http://tr.kinopoisk.ru/506251/kinopoisk.ru-American-Reunion-93870.mp4" previmg="/images/samples/american-reunion.png">
                  <img src="/images/article-2-bg.jpg" alt="">

                  <div class="main-sel-film-info">
                    <div class="genre">
                      <p>комедия</p>
                    </div>  <!-- end .genre -->

                    <div class="head">
                      <h5>Американский пирог: Все в сборе (2012)</h5>
                    </div>  <!-- end .head -->

                    <div class="stars">
                      <div class="stars-cur"></div>  <!-- end .stars-cur -->
                    </div>  <!-- end .stars -->
                    <div class="info">

                      <div class="i-not-see"></div>  <!-- end .i-not-see -->

                      <div class="comments">
                        <p>345</p>
                      </div>  <!-- end .views -->

                      <div class="views">
                        <p>2345</p>
                      </div>  <!-- end .views -->

                      <div class="battery">
                        <div class="battery-back">
                          <div class="battery-cur"></div>  <!-- end .battery-cur -->
                        </div>  <!-- end .battery-back -->
                      </div>  <!-- end .battery -->

                    </div>  <!-- end .info -->

                    <div class="description">
                      <p>На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного.</p>
                      <p>Молодой лондонский юрист Артур Киппс вынужден оставить своего 4-летнего сына и отправиться в командировку в уединенную северную деревушку, чтобы составить реестр документов...</p>
                    </div>  <!-- end .description -->
                  </div>  <!-- end .main-sel-film-info -->
                </article>

                <article trailer="http://tr.kinopoisk.ru/455773/kinopoisk.ru-Men-in-Black-III-99321.mp4" previmg="/images/samples/men-in-black.png">
                  <img src="/images/article-3-bg.jpg" alt="">

                  <div class="main-sel-film-info">
                    <div class="genre">
                      <p>фантастика, боевик, приключения</p>
                    </div>  <!-- end .genre -->

                    <div class="head">
                      <h5>Люди в черном 3 (2012)</h5>
                    </div>  <!-- end .head -->

                    <div class="stars">
                      <div class="stars-cur"></div>  <!-- end .stars-cur -->
                    </div>  <!-- end .stars -->
                    <div class="info">

                      <div class="i-not-see"></div>  <!-- end .i-not-see -->

                      <div class="comments">
                        <p>761</p>
                      </div>  <!-- end .views -->

                      <div class="views">
                        <p>1870</p>
                      </div>  <!-- end .views -->

                      <div class="battery">
                        <div class="battery-back">
                          <div class="battery-cur"></div>  <!-- end .battery-cur -->
                        </div>  <!-- end .battery-back -->
                      </div>  <!-- end .battery -->

                    </div>  <!-- end .info -->

                    <div class="description">
                      <p>На дворе - конец девятнадцатого века, но, хотя люди пользуются автомобилями, железными дорогами и телеграфом, человек по-прежнему бессилен перед проявлениями сверхъестественного.</p>
                      <p>Молодой лондонский юрист Артур Киппс вынужден оставить своего 4-летнего сына и отправиться в командировку в уединенную северную деревушку, чтобы составить реестр документов...</p>
                    </div>  <!-- end .description -->
                  </div>  <!-- end .main-sel-film-info -->
                </article>
              </div>  <!-- end .article-set -->
            </div>  <!-- end .wrapper -->
            
          </section>  <!-- end section.slide -->
<!-- end slide -->
          <div class="clear"></div>

        </div>  <!-- [ff] end #wrap -->
<!-- [ff] end content -->
        <div class="clear"></div>
<!-- [ff] begin footer -->
          <footer>
              <nav>
                <ul class="horizontal">
                  <li><a href="/about.html">О проекте</a></li>
                  <li><a href="/advertising.html">Рекламодателям</a></li>
                  <li><a href="/rules.html">Условия использования</a></li>
                  <li><a href="/contacts.html">Контакты</a></li>
                </ul>
              </nav>

              <div class="clear"></div>

              <div class="social">
                <a href="#"><img src="/images/social-facebook.png" alt="facebook"></a>
                <a href="#"><img src="/images/social-google.png" alt="Google+"></a>
                <a href="#"><img src="/images/social-vkontakte.png" alt="В контакте"></a>
                <a href="#"><img src="/images/social-lj.png" alt="Live Journal"></a>
                <a href="#"><img src="/images/social-twitter.png" alt="Twitter"></a>
                <a href="#"><img src="/images/social-odnoklassniki.png" alt="Одноклассники"></a>
                <a href="#"><img src="/images/social-linked.png" alt="Linked in"></a>
              </div>  <!-- end .social -->
          </footer>
<!-- [ff] end footer -->
        <div class="clear"></div>

    </div>   <!-- [ff] end #h-cont -->
  </body>
</html>


<?php }} ?>