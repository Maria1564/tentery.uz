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
<!-- solutions -->
<section class="solutions" id="solutions">
  <div class="grid">
    <div class="solutions__head section-head">
      <h2 class="title title--xl"><?=GetMessage('SOLUTIONS_MAIN_TITLE')?></h2>
      <div class="solutions__nav b-nav">
        <button class="button-icon button-icon--angle button-slider button-slider--prev"></button>
        <button class="button-icon button-icon--angle button-slider button-slider--next"></button>
      </div>
    </div>
    <div class="swiper-container solutions__slider">
      <div class="swiper-wrapper">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="swiper-slide"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			  <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card-solution">
				<div class="card-solution__img b-img">
				  <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" loading="lazy" />
				</div>
				<div class="card-solution__content">
				  <h3 class="card-solution__title"><?=$arItem['NAME']?></h3>
				  <div class="card-solution__txt b-editor">
					<?=$arItem["PREVIEW_TEXT"]?>
				  </div>
				</div>
			  </a>
			</div>
		<?endforeach?>
      </div>
    </div>
  </div>
</section>
<!-- \ solutions -->