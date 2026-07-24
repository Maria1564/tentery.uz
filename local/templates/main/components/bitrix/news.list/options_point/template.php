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
<!-- options -->
<section class="options" id="options">
  <div class="grid">
    <div class="options__wrap">
      <h2 class="title title--h2 options__title"><?=$arResult["TITLE"]?></h2>

      <div class="options__schema">
        <?if (is_array($arResult["PICTURE"])):?>
			<picture class="options__img">
			  <source srcset="<?=$arResult["PICTURE"]["SRC"]?>" media="(max-width: 480px)">
			  <img src="<?=$arResult["PICTURE"]["SRC"]?>" alt="">
			</picture>
		<?endif?>

        <div class="swiper-container options__slider">
          <div class="swiper-wrapper">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				if (empty($arItem["PROPERTIES"]["point_left"]["VALUE"]) || empty($arItem["PROPERTIES"]["point_top"]["VALUE"])) continue;
				?>
				<div class="swiper-slide">
					<div class="options__pointer" style="left: <?=$arItem["PROPERTIES"]["point_left"]["VALUE"]?>%;top: <?=$arItem["PROPERTIES"]["point_top"]["VALUE"]?>%">
						<button class="options__pointer-btn" title="<?=htmlspecialchars($arItem['NAME'])?>"></button>
						<div class="options__pointer-txt"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<?if($arItem["DETAIL_TEXT"]):?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card-option">
							<?else:?>
							<a href="#" class="card-option" data-fancybox="" data-src="#modal-service" onclick="document.querySelector('#modal-service #service').value='<?=$arItem["NAME"]?>';">
							<?endif?>
								<div class="card-option__img">
									<div class="b-img">
										<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" loading="lazy" />
									</div>
								</div>
								<div class="card-option__content">
									<h3 class="card-option__title title title--h3"><?=$arItem['NAME']?></h3>
									<div class="card-option__txt"><?=$arItem["PREVIEW_TEXT"]?></div>
									<div class="card-option__more button-moreLong">
										<?if($arItem["DETAIL_TEXT"]):?>
										<span><?=GetMessage('OPTIONS_POINT_MORE')?></span>
										<button class="button-icon button-icon--angle"></button>
										<?else:?>
										<span><?=GetMessage('OPTION_REQUEST_OPTION');?></span>
										<?endif?>
									</div>
								</div>            
							</a>
						</div>
					</div>
				</div>
			<?endforeach;?>
			  
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- \ options -->