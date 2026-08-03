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
//print_r($arResult);
?>
<!-- home-services -->
<section class="home-services" id="home-services">
  <div class="grid">
    <?if ($arParams["HIDE_TITLE"] !== "Y"):?>
      <h2 class="title title--h2 home-services__title"><?=GetMessage('SERVICES_MAIN_TITLE')?></h2>
    <?endif?>
    <div class="swiper-container home-services__slider">
      <div class="swiper-wrapper">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			  <a data-fancybox="" data-src="#modal-service" data-caption="<?=htmlspecialchars(GetMessage('SERVICES_MAIN_SERVICE').' '.$arItem["NAME"])?>" class="card-service">
				<?if($arItem["DISPLAY_PROPERTIES"]["icon"]["FILE_VALUE"]["SRC"]):?>
					<div class="card-service__img">
					  <img src="<?=$arItem["DISPLAY_PROPERTIES"]["icon"]["FILE_VALUE"]["SRC"]?>" alt="" width="112" height="112" loading="lazy" />
					</div>
				<?endif?>
				<h3 class="card-service__title title title--h3"><?=$arItem['NAME']?></h3>
				<div class="card-service__txt"><?=$arItem["PREVIEW_TEXT"]?></div>
				<button class="button-small card-service__btn"><?=GetMessage('SERVICES_MAIN_REQUEST')?></button>
			  </a>
			</div>
		<?endforeach?>

      </div>
    </div>
  </div>
</section>
<!-- \ home-services -->
