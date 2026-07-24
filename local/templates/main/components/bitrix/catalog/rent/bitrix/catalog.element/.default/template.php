<?
//print_r($arResult);

$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => [
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	],
];
if ($haveOffers)
{
	$templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
	$templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DESCRIPTION_ID' => $mainId.'_description',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];
if ($haveOffers)
{
	$actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
	$showSliderControls = false;
	
	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 0)
		{
			$showSliderControls = true;
			break;
		}
	}
	if (!$arParams['OFFERS_SELECTED'])
		$arParams['OFFERS_SELECTED']=$actualItem["ID"];
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}


$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['OFFERS_SELECTED'])
{
	foreach ($arResult["OFFERS_PROP"] as $code=>$arItem)
		foreach($arItem["PROPS"] as $val=>$offer)
		{
			if ($arParams['OFFERS_SELECTED']==$offer)
			{
				$orig_name=$name;
				$name.= ' '.$val;
			}
		}
	
}
?>

<script>
function setPropOrder()
{
	let txt='';
	document.querySelectorAll('.category-form__cost').forEach(price => {});
	checkboxes = document.querySelectorAll('#prop_form input:checked').forEach(input => {
		if (input.dataset.name)
		txt+=', '+input.dataset.name+':'+input.value;
		
	});
	document.querySelectorAll('.category-form__cost').forEach(price => {
		if (price.style.display !== 'none')
		{
			txt+=', '+price.textContent;
			return;
		}
	});
	
	product=document.querySelector('form[name="order_tent"] #product');
	if (!product.dataset.orig)
		product.dataset.orig=product.value;
	product.value=product.dataset.orig+txt;
	//form name="order_tent"
}
function offerChange(th)
{
	url='<?=$APPLICATION->GetCurPageParam('', ["offer"])?>';
	if (th.dataset.offer)
	{
		url=url+(url.includes('?') ? '&' : '?')+'offer='+th.dataset.offer;
		window.history.pushState(null, null, url);
		let h1=document.getElementsByTagName('h1')[0];
		if (!h1.dataset.orig)
			h1.dataset.orig=h1.innerHTML;
		h1.innerHTML=h1.dataset.orig+ ' '+th.value;
		document.getElementsByTagName('h1')[1].innerHTML=h1.innerHTML;
		
		document.querySelectorAll('.swiper-slide').forEach(slide => {
			if (slide.dataset.offer)
				slide.style.display =  slide.dataset.offer == th.dataset.offer ? '' : 'none';
		});
		document.querySelectorAll('.category-form__table-row').forEach(prop => {
			//console.log(prop);
			if (prop.dataset.offer)
				prop.style.display =  prop.dataset.offer == th.dataset.offer ? 'flex' : 'none';
		});
		document.querySelectorAll('.category-form__cost').forEach(price => {
			price.style.display = price.id== 'price'+th.dataset.offer ? '' : 'none';
		});
	}
}
</script>
<!-- single-categories-content -->
<section class="single-categories-content" id="single-categories-content">
  <div class="grid">
    <div class="b-text b-text--sticky">
      <div class="grid__row b-text__row">
        <div class="grid__col b-text__col-l">
          <?if (count((array)$arResult["MORE_PHOTO"])>0 || $showSliderControls):?>
			  <div class="swiper-container b-gallery__slider">
				<div class="swiper-wrapper">
				  <?foreach ($arResult["MORE_PHOTO"] as $arItem):?>
					  <div class="swiper-slide">
						<div class="b-img" data-fancybox="gallery-<?=$arResult["ID"]?>" data-src="<?=$arItem["SRC"]?>"><img src="<?=$arItem["IMG"]["SRC"]?>" alt=""></div>
					  </div>
				  <?endforeach?>
				  <?if ($showSliderControls):?>
					<?foreach ($arResult["OFFERS"] as $k=>$arOffer):?>
						<?foreach ($arOffer["MORE_PHOTO"] as $arItem):?>
							<div class="swiper-slide" data-offer="<?=$arOffer["ID"]?>"<?=($arOffer["ID"] ==$actualItem["ID"] ? '': ' style="display: none;"')?>>
								<div class="b-img" data-fancybox="gallery-<?=$arOffer["ID"]?>" data-src="<?=$arItem["SRC"]?>"><img src="<?=$arItem["IMG"]["SRC"]?>" alt=""></div>
							</div>
						<?endforeach?>
					<?endforeach?>
				  <?endif?>
				</div>
			  </div>
		  <?endif?>
		  <?
				$text='';
				if ($arResult['PREVIEW_TEXT'] != ''	&& ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S' || ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == '')))
				{
					$text= $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>'.$arResult['PREVIEW_TEXT'].'</p>';
				}

				if ($arResult['DETAIL_TEXT'] != '')
				{
					$text= $arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>';
				}
				?>
		  <div class="page-header__describe"><?=$text?></div>	
        </div>
        <div class="grid__col b-text__col-r">
          <form class="category-form" id="prop_form">
            <h1 class="title title--s40 category-form__title" data-orig="<?=htmlspecialcharsbx($orig_name)?>"><?=$name?></h1>
            <div class="category-form__describe">
				<?
				$text='';
				if ($arResult['PREVIEW_TEXT'] != ''	&& ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S' || ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == '')))
				{
					$text= $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>'.$arResult['PREVIEW_TEXT'].'</p>';
				}

				if ($arResult['DETAIL_TEXT'] != '')
				{
					$text= $arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>';
				}
				echo $text;
				?>
				<?$this->SetViewTarget("h1");?>
				<h1 class="title title--s40" data-orig="<?=htmlspecialcharsbx($orig_name)?>"><?=$name?></h1>
				<?$this->EndViewTarget("h1");?>
			</div>
			<?foreach ($arResult["OFFERS_PROP"] as $code=>$arItem):?>
				<div class="category-form__length">
				  <h3 class="category-form__subtitle"><?=$arItem["NAME"]?></h3>
				  <div class="category-form__list">
					<?foreach($arItem["PROPS"] as $val=>$offer):?>
						<div class="b-check b-check--big">
						<input type="radio" name="<?=$code?>" id="<?=$code?>_<?=htmlspecialcharsbx($val)?>" data-name="<?=htmlspecialcharsbx($arItem["NAME"])?>" data-offer="<?=$offer?>" value="<?=htmlspecialcharsbx($val)?>" <?if ($arParams['OFFERS_SELECTED']==$offer):?> checked<?endif?> onclick="offerChange(this);">
						<label for="<?=$code?>_<?=htmlspecialcharsbx($val)?>"><?=$val?></label></div>
					<?endforeach?>
				  </div>
				</div>
			<?endforeach?>
			
			<?if ($price["RATIO_PRICE"]==0):?>
				<div class="category-form__cost" id="price<?=$actualItem["ID"]?>"><?=GetMessage('RENT_PRICE_REQUEST')?></div>
			<?else:?>
				<div class="category-form__cost" id="price<?=$actualItem["ID"]?>"> <?=GetMessage('RENT_FROM')?> <span><?=str_replace(' ', '</span> ', $price['PRINT_RATIO_PRICE'])?></div>
			<?endif?>
			<?foreach ($arResult["OFFERS"] as $k=>$arItem):
				if ($actualItem["ID"]==$arItem["ID"]) continue;
				$price2 = $arItem['ITEM_PRICES'][$arItem['ITEM_PRICE_SELECTED']];?>
				<?if ($price2["RATIO_PRICE"]==0):?>
					<div class="category-form__cost" id="price<?=$arItem["ID"]?>" style="display:none;"><?=GetMessage('RENT_PRICE_REQUEST')?></div>
				<?else:?>
					<div class="category-form__cost" id="price<?=$arItem["ID"]?>" style="display:none;"> <?=GetMessage('RENT_FROM')?> <span><?=str_replace(' ', '</span> ', $price2['PRINT_RATIO_PRICE'])?></div>
				<?endif?>
			<?endforeach?>
            <div class="category-form__footer">
              <button data-fancybox="" data-src="#modal-order" class="button button--blue" onclick="setPropOrder()"><?=GetMessage('RENT_ORDER_BTN')?></button>
              <?if ($arResult["LINKED"])?>
			  <a href="<?=$arResult["LINKED"]["URL"]?>" class="category-form__link"><?=$arResult["LINKED"]["NAME"]?></a>
            </div>

			<div class="category-form__props">
				<div class="category-form__props-tabs" data-tabs-target=".category-form__props-content">
					<div class="category-form__props-nav">
					  <button class="selected" data-tabs-id="tab-props-1"><?=GetMessage('RENT_TAB1')?></button>
					  <button class="s" data-tabs-id="tab-props-2"><?=GetMessage('RENT_TAB2')?></button>
					  <button class="" data-tabs-id="tab-props-3"><?=GetMessage('RENT_TAB3')?></button>
					</div>
					<div class="category-form__props-content" >
						<div data-tabs-item="tab-props-1">
						  <!-- 1 -->
							<div class="category-form__table"  data-more-list="category-form__table-1">
								<?
								//$materials=$arResult['DISPLAY_PROPERTIES']["materials"];

								unset($arResult['DISPLAY_PROPERTIES']["materials"]);
								$k=0;
								foreach ($arResult['DISPLAY_PROPERTIES'] as $property):
									if (!isset($arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']])):
										$k++
									?>
										<div class="category-form__table-row">
										  <div class="category-form__table-title"><?=$property['NAME']?></div>
											<?if(isset($arResult["PRODUCT_PROPERTIES"][$property['CODE']]) && count($arResult["PRODUCT_PROPERTIES"][$property['CODE']]["VALUES"])>0):?>
												<div class="category-form__table-content category-form__list">
													<?foreach ($arResult["PRODUCT_PROPERTIES"][$property['CODE']]["VALUES"] as $key=>$val):?>
														<div class="b-check">
															<input type="radio"
															name="<?=$property["CODE"]?>" data-name="<?=htmlspecialcharsbx($property['NAME'])?>" id="<?=$property['CODE']?>_<?=htmlspecialcharsbx($key)?>"
															value="<?=htmlspecialcharsbx($val)?>"
															<?if($arResult["PRODUCT_PROPERTIES"][$property['CODE']]["SELECTED"]==$key):?> checked<?endif?>>
															<label for="<?=$property['CODE']?>_<?=htmlspecialcharsbx($key)?>"><?=$val?></label>
														</div>
													<?endforeach?>
												</div>
											<?else:?>
												<?if ($property["CODE"]=="square") $property["DISPLAY_VALUE"]=str_replace(["m2", "м2"],["m<sup>2</sup>", "м<sup>2</sup>"], $property["DISPLAY_VALUE"])?>
												<div class="category-form__table-content"><?=(is_array($property['DISPLAY_VALUE']) ? implode(', ', $property['DISPLAY_VALUE']): $property['DISPLAY_VALUE'])?></div>
											<?endif?>
										</div>
									<?endif;
								endforeach?>
							</div>
							<?foreach ($arResult["OFFERS"] as $arOffer):
								foreach ($arOffer['DISPLAY_PROPERTIES'] as $property):
								if (!isset($arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']])):
									if (in_array($property['CODE'], $arResult["OFFERS_CHANGE"])) continue;
									//$k++
									if ($property["CODE"]=="square") $property["DISPLAY_VALUE"]=str_replace(["m2", "м2"],["m<sup>2</sup>", "м<sup>2</sup>"], $property["DISPLAY_VALUE"]);
								?>
									<div class="category-form__table-row" data-offer="<?=$arOffer["ID"]?>"<?=($arOffer["ID"] ==$actualItem["ID"] ? '': ' style="display: none;"')?>>
									  <div class="category-form__table-title"><?=$property['NAME']?></div>
									  <div class="category-form__table-content"><?=(is_array($property['DISPLAY_VALUE']) ? implode(', ', $property['DISPLAY_VALUE']): $property['DISPLAY_VALUE'])?></div>
									</div>
								<?endif;
								endforeach;
							endforeach;?>
							<?if ($k>4):?>
							<a class="category-form__toggle" data-more-text="<?=GetMessage('RENT_HIDE_MORE')?>" data-more-target="category-form__table-1"><?=GetMessage('RENT_SHOW_MORE')?></a>
							<?endif?>				  
						  <!-- \ 1 -->
						</div>
						<div data-tabs-item="tab-props-2">
						  <!-- 2 -->
							<div class="category-form__table" data-more-list="category-form__table-2">
							<?
							$k=0;
							foreach ($arResult['DISPLAY_PROPERTIES'] as $property):
								if (isset($arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']])):
									$k++;
								?>
									<div class="category-form__table-row">
									  <div class="category-form__table-title"><?=$property['NAME']?></div>
										<?if(isset($arResult["PRODUCT_PROPERTIES"][$property['CODE']]) && count($arResult["PRODUCT_PROPERTIES"][$property['CODE']]["VALUES"])>0):?>
											<div class="category-form__table-content category-form__list">
												<?foreach ($arResult["PRODUCT_PROPERTIES"][$property['CODE']]["VALUES"] as $key=>$val):?>
													<div class="b-check">
														<input type="radio"
														name="<?=$property["CODE"]?>" data-name="<?=htmlspecialcharsbx($property['NAME'])?>" id="<?=$property['CODE']?>_<?=htmlspecialcharsbx($key)?>"
														value="<?=htmlspecialcharsbx($val)?>"
														<?if($arResult["PRODUCT_PROPERTIES"][$property['CODE']]["SELECTED"]==$key):?> checked<?endif?>>
														<label for="<?=$property['CODE']?>_<?=htmlspecialcharsbx($key)?>"><?=$val?></label>
													</div>
												<?endforeach?>
											</div>
										<?else:?>
											<?if ($property["CODE"]=="square") $property["DISPLAY_VALUE"]=str_replace(["m2", "м2"],["m<sup>2</sup>", "м<sup>2</sup>"], $property["DISPLAY_VALUE"])?>
											<div class="category-form__table-content"><?=(is_array($property['DISPLAY_VALUE']) ? implode(', ', $property['DISPLAY_VALUE']): $property['DISPLAY_VALUE'])?></div>
										<?endif?>
									</div>
								<?endif;
							endforeach?>
							</div>
							<?foreach ($arResult["OFFERS"] as $arOffer):
								foreach ($arOffer['DISPLAY_PROPERTIES'] as $property):
								if (isset($arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']])):
									if (in_array($property['CODE'], $arResult["OFFERS_CHANGE"])) continue;
									//$k++;
									if ($property["CODE"]=="square") $property["DISPLAY_VALUE"]=str_replace(["m2", "м2"],["m<sup>2</sup>", "м<sup>2</sup>"], $property["DISPLAY_VALUE"]);
								?>
									<div class="category-form__table-row" data-offer="<?=$arOffer["ID"]?>"<?=($arOffer["ID"] ==$actualItem["ID"] ? '': ' style="display: none;"')?>>
									  <div class="category-form__table-title"><?=$property['NAME']?></div>
									  <div class="category-form__table-content"><?=(is_array($property['DISPLAY_VALUE']) ? implode(', ', $property['DISPLAY_VALUE']): $property['DISPLAY_VALUE'])?></div>
									</div>
								<?endif;
								endforeach;
							endforeach;?>						
							<?if ($k>4):?>
							<a class="category-form__toggle" data-more-text="<?=GetMessage('RENT_HIDE_MORE')?>" data-more-target="category-form__table-2"><?=GetMessage('RENT_SHOW_MORE')?></a>
							<?endif?>
						  <!-- \ 2 -->
						</div>
						<div data-tabs-item="tab-props-3">
						  <!-- 3 -->
							<?foreach ($arResult['PROPERTIES']["materials"]['VALUE'] as $k=>$v):?>
								<?if ($arResult['PROPERTIES']["materials"]['DESCRIPTION'][$k]):?>
									<div class="category-form__table-row">
										<div class="category-form__table-title"><?=$arResult['PROPERTIES']["materials"]['DESCRIPTION'][$k]?></div>
										<div class="category-form__table-content"><?=$v?></div>
									</div>
								<?elseif (count(explode(': ',$v))==2):?>
									<?$val=explode(': ',$v)?>
									<div class="category-form__table-row">
										<div class="category-form__table-title"><?=str_replace(['• ', '- '], ['',''], $val[0])?></div>
										<div class="category-form__table-content"><?=$val[1]?></div>
									</div>
								<?else:?>
									<?=$v?><br>
								<?endif?>
							<?endforeach?>
							<?//=implode('<br> ', (array)$materials['DISPLAY_VALUE'])?>					
						  <!-- \ 3 -->
						</div>
					</div>
				</div>
				
              <div class="category-form__props-accordeon toggle-list">
                <div class="toggle-list__item">
                  <div class="toggle-list__head toggle-list__button">
                    <span><?=GetMessage('RENT_TAB1')?></span>
                    <div class="button-icon"><svg><use href="#icon-angle-down"></use></svg></div>
                  </div>
                  <div class="toggle-list__content">
                    <div class="toggle-list__subcontent">
                      <!-- 1 -->
                      <div class="category-form__table" id="mob_tab1">
						
                      </div>      
                      <!-- \ 1 -->               
                      </div>
                  </div>
                </div>
                <div class="toggle-list__item">
                  <div class="toggle-list__head toggle-list__button">
                    <span><?=GetMessage('RENT_TAB2')?></span>
                    <div class="button-icon"><svg><use href="#icon-angle-down"></use></svg></div>
                  </div>
                  <div class="toggle-list__content">
                    <div class="toggle-list__subcontent">
                      <!-- 2 -->
                      <div class="category-form__table" id="mob_tab2">
						
                      </div>      
                    <!-- \ 2 -->
                    </div>
                  </div>
                </div>
                <div class="toggle-list__item">
                  <div class="toggle-list__head toggle-list__button">
                    <span><?=GetMessage('RENT_TAB3')?></span>
                    <div class="button-icon"><svg><use href="#icon-angle-down"></use></svg></div>
                  </div>
                  <div class="toggle-list__content">
                    <div class="category-form__table" id="mob_tab3">
						
                    </div> 
                  </div>
                </div>
              </div>
		  
			</div>
			
          </form>
        </div>
      </div>      
    </div>
  </div>
</section>
<!-- \ single-categories-content -->
<script>
	var mob_1=document.querySelector('#mob_tab1');
	document.querySelectorAll('[data-tabs-item=tab-props-1] .category-form__table-row').forEach(item => {
		var item2=item.cloneNode(true);
		mob_1.appendChild(item2);
	});
	var mob_2=document.querySelector('#mob_tab2');
	document.querySelectorAll('[data-tabs-item=tab-props-2] .category-form__table-row').forEach(item => {
		var item2=item.cloneNode(true);
		mob_2.appendChild(item2);
	});
	var mob_3=document.querySelector('#mob_tab3');
	document.querySelectorAll('[data-tabs-item=tab-props-3] .category-form__table-row').forEach(item => {
		var item2=item.cloneNode(true);
		mob_3.appendChild(item2);
	});
</script>
