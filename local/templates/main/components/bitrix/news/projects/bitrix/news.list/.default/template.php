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
<section class="page-main archive-works-list" id="page-main">
	<div class="grid">
		<div data-tabs-item="tab-list">
			<div class="grid__row grid__row--3">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="grid__col" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card-work"<?if ($arItem["PROPERTIES"]["map"]["VALUE"]):?> data-map='{"coords":[<?=$arItem["PROPERTIES"]["map"]["VALUE"]?>],"address":""}'<?endif?>>
					  <div class="card-work__img b-img">
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" loading="lazy" />
					  </div>
					  <div class="card-work__content">
						<h3 class="card-work__title title"><?=$arItem["NAME"]?></h3>
						<div class="card-work__txt"><?=$arItem["PREVIEW_TEXT"]?></div>
						<div class="card-work__more button-moreLong">
						  <span><?=GetMessage('PROJECTS_MORE')?></span>
						  <button class="button-arr">
			                <svg class="button__arrow">
			                  <use xlink:href="#arrow-right"></use>
			                </svg>
			              </button>
						</div> 
					  </div>
					</a>
				</div>
			<?endforeach?>
			</div>
		</div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
		<div data-tabs-item="tab-map">
			<div class="works-map" id="works-map" data-map='{"coords":[<?=$arParams["MAP_POINT"]?>],"pointer":"<?=SITE_TEMPLATE_PATH?>/img/pointer-round.svg", "zoom": "4"}'></div>
		</div>
	</div>
</section>
<!-- \ page-main -->
