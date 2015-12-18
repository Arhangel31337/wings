<!DOCTYPE html>
<html>
{include file="head.tpl"}
<body>
	<aside>
		<header>
			<a class="logo" href="#">Wings</a>
			<div class="user">
				<div class="select">
					<div class="name">Arhangel31337</div>
					<div class="arrow"></div>
				</div>
				<ul>
					<li>
						<a class="icon settings" href="#">Настройки</a>
					</li>
					<li>
						<a class="icon exit" href="?logout">Выход</a>
					</li>
				</ul>
			</div>
		</header>
		<nav>
{include file="menu.tpl" nodes=$pages.0.childrens}
		</nav>
	</aside>
	<section>
		<article class="page1">
			<div class="background">
			<div class="cssload-loader progress blockInCenter">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
			<div class="cl-b"></div>
		</div>
		</article>
		<article class="page2">
			<div class="cssload-loader progress blockInCenter">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
			<div class="cl-b"></div>
		</article>
		<article class="page3">
			<div class="cssload-loader progress blockInCenter">
				<div class="cssload-inner cssload-one"></div>
				<div class="cssload-inner cssload-two"></div>
				<div class="cssload-inner cssload-three"></div>
			</div>
			<div class="cl-b"></div>
		</article>
	</section>
</body>
</html>