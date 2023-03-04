<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Головна - <?php echo $ucp_settings['s_title']?></title>

	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/public/main/css/style.css">
	<link rel="shortcut icon" href="<?php echo $ucp_settings['s_favicon']?>" type="image/png">
    <link rel="stylesheet" href="public/main/fonts">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Mulish:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Oswald:wght@300;400;700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">	</head>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Spectral+SC:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap"  rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
</head>
<body >
	<?php include "view/common/topmenu.php"; ?>

	<section class="slider">

        <div class="slider-text">
            <h1><b><?php echo $ucp_settings['s_title']?></b> <span class='no-weight'>— Проект твого майбутнього</span></h1>
            <a href="#howto" class="start-slider">ПОЧАТИ ГРАТИ <img src="/public/main/img/arrow-right.svg" alt=''></a>
        </div>
        <div class="slider-image"><img src='/public/main/img/slider-image.png' alt=''></div>
        <img src="/public/main/img/vertical-slider.png" id='vertical-slider'>
	</section>
    <section class="projectname_description" id="about_us">
        <div class="heading">
            <div>
                <h1>Про нас</h1>
                <div class="breaker"></div>
            </div>
            <img src="/public/main/img/dots.svg" alt="">
        </div>
        <div class="container-about-me">
            <i><img height="600" src="public/main/img/ballas.png" alt=""/></i>
            <div>
                <p>
                    Надокучили однотипні сервери SA:MP? <br> Хочеться свободи та нового ігрового досвіду?
                    <br> Нової економіки та цікавого функціонала? <br> Приєднуйся до нашого ентузіастського проєкту.
                    Можливо, нам не вистачає саме тебе!
                </p>
                <p>Приємної гри!</p>
            </div>
        </div>
    </section>
	<div class="heading">
            <div>
                <h1>Наш сервер</h1>
                <div class="breaker"></div>
            </div>
            <img src="/public/main/img/dots.svg" alt="">
    </div>
    	<?php
    	$online = GetOnline();
	?>
	<section class="monitoring">
		<div class="container">
			<div class="row">	
				<i class="monitoring-man"><img src="/public/main/img/mont-man.png" width="600" alt=""></i>
				<div class="col-lg-12">
					<div class="servers">
						<div class="col-lg-5">
							<div class="server-size">
								<p><strong><?php echo $online ?></strong></p>
								<p>/ 1000</p>
								<img src="/public/main/img/countPlayerMonitoring.png" alt="">
							</div>
							<p><?php echo $ucp_settings['s_title']?></p>
							<p><strong>Mriya</strong></p>
							<p class="ip" style="">777.777.777.7:7777</p>
                        </div>
		       		</div>
				</div>
			</div>
		</div>
	</section>
    <div class="heading" id="howto">
        <div>
            <h1>Як зайти на сервер</h1>
            <div class="breaker"></div>
        </div>
        <img src="/public/main/img/dots.svg" alt="">
    </div>
    <section class="howto">
        <div>
            <img height="500" src="/public/main/img/oldman.png" alt="">
            <div>
                <span>777.777.777.7:7777</span>
                <div><span class="counting-span">01</span><p>Скопіюйте айпі адресу зверху.</p></div>
                <div><span class="counting-span">02</span><p>Натиснути клавішу "Додати сервер" в лаунчері.</p></div>
                <div><span class="counting-span">03</span><p>Запустити сервер.</p></div>
                <div><span class="counting-span">04</span><p>Насолоджуватися грою :)</p></div>
            </div>
        </div>
    </section>
	<div class="horisontal-slider">
        <img src='/public/main/img/horisontal-slider.png'>
    </div>
    <div class="heading">
        <div>
            <h1>Новини</h1>
            <div class="breaker"></div>
        </div>
        <img src="/public/main/img/dots.svg" alt="">
    </div>
	<section>
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-sm-12">

					<div class="full-news d-flex" >
						
							
						<div class="col-lg-6" style="margin-top: 100px">
						
						<div class="content-news">
							<h2 class="title-news">Блок новин</h2>

							<div class="breaker"></div>

							<div class="text-news">...</div>

						</div>	
						</div>
						
						<div class="col-lg-6 postImageFull"  ></div>

							
						
						
						
					</div>
				</div>
				<?php
				
							global $db;

							$statement = $db->prepare("SELECT * FROM `ucp_news` ORDER BY n_id DESC LIMIT 4");




							$statement->execute ();

							if($statement->rowCount()) 
							{
								while($news=$statement->fetch())
								{

											
											
											 echo '
				<div class="col-lg-4 col-sm-6">
					<div class="default-news">
						<img src="'.$news['n_images'].'" class="dPostImage">
						<div class="content-news">
							<h2 class="title-news">'.$news['n_title'].'</h2>

							<div class="breaker"></div>

							<div class="text-news">'.$news['n_text'].'</div>

							<div class="more-news">
                        		<div class="date-news">
                        			<img src="/public/main/img/calendar.svg" alt="">
                        			'.$news['n_data'].'
                        		</div>
                        		<a href="'.$news['n_url'].'"><img src="/public/main/img/3dots.svg" alt="" id="dots-more"></a>
                    		</div>

						</div>
						
					</div>
				</div>'; } } ?>
				
				


			</div>
			<div class="row justify-content-md-center">
				
	
					<div class="col-md-auto">

					<a href="/news" style="text-decoration: none"><div class="showall">ПОКАЗАТИ ВСЕ<img src="/public/main/img/3dots.svg" alt=""></div></a>
				</div>
				

			</div> 
		</div>
	</section>
	
	<footer>
        <?php include "view/common/footer.php"; ?>
    </footer>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
    <script src="/public/main/js/main.js" ></script>
    <script>
        $(document).on('click', 'a[href^="#"]', function (event) {
            event.preventDefault();

            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 500);
        });
    </script>
</body>
</html>