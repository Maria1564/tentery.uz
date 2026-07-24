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
<!-- categories -->
<section class="categories" id="categories">
  <div class="grid">
    <div class="categories__head section-head ">
      <h2 class="title title--xl"><?=GetMessage('CATALOG_MAIN_TITLE')?></h2>
      <div class="categories__nav b-nav">
        <button class="button-small js-toggleCats" data-id="cat-sell"><?=GetMessage('CATALOG_MAIN_SALE')?></button>
        <button class="button-small js-toggleCats" data-id="cat-rent"><?=GetMessage('CATALOG_MAIN_RENT')?></button>
      </div>
    </div>
    <div class="swiper-container categories__slider">
      <div class="swiper-wrapper">
	  	<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="swiper-slide js-itemCats" id="<?=$this->GetEditAreaId($arItem['ID']);?>" data-category="<?=(in_array($arItem["IBLOCK_CODE"], ["sale", "sale_en", "sale_uz"]) ? 'cat-sell' : 'cat-rent')?>">
			  <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card-category">
				<div class="card-category__img b-img">
				  <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" loading="lazy" />
				</div>
				<div class="card-category__content">
				  <h3 class="card-category__title"><?=$arItem['NAME']?></h3>
				  <div class="card-category__txt"><?=$arItem["PREVIEW_TEXT"]?></div>
				  <div class="card-category__more button-more"><?=GetMessage('CATALOG_MAIN_MORE')?>
					<svg>
					  <use xlink:href="#icon-angle-r"></use>
					</svg>
				  </div>
				</div>
			  </a>
			</div>
		<?endforeach?>
      </div>
    </div>
  </div>
</section>
