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
<!-- works -->
<section class="works" id="works">
  <div class="grid">
    <div class="works__head section-head">
      <h2 class="title title--xl"><?=GetMessage('PROJECTS_TITLE')?></h2>
      <div class="works-slider__nav b-nav">
        <button class="button-icon button-icon--angle button-slider button-slider--prev"></button>
        <button class="button-icon button-icon--angle button-slider button-slider--next"></button>
      </div>
      <div class="works__nav b-nav" data-tabs-target=".works__tabs">
        <button class="button-small button-small--icon" data-tabs-id="tab-list">
          <svg>
            <use xlink:href="#icon-list"></use>
          </svg>
          <span><?=GetMessage('PROJECTS_TAB_LIST')?></span>
        </button>
        <button class="button-small button-small--icon" data-tabs-id="tab-map">
          <svg>
            <use xlink:href="#icon-location1"></use>
          </svg>
          <span><?=GetMessage('PROJECTS_TAB_MAP')?></span>
        </button>
      </div>
    </div>
    <div class="works__tabs">
      <div class="works__tabsItem" data-tabs-item="tab-list">
        <div class="swiper-container works__slider">
          <div class="swiper-wrapper">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
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
      </div>
      <div class="works__tabsItem" data-tabs-item="tab-map">
        <div class="works-map" id="works-map" data-map='{"coords":[<?=$arParams["MAP_POINT"]?>],"pointer":"<?=SITE_TEMPLATE_PATH?>/img/pointer-round.svg","zoom":"4"}'></div>
      </div>
    </div>
  </div>
</section>
<!-- \ works -->
