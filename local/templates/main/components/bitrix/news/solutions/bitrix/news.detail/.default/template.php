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

<?$this->SetViewTarget('h1');?>
    <div class="b-text">
      <div class="grid__row b-text__row">
        <div class="grid__col">
          <h1 class="title title--h1 b-text__title"><?=$arResult["META_TAGS"]["TITLE"]?></h1>
          <div class="page-img__img b-img">
			      <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["PREVIEW_PICTURE"]["ALT"]?>">
			    </div>
        </div>
        <div class="grid__col b-text__col-r">
          <div class="b-editor">
            <?if($arResult["DETAIL_TEXT"] <> ''):?>
				<?echo $arResult["DETAIL_TEXT"];?>
			<?else:?>
				<?echo $arResult["PREVIEW_TEXT"];?>
			<?endif?>
          </div>
          <button class="button button--blue b-text__btn" data-fancybox="" data-src="#modal-service"><?=GetMessage('SOLUTIONS_REQUEST')?></button>
        </div>
      </div>      
    </div>
<?$this->EndViewTarget();?>

<?if (is_array($arResult["DETAIL_PICTURE"])):?>
<!-- page-img -->
<section class="page-img" id="page-img">
  <div class="grid">
    <div class="page-img__img b-img">
      <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["PREVIEW_PICTURE"]["ALT"]?>">
    </div>
  </div>
</section>
<!-- \ page-img -->
<?endif?>

 <?if (count($arResult["SALE"])>0):?>
<!-- categories -->
<section class="categories" id="categories">
  <div class="grid">
    <div class="categories__head section-head section-head--align-top">
      <h2 class="title title--xl"><?=$arResult["PROPERTIES"]["title_products"]["~VALUE"] ? $arResult["PROPERTIES"]["title_products"]["~VALUE"] : GetMessage('SOLUTIONS_TYPES_TENTS')?></h2>
      <div class="categories__nav b-nav">
        <?if (count($arResult["SALE"])>0):?>
		<button class="button-small js-toggleCats" data-id="cat-sell"><?=GetMessage('SOLUTIONS_SALE')?></button>
		<?endif?>
		<?if (count($arResult["RENT"])>0):?>
			<button class="button-small js-toggleCats" data-id="cat-rent"><?=GetMessage('SOLUTIONS_RENT')?></button>
		<?endif?>
      </div>      
    </div>
    <div class="swiper-container categories__slider">
      <div class="swiper-wrapper">
		<?foreach ($arResult["SALE"] as $arItem):?>
			<div class="swiper-slide js-itemCats" data-category="cat-sell">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card-category">
				  <div class="card-category__img b-img">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=htmlspecialchars($arItem["NAME"])?>" title="<?=htmlspecialchars($arItem["NAME"])?>" loading="lazy" />
				  </div>
				  <div class="card-category__content">
					<h3 class="card-category__title"><?=$arItem["NAME"]?></h3>
					<div class="card-category__txt"><?=$arItem["PREVIEW_TEXT"]?></div>
					<div class="card-category__more button-more"><?=GetMessage('SOLUTIONS_MORE')?> <svg><use xlink:href="#icon-angle-r"></use></svg></div>    
				  </div>
				</a>
			</div>
		<?endforeach?>
		<?foreach ($arResult["RENT"] as $arItem):?>
			<div class="swiper-slide js-itemCats" data-category="cat-rent">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="card-category">
				  <div class="card-category__img b-img">
					<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=htmlspecialchars($arItem["NAME"])?>" title="<?=htmlspecialchars($arItem["NAME"])?>" loading="lazy" />
				  </div>
				  <div class="card-category__content">
					<h3 class="card-category__title"><?=$arItem["NAME"]?></h3>
					<div class="card-category__txt"><?=$arItem["PREVIEW_TEXT"]?></div>
					<div class="card-category__more button-more"><?=GetMessage('SOLUTIONS_MORE')?> <svg><use xlink:href="#icon-angle-r"></use></svg></div>    
				  </div>
				</a>
			</div>
		<?endforeach?>
      </div>
    </div>
  </div>
</section>
<!-- \ categories -->
<?endif?>

