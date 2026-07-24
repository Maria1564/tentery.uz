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
<!-- home-gallery -->
<section class="home-gallery" id="home-gallery">
  <div class="grid">
    <div class="grid__row home-gallery__row">
      	<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="grid__col<?=($arItem["PREVIEW_PICTURE"]["WIDTH"]>400 ? ' grid__col--2x' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<a class="card-home-gallery" href="<?=$arItem["PROPERTIES"]["link"]["VALUE"]?>">
				  <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" loading="lazy" />
				  <div class="card-home-gallery__txt"><?=$arItem['NAME']?></div>
				</a>
			</div>
		<?endforeach?>
    </div>
  </div>
</section>
<!-- \ home-gallery -->
