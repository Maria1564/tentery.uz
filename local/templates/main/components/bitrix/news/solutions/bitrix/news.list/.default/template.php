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
		<div class="grid__row grid__row--2">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$announcement = $arItem["PROPERTIES"]["announcement"]["~VALUE"] ?? '';
				$announcement = $announcement ?: $arItem["PREVIEW_TEXT"];
				if (is_array($announcement)) {
					$announcement = $announcement["TEXT"] ?? '';
				}
				?>
				<div class="grid__col" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card-solution">
					  <div class="card-solution__img b-img">
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" loading="lazy" />
					  </div> 
					  <div class="card-solution__content">
						<h3 class="card-solution__title"><?=$arItem["NAME"]?></h3>
						<div class="card-solution__txt b-editor">
							<?=$announcement?>
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
	</div>
</section>
<!-- \ page-main -->
