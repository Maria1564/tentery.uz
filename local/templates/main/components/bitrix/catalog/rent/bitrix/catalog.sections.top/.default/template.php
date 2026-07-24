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
?>
<!-- page-main -->
<section class="page-main" id="page-main">
	<div class="grid">
		<?foreach($arResult["SECTIONS"] as $arSection):
			if (count($arSection["ITEMS"])==0) continue;
			?>
			<div class="section-categories">
				<h2 class="title title--s40"><?=$arSection["NAME"]?></h2>
				<div class="grid__row grid__row--4 section-categories__list">
					<?
					foreach($arSection["ITEMS"] as $arElement):
						$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="grid__col" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
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
								<?foreach($arElement["PRICES"] as $code=>$arPrice):?>
									<?if($arPrice["CAN_ACCESS"]):?>
										<?if ($arPrice["VALUE"]==0):?>
											<div class="card-category__cost"><?=GetMessage('RENT_PRICE_REQUEST')?></div>
										<?elseif($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
											<div class="card-category__cost"><s><?=$arPrice["PRINT_VALUE"]?></s> <?=$arPrice["PRINT_DISCOUNT_VALUE"]?></div>
										<?else:?>
											<div class="card-category__cost"><?=GetMessage('RENT_FROM')?> <?=$arPrice["PRINT_VALUE"]?></div>
										<?endif?>
									<?endif;?>
								<?endforeach;?>
								<div class="card-category__more button-more"><?=GetMessage('RENT_MORE')?> <svg><use xlink:href="#icon-angle-r"></use></svg></div>    
							  </div>
							</a>
						</div>
					<?endforeach?>
				</div>
			</div>
		<?endforeach?>
	</div>
</section>
<!-- \ page-main -->