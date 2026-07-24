<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$arResult["OFFERS_CHANGE"]=["length", "sizes"];

foreach($arResult["MORE_PHOTO"] as $k=>$arItem)
{
	$file = CFile::ResizeImageGet($arItem["ID"], array('width'=>680, 'height'=>680), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false, false, 100);
	$arResult["MORE_PHOTO"][$k]["IMG"]=array("WIDTH"=>$file["width"], "HEIGHT"=>$file["height"], "SRC"=>$file["src"]);
}
$code=($arParams["IBLOCK_ID"]==4 || $arParams["IBLOCK_ID"]==16 || $arParams["IBLOCK_ID"]==28 ? 'rent': 'sale');
if ($arResult["PROPERTIES"][$code]["VALUE"]>0)
{
	$rs=CIBlockElement::GetList([],["ID"=>$arResult["PROPERTIES"][$code]["VALUE"], "ACTIVE"=>"Y"], false, ["nTopCount"=>1], ["DETAIL_PAGE_URL"]);
	if ($ar=$rs->GetNext())
		$arResult["LINKED"]=["URL"=>$ar["DETAIL_PAGE_URL"], "NAME"=>($code=="rent" ? GetMessage("RENT_LINKED_RENT") : GetMessage("RENT_LINKED_SALE"))];
}

$arResult["OFFERS_PROP"]=[];
usort($arResult['OFFERS'], function($a, $b){
	return ($a['SORT'] - $b['SORT']);
});
if (!$arParams['OFFERS_SELECTED'])
	$arResult['OFFERS_SELECTED']=0;
foreach ($arResult["OFFERS"] as $k=>$arItem)
{
	if ($arParams['OFFERS_SELECTED'] && $arItem["ID"]==$arParams['OFFERS_SELECTED'])
		$arResult['OFFERS_SELECTED']=$k;
	foreach($arItem["DISPLAY_PROPERTIES"] as $code=>$arProp)
	{
		if (!in_array($code, $arResult["OFFERS_CHANGE"])) continue;
		if ($arProp["DISPLAY_VALUE"])
		{
			if (!isset($arResult["OFFERS_PROP"][$code]))
				$arResult["OFFERS_PROP"][$code]=["NAME"=>$arProp["NAME"], "PROPS"=>[]];
			$arResult["OFFERS_PROP"][$code]["PROPS"][$arProp["DISPLAY_VALUE"]]=$arItem["ID"];
		}
	}
	
	foreach($arItem["MORE_PHOTO"] as $k2=>$arPhoto)
	{
		$file = CFile::ResizeImageGet($arPhoto["ID"], array('width'=>680, 'height'=>680), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true, false, false, 100);
		$arResult["OFFERS"][$k]["MORE_PHOTO"][$k2]["IMG"]=array("WIDTH"=>$file["width"], "HEIGHT"=>$file["height"], "SRC"=>$file["src"]);
		foreach($arResult["MORE_PHOTO"] as $k3=>$arPhoto2)
		{
			if ($arPhoto["ID"]==$arPhoto2["ID"])
			{
				unset($arResult["MORE_PHOTO"][$k3]);
			}
		}
	}
}
//print_r($arResult["OFFERS_PROP"]);