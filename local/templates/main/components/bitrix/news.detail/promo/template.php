<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
if (is_array($arResult["DETAIL_PICTURE"]) && !is_array($arResult["PREVIEW_PICTURE"]))
{
	$arResult["PREVIEW_PICTURE"]=$arResult["DETAIL_PICTURE"];
}
elseif (!is_array($arResult["DETAIL_PICTURE"]) && is_array($arResult["PREVIEW_PICTURE"]))
{
	$arResult["DETAIL_PICTURE"]=$arResult["PREVIEW_PICTURE"];
}
$arResult["VIDEO"]=false;

if ($arResult["PROPERTIES"]["video"]["VALUE"])
{
	$arResult["VIDEO"]=[];
	$arResult["VIDEO"]["TYPE"]=GetVideoType($arResult["PROPERTIES"]["video"]["VALUE"]);
	if ($arResult["VIDEO"]["TYPE"]=="youtube")
	{
		$arResult["VIDEO"]["CODE"]=GetYoutubeCode($arResult["PROPERTIES"]["video"]["VALUE"]);
		$arResult["VIDEO"]["SRC"]="https://www.youtube.com/watch?v=".$arResult["VIDEO"]["CODE"];
		//$arResult["VIDEO"]["IMG"]="//img.youtube.com/vi/".$arResult["VIDEO"]["CODE"]."/hqdefault.jpg";
	}
	elseif ($arResult["VIDEO"]["TYPE"]=="vk")
	{
		$arResult["VIDEO"]["CODE"]=GetVKVideoCode($arResult["PROPERTIES"]["video"]["VALUE"]);
		$arResult["VIDEO"]["SRC"]="https://vk.com/video_ext.php?oid=".$arResult["VIDEO"]["CODE"]["oid"]."&id=".$arResult["VIDEO"]["CODE"]["id"]."&hd=2"
		/*.($arResult["VIDEO"]["CODE"]["hash"] ? "&hash=".$arResult["VIDEO"]["CODE"]["hash"].'&autoplay=1' : '')*/;
	}
	elseif ($arResult["VIDEO"]["TYPE"]=="rutube")
	{
		$arResult["VIDEO"]["CODE"]=GetRutubeCode($arResult["PROPERTIES"]["video"]["VALUE"]);
		$arResult["VIDEO"]["SRC"]="https://rutube.ru/play/embed/".$arResult["VIDEO"]["CODE"]."/";
	}
}
if ($arResult["PROPERTIES"]["video"]["VALUE"] || $arResult["DISPLAY_PROPERTIES"]["video_local"]["DISPLAY_VALUE"])
{
	if ($arResult["DISPLAY_PROPERTIES"]["video_picture"]["FILE_VALUE"]["SRC"])
		$arResult["VIDEO"]["IMG"]=$arResult["DISPLAY_PROPERTIES"]["video_picture"]["FILE_VALUE"]["SRC"];
	else
		$arResult["VIDEO"]["IMG"]=$arResult["PREVIEW_PICTURE"]["SRC"];
}
?>
<!-- about -->
<section class="about" id="about">
	<div class="grid">
		<div class="grid__row about__row">
			<div class="grid__col about__col-head">
				<h2 class="title title--h2 about__title"><?=$arResult["NAME"]?></h2>
				<div class="about__gallery">
					<div class="grid__row">
						<?if ($arResult["DISPLAY_PROPERTIES"]["video_local"]["DISPLAY_VALUE"]):?>
							<div class="grid__col">
								<a class="card-about-gallery b-img b-img--square" data-fancybox-video data-src="#promo">
									<?if ($arResult["VIDEO"]["IMG"]):?>
									<img src="<?=$arResult["VIDEO"]["IMG"]?>" alt="" loading="lazy">
									<?endif?>
									<button class="button-video about__btn-video"></button>
								</a>
							</div>
							<div id="promo" style="display:none;">
								<?=$arResult["DISPLAY_PROPERTIES"]["video_local"]["DISPLAY_VALUE"]?>
							</div>
							<?/*<div class="grid__col">
								<?=$arResult["DISPLAY_PROPERTIES"]["video_local"]["DISPLAY_VALUE"]?>
							</div>*/?>
						<?elseif ($arResult["VIDEO"]["SRC"] && $arResult["VIDEO"]["TYPE"]=="youtube"):?>
							<div class="grid__col">
								<a class="card-about-gallery b-img b-img--square" data-fancybox data-src="<?=$arResult["VIDEO"]["SRC"]?>">
									<?if ($arResult["VIDEO"]["IMG"]):?>
									<img src="<?=$arResult["VIDEO"]["IMG"]?>" alt="" loading="lazy">
									<?endif?>
									<button class="button-video about__btn-video"></button>
								</a>
							</div>
						<?elseif($arResult["VIDEO"]["SRC"]):?>
							<div class="grid__col">
								<a class="card-about-gallery b-img b-img--square" data-fancybox data-type="iframe" data-width="100%" data-height="100%" data-src="<?=$arResult["VIDEO"]["SRC"]?>">
									<?if ($arResult["VIDEO"]["IMG"]):?>
									<img src="<?=$arResult["VIDEO"]["IMG"]?>" alt="" loading="lazy">
									<?endif?>
									<button class="button-video about__btn-video"></button>
								</a>
							</div>
							<?/*<div class="grid__col">
								<iframe src="<?=$arResult["VIDEO"]["SRC"]?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" ></iframe>
							</div>*/?>
							
						<?endif?>
						<?if (is_array($arResult["DETAIL_PICTURE"]) && is_array($arResult["PREVIEW_PICTURE"])):?>
							<div class="grid__col">
								<a class="card-about-gallery b-img b-img--square" data-fancybox data-src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
									<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="" loading="lazy">
								</a>
							</div>
						<?endif?>
					</div>	
				</div>
			</div>
			<div class="grid__col about__col-content">
				<div class="b-editor">
					<?=$arResult["PREVIEW_TEXT"]?>
				</div>
				<?if(count(($arResult["PROPERTIES"]["digits"]["VALUE"]))>0):?>
				<div class="about__digits">
					<?foreach($arResult["PROPERTIES"]["digits"]["VALUE"] as $k=>$val):?>
						<div class="card-digit">
							<div class="card-digit__title title title--h2"><?=$val?></div>
							<div class="card-digit__txt"><?=$arResult["PROPERTIES"]["digits"]["DESCRIPTION"][$k]?></div>
						</div>
					<?endforeach?>
				</div>
				<?endif?>
				<button class="button button--blue about__btn" data-fancybox="" data-src="#modal-call"><?=GetMessage('PROMO_FORM_BTN')?></button>
			</div>
		</div>
	</div>
</section>
<!-- \ about -->
