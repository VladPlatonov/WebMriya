<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-auto" style="height:100px;">
            <div class="copywrite">© 2023 <?php echo $ucp_settings['s_title']?> — Проект твого майбутнього.
			<br>
			<a href='/offer'> Договір та умови користувача — </a>
			<a href='/policy'>Політика конфіденційності — </a>
			<a href='/about'> Про нас</a>
			<br>
			Контакти: електронна пошта admin@mriya-rp.com
			</div>
            <img src="public/main/img/mastervisa.png" class="footer-brand">
        </div>
        
    </div>
</div>

<div id="preloader">
	<div id="loader"></div>
</div>
<script type="text/javascript">
	var loader = document.getElementById("loader");
	var preloader = document.getElementById("preloader");
	function fadeOutnojquery(el1,el2)
	{
		el1.style.opacity = 1;
		el2.style.opacity = 1;
		var intPreloader = setInterval(function()
		{
			el1.style.opacity = el1.style.opacity - 0.05;
			el2.style.opacity = el2.style.opacity - 0.05;
			if (el1.style.opacity <=0.05 && el2.style.opacity <=0.05)
			{ 
				clearInterval(intPreloader);el2.style.display = "none";el1.style.display = "none";
			}
		},16);
	}
	window.onload = function()
	{
		setTimeout(function()
		{
			fadeOutnojquery(loader,preloader);
		},1000);
	};
</script>
