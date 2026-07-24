<?
IncludeTemplateLangFile(__FILE__);
$page=$APPLICATION->GetCurPage(false);
$dir=$APPLICATION->GetCurDir();
$isMain=($page==SITE_DIR);
$edir=explode('/',$dir);
$arContacts=GetContacts();
?>
<?
      CJSCore::Init(array("jquery"));
 ?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>"<?if($USER->IsAdmin()):?> class="html--authorization"<?endif?>>
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16639473504"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-16639473504');
</script>
<!-- /Google tag (gtag.js) -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
    })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=103564631', 'ym');

    ym(103564631, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", accurateTrackBounce:true, trackLinks:true});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/103564631" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no"/>
	<meta name="format-detection" content="address=no"/>
	<meta name="theme-color" content="#000">
	<meta name="msapplication-navbutton-color" content="#000">
	<meta name="apple-mobile-web-app-status-bar-style" content="#000">
	<link rel="icon" type="image/svg+xml" href="/favicon.svg">

	<?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle()?></title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
	<?
	$APPLICATION->SetAdditionalCSS('//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css');
	$APPLICATION->SetAdditionalCSS('//cdnjs.cloudflare.com/ajax/libs/Swiper/6.7.5/swiper-bundle.min.css');
	
	$APPLICATION->AddHeadScript('//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js');
	$APPLICATION->AddHeadScript('//cdnjs.cloudflare.com/ajax/libs/Swiper/6.7.5/swiper-bundle.min.js');
	$APPLICATION->AddHeadScript('//api-maps.yandex.ru/2.1/?lang='.(LANGUAGE_ID=="ru" ? 'ru_RU' : LANGUAGE_ID.'_RU'));
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/components.js');
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/site.js');
	?>
<style>
	[id*="wait_comp"]{display:none!important}
	</style>
</head>
	<div id="panel"><?// $APPLICATION->ShowPanel();?></div>
<body class="<?$APPLICATION->ShowProperty("page-class","page-contacts");?>">
	<div id="admin-panel"<?if($USER->IsAdmin()):?> style="margin-top: 100px;" class="active-panel"<?endif?>><?$APPLICATION->ShowPanel();?></div>
	<!-- centerlayer -->
	<div class="centerlayer">
		<?php include  $_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/inc/svg_top.php" ?>
		<!-- header -->
		<header class="header" id="header">
			<div class="grid">
				<div class="grid__row header__row">
					<div class="grid__col header__col-logo">
						<?if(!$isMain):?>
							<?if(SITE_ID != "s1"):?>
								<a href="<?=SITE_DIR?>" class="logo header__logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/logo_not_text.svg" alt=""></a>
							<?else:?>
								<a href="<?=SITE_DIR?>" class="logo header__logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/logo.svg" alt=""></a>
							<?endif?>	
						<?else:?>
							<?if(SITE_ID != "s1"):?>
								<span class="logo header__logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/logo_not_text.svg" alt=""></span>
							<?else:?>
								<span class="logo header__logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/logo.svg" alt=""></span>
							<?endif?>
						<?endif?>
					</div>
					<div class="grid__col header__sidebar hei100vh">
						<div class="header__sidebar-header">
							<?
							$APPLICATION->IncludeComponent(
								"bitrix:main.site.selector",
								"mobile",
								Array(
									"CACHE_TIME" => "3600",
									"CACHE_TYPE" => "A",
									"SITE_LIST" => array("*all*")
								)
							);
							?>

							<button class="button-bar button-bar__close header__bar js-toggleMenu">
								<span></span>
							</button>
						</div>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"top",
							Array(
								"ALLOW_MULTI_SELECT" => "Y",
								"CHILD_MENU_TYPE" => "sub",
								"DELAY" => "N",
								"MAX_LEVEL" => "2",
								"MENU_CACHE_GET_VARS" => array(""),
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "N",
								"ROOT_MENU_TYPE" => "top",
								"USE_EXT" => "N"
							)
						);?>
						<div class="header__sidebar-footer">
							<div class="header__address-mobile"><?=$arContacts["manufacturer_address"]?></div>
							<a href="tel://+<?=only_numbers($arContacts["phones"][0])?>" class="site-phone" title="<?=$arContacts["phones"][0].' '.$arContacts["phones_desc"][0]?>"><?=$arContacts["phones"][0]?></a>
							<div class="header__mail">
							    <?if (count($arContacts["email"]) > 1):?>
							        <button class="header__mailTitle header__mailTitle-sub"><?=$arContacts["email"][0]?></button>
							        <ul class="header__mailDrop">
							            <?foreach($arContacts["email"] as $k => $email):?>
							                <li>
							                    <a href="mailto:<?=$email?>">
							                        <span><?=$email?></span> <?=$arContacts["email_desc"][$k]?>
							                    </a>
							                </li>
							            <?endforeach?>
							        </ul>
							    <?else:?>
							        <a href="mailto:<?=$arContacts["email"][0]?>" class="header__mailTitle">
							            <?=$arContacts["email"][0]?>
							        </a>
							    <?endif;?>
							</div>	
							<a href="#" data-fancybox="" data-src="#modal-call" class="button button--blue"><?=GetMessage('HEADER_CALLBACK')?></a>
						</div>
					</div>
					<?
					$APPLICATION->IncludeComponent(
						"bitrix:main.site.selector",
						"desktop",
						Array(
							"CACHE_TIME" => "3600",
							"CACHE_TYPE" => "A",
							"SITE_LIST" => array("*all*")
						)
					);
					?>
					<div class="grid__col header__col-contacts">
						<a href="tel://+<?=only_numbers($arContacts["phones"][0])?>" class="site-phone header__phone" title="<?=$arContacts["phones"][0].' '.$arContacts["phones_desc"][0]?>"><?=$arContacts["phones"][0]?></a>
						<div class="header__buttons">
							<div class="header__buttonsItem">
								<button data-fancybox="" data-src="#modal-call" class="button-icon"><svg><use href="#icon-phone"></use></svg></button>
							</div>
							<div class="header__buttonsItem">
								<button class="button-icon"><svg><use href="#icon-location"></use></svg></button>
								<div class="header__buttonsDrop">
									<div class="header__buttonsDescribe">
										<span><?=$arContacts["manufacturer_address"]?></span>
									</div>											
								</div>
							</div>
							<div class="header__buttonsItem">
								<button class="button-icon"><svg><use href="#icon-mail"></use></svg></button>
								<div class="header__buttonsDrop">
									<ul class="header__buttonsDescribe">
										<?foreach($arContacts["email"] as $k=>$email):?>
											<li><a href="mailto://<?=$email?>"><span><?=$email?></span> <?=$arContacts["email_desc"][$k]?></a></li>
										<?endforeach?>
									</ul>
								</div>
							</div>							
						</div>							
					</div>
					<div class="grid__col header__col-bar">
						<div class="header__phone-btn">
							<a href="tel:+<?=only_numbers($arContacts["phones"][0])?>" class="button-icon" title="<?=$arContacts["phones"][0].' '.$arContacts["phones_desc"][0]?>" aria-label="<?=$arContacts["phones"][0]?>"><svg><use href="#icon-phone"></use></svg></a>
						</div>
						<button class="button-bar button-bar__open header__bar js-toggleMenu">
							<span></span>
						</button>
					</div>
				</div>
			</div>
		</header>
		
		<!-- \ header -->
		
		<?if ($APPLICATION->GetProperty('text-page')=="Y" || (defined("ERROR_404") && ERROR_404=="Y")): //text-page="Y"?>
			<!-- page-main text page -->
			<section class="page-header page-main" id="page-main">
				<div class="grid">
					<?if (!defined("ERROR_404")):?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"template1",
						Array(
							"PATH" => "",
							"SITE_ID" => SITE_ID,
							"START_FROM" => "0"
						),
						false
					);?>
					<?endif?>
					<?$APPLICATION->ShowViewContent('h1')?>

					<div class="b-editor">
		<?elseif(!$isMain):?>
			<!-- page-header -->
			<section class="page-header" id="page-header">
				<div class="grid">
					<?$APPLICATION->IncludeComponent(
						"bitrix:breadcrumb",
						"template1",
						Array(
							"PATH" => "",
							"SITE_ID" => SITE_ID,
							"START_FROM" => "0"
						),
						false
					);?>
					<?$APPLICATION->ShowViewContent('h1')?>
					<?//$APPLICATION->ShowViewContent('head_tabs')?>
					<?$APPLICATION->ShowViewContent('head_tabs_section')?>
				</div>
			</section>
			<!-- \ page-header -->
		<?endif?>
