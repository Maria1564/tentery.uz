<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
?>
<?
foreach($arResult["ITEMS"] as $arElement):
	$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM')));
	$haveOffers = !empty($arElement['OFFERS']);
	if ($haveOffers)
	{
		$actualItem = $arElement['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arElement['OFFERS']);
	}
	else
	{
		$actualItem = $arElement;
	}
	$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
	?>
	<div class="swiper-slide js-itemCats" data-category="<?=$arElement["IBLOCK_ID"]==4 ? 'cat-sell' : 'cat-rent'?>" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="card-category">
		  <div class="card-category__img b-img">
			<?if(is_array($arElement["PREVIEW_PICTURE"])):?>
				<img src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arElement["PREVIEW_PICTURE"]["TITLE"]?>" loading="lazy" />
			<?endif?>
		  </div>
		  <div class="card-category__content">
			<h3 class="card-category__title"><?=$arElement["NAME"]?></h3>
			<div class="card-category__txt"><?=$arElement["PREVIEW_TEXT"]?></div>
			<?foreach($arElement["DISPLAY_PROPERTIES"] as $arProp):?>
				<?if ($arProp["CODE"]=="square") $arProp["DISPLAY_VALUE"]=str_replace(["m2", "м2"],["m<sup>2</sup>", "м<sup>2</sup>"], $arProp["DISPLAY_VALUE"]);?>
				<div class="card-category__size"><?=$arProp["DISPLAY_VALUE"]?></div>
			<?endforeach?>
			<?if ($price["RATIO_PRICE"]==0):?>
				<div class="card-category__cost"><?=GetMessage('RENT_PRICE_REQUEST')?></div>
			<?else:?>
				<div class="card-category__cost"><?=GetMessage('RENT_FROM')?> <?=$price["PRINT_RATIO_PRICE"]?></div>
			<?endif?>
			<div class="card-category__more button-more"><?=GetMessage('RENT_MORE')?> <svg><use xlink:href="#icon-angle-r"></use></svg></div>    
		  </div>
		</a>
	</div>
<?endforeach?>