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
        </div>
        <div class="grid__col b-text__col-r gallery-top-text">
          <div class="b-editor">
           	<?if($arResult["DETAIL_TEXT"] <> ''):?>
				<?echo $arResult["DETAIL_TEXT"];?>
			<?else:?>
				<?echo $arResult["PREVIEW_TEXT"];?>
			<?endif?>
          </div>
        </div>
      </div>      
    </div>
<?$this->EndViewTarget();?>


<?if(count($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["PREVIEW"])>0):?>
<!-- gallery -->
<section class="gallery gallery-pr" id="gallery">
  <div class="grid">
    <div class="gallery__container">
      <div class="swiper-container gallery__slider">
        <div class="swiper-wrapper">
      <?foreach ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["PREVIEW"] as $k=>$arItem):?>
            <div class="swiper-slide">
              <a data-fancybox="gallery-1" data-src="<?=$arItem["SRC"]?>" class="card-gallery b-img">
                <img src="<?=$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"][$k]["SRC"]?>" alt="" width="<?=$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"][$k]["WIDTH"]?>" height="<?=$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"][$k]["HEIGHT"]?>" loading="lazy" />
              </a>
            </div>
      <?endforeach?>
        </div>

      </div>
      <button class="button-icon button-icon--angle button-slider button-slider--prev"></button>
      <button class="button-icon button-icon--angle button-slider button-slider--next"></button>
    </div>

    <div class="b-editor gallery-bottom-text">
      <?if($arResult["DETAIL_TEXT"] <> ''):?>
        <?echo $arResult["DETAIL_TEXT"];?>
      <?else:?>
        <?echo $arResult["PREVIEW_TEXT"];?>
      <?endif?>
    </div>
  </div>
</section>
<!-- \ gallery -->
<?endif?>