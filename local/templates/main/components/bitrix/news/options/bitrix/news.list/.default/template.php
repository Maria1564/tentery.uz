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
		<div class="grid__row grid__row--3">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="grid__col" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<?if($arItem["DETAIL_TEXT"]):?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card-option card-option--vertical">
					<?else:?>
					<a href="#" class="card-option card-option--vertical" data-fancybox="" data-src="#modal-service" onclick="document.getElementById('service').value='<?=$arItem["NAME"]?>';">
					<?endif?>
						<div class="card-option__img">
							<div class="b-img">
								<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" loading="lazy" />
							</div>
						</div>
						<div class="card-option__content">
							<h3 class="card-option__title title title--h3"><?=$arItem["NAME"]?></h3>
							<div class="card-option__txt"><?=$arItem["PREVIEW_TEXT"]?></div>
							<div class="card-option__more button-moreLong">
								<?if($arItem["DETAIL_TEXT"]):?>
								<span><?=GetMessage('PROJECTS_MORE')?></span>
								<button class="button-icon button-icon--angle"></button>
								<?else:?>
								<span><?=GetMessage('OPTION_REQUEST_OPTION');?></span>
								<?endif?>
							</div>
						</div>            
					</a>
				</div>
			<?endforeach?>
		</div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
	</div>
</section>
<!-- \ page-main -->
