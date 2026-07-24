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
    <div class="b-text options-text b-text--sticky">
      <div class="grid__row b-text__row">
        <div class="grid__col b-text__col-l options-text__col-l">
          <h1 class="title title--s40 options-text__title b-text__title"><?=$arResult["META_TAGS"]["TITLE"]?></h1>
          <div class="b-editor">
           	<?if($arResult["DETAIL_TEXT"] <> ''):?>
				<?echo $arResult["DETAIL_TEXT"];?>
			<?else:?>
				<?echo $arResult["PREVIEW_TEXT"];?>
			<?endif?>
          </div>
          <button class="button button--blue b-text__btn" data-fancybox="" data-src="#modal-service"><?=GetMessage('OPTION_REQUEST_OPTION')?></button>
        </div>
		<?if(count($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["PREVIEW"])>0):?>
			<div class="grid__col b-text__col-r">
			  <div class="swiper-container b-gallery__slider">
				<div class="swiper-wrapper">
					<?foreach ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["PREVIEW"] as $k=>$arItem):?>
						<div class="swiper-slide">
						  <div class="b-img" data-fancybox="gallery-2" data-src="<?=$arItem["SRC"]?>" > <img src="<?=$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"][$k]["SRC"]?>" alt="" width="<?=$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"][$k]["WIDTH"]?>" height="<?=$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"][$k]["HEIGHT"]?>" loading="lazy" /></div>
						</div>
					<?endforeach?>
				</div>
			  </div>
			</div>
		<?endif?>
      </div>      
    </div>

<?$this->EndViewTarget();?>

<?if (intval($arResult["PROPERTIES"]["faq"]["VALUE"])>0):?>
	<!-- page-text -->
	<section class="page-text" id="page-text">
	  <div class="grid">
		<div class="b-text">
		  <div class="grid__row b-text__row">
			<div class="grid__col b-text__col-l">
			  <h2 class="title title--h2 b-text__title"><?=GetMessage('OPTION_FAQ', ["#OPTION#"=>$arResult["NAME"]])?></h2>
			</div>
			<div class="grid__col b-text__col-r">
			  <div class="toggle-list">
				<?foreach($arResult["FAQ"] as $arItem):
					$quest=$arItem["PREVIEW_TEXT"] ? $arItem["PREVIEW_TEXT"] : $arItem["NAME"];
				?>
					<div class="toggle-list__item">
					  <div class="toggle-list__head toggle-list__button">
						<span><?=$quest?></span>
						<button class="button-icon button-icon--angle"></button>
					  </div>
					  <div class="toggle-list__content">
						<div class="toggle-list__subcontent b-editor">
							<?=$arItem["DETAIL_TEXT"]?>                
						</div>
					  </div>
					</div>
				<?endforeach?>
			  </div>
			</div>
		  </div>      
		</div>
	  </div>
	</section>
	<!-- \ page-text -->
<?endif?>

<?if(count($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["PREVIEW"])>0):?>
	<!-- gallery -->
	<section class="gallery" id="gallery">
	  <div class="grid">
		
		<div class="swiper-container gallery__slider">
		  <div class="swiper-wrapper">
			<?foreach ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["PREVIEW"] as $k=>$arItem):?>
			  <div class="swiper-slide">
				<a data-fancybox="gallery-1" data-src="<?=$arItem["SRC"]?>" class="card-gallery b-img">
				  <img src="<?=$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["FILE_VALUE"][$k]["SRC"]?>" alt="" width="<?=$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["FILE_VALUE"][$k]["WIDTH"]?>" height="<?=$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["FILE_VALUE"][$k]["HEIGHT"]?>" loading="lazy" />
				</a>
			  </div>
			<?endforeach?>
		  </div>
		</div>
	  </div>
	</section>
	<!-- \ gallery -->
<?endif?>

