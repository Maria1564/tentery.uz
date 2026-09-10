<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);

if (!function_exists('getWarehouseFirstOfferPrice')) {
    function getWarehouseFirstOfferPrice($productId, $productIblockId)
    {
        if (!CModule::IncludeModule('catalog') || !CModule::IncludeModule('currency')) {
            return null;
        }

        $skuInfo = CCatalogSKU::GetInfoByProductIBlock((int) $productIblockId);

        if (empty($skuInfo['IBLOCK_ID']) || empty($skuInfo['SKU_PROPERTY_ID'])) {
            return null;
        }

        $offer = CIBlockElement::GetList(
            array('SORT' => 'ASC', 'ID' => 'ASC'),
            array(
                'IBLOCK_ID' => (int) $skuInfo['IBLOCK_ID'],
                'PROPERTY_' . (int) $skuInfo['SKU_PROPERTY_ID'] => (int) $productId,
                'ACTIVE' => 'Y',
            ),
            false,
            array('nTopCount' => 1),
            array('ID')
        )->Fetch();

        if (!$offer) {
            return null;
        }

        $price = CPrice::GetBasePrice((int) $offer['ID']);

        if (!$price) {
            $price = CPrice::GetList(
                array('CATALOG_GROUP_ID' => 'ASC'),
                array('PRODUCT_ID' => (int) $offer['ID'])
            )->Fetch();
        }

        if (!$price || (float) $price['PRICE'] <= 0) {
            return null;
        }

        return array(
            'RATIO_PRICE' => (float) $price['PRICE'],
            'PRINT_RATIO_PRICE' => CurrencyFormat((float) $price['PRICE'], $price['CURRENCY']),
        );
    }
}

if (!function_exists('getWarehouseProductBasePrice')) {
    function getWarehouseProductBasePrice($productId)
    {
        if (!CModule::IncludeModule('catalog') || !CModule::IncludeModule('currency')) {
            return null;
        }

        $price = CPrice::GetBasePrice((int) $productId);

        if (!$price) {
            $price = CPrice::GetList(
                array('CATALOG_GROUP_ID' => 'ASC'),
                array('PRODUCT_ID' => (int) $productId)
            )->Fetch();
        }

        if (!$price || (float) $price['PRICE'] <= 0) {
            return null;
        }

        return array(
            'RATIO_PRICE' => (float) $price['PRICE'],
            'PRINT_RATIO_PRICE' => CurrencyFormat((float) $price['PRICE'], $price['CURRENCY']),
        );
    }
}
?>

<?foreach($arResult["ITEMS"] as $arElement):?>
    <?
    $this->AddEditAction(
        $arElement['ID'],
        $arElement['EDIT_LINK'],
        CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT")
    );

    $this->AddDeleteAction(
        $arElement['ID'],
        $arElement['DELETE_LINK'],
        CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"),
        array("CONFIRM" => GetMessage('CT_BCST_ELEMENT_DELETE_CONFIRM'))
    );

    $haveOffers = !empty($arElement['OFFERS']);

    if ($haveOffers) {
        $actualItem = $arElement['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arElement['OFFERS']);
    } else {
        $actualItem = $arElement;
    }

    $price = array();

    if (isset($actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']])) {
        $price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
    }

    if (empty($price) || (float) $price["RATIO_PRICE"] <= 0) {
        $offerPrice = getWarehouseFirstOfferPrice($arElement['ID'], $arParams["IBLOCK_ID"]);

        if ($offerPrice) {
            $price = $offerPrice;
        }
    }

    if (empty($price) || (float) $price["RATIO_PRICE"] <= 0) {
        $productPrice = getWarehouseProductBasePrice($arElement['ID']);

        if ($productPrice) {
            $price = $productPrice;
        }
    }
    ?>

    <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"
       class="card-category"
       id="<?=$this->GetEditAreaId($arElement['ID']);?>">

        <div class="card-category__img b-img">
            <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
                <img src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>"
                     width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>"
                     height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>"
                     alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>"
                     title="<?=$arElement["PREVIEW_PICTURE"]["TITLE"]?>"
                     loading="lazy">
            <?endif?>
        </div>

        <div class="card-category__content">
            <h3 class="card-category__title">
                <?=$arElement["NAME"]?>
            </h3>

            <div class="card-category__txt">
                <?=$arElement["PREVIEW_TEXT"]?>
            </div>

            <?foreach($arElement["DISPLAY_PROPERTIES"] as $arProp):?>
                <?if ($arProp["CODE"]=="square") {
                    $arProp["DISPLAY_VALUE"] = str_replace(
                        ["m2", "м2"],
                        ["m<sup>2</sup>", "м<sup>2</sup>"],
                        $arProp["DISPLAY_VALUE"]
                    );
                }?>
                <div class="card-category__size">
                    <?=$arProp["DISPLAY_VALUE"]?>
                </div>
            <?endforeach?>

            <?if (empty($price) || (float) $price["RATIO_PRICE"] <= 0):?>
                <div class="card-category__cost">Цена по запросу</div>
            <?else:?>
                <div class="card-category__cost">
                    от <?=$price["PRINT_RATIO_PRICE"]?>
                </div>
            <?endif?>

            <div class="card-category__more button-more">
                Подробнее
                <svg>
                    <use xlink:href="#icon-angle-r"></use>
                </svg>
            </div>
        </div>
    </a>
<?endforeach?>
