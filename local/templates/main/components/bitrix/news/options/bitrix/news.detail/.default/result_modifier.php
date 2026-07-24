<?
$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["PREVIEW"]=[];
$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["PREVIEW"]=[];
$arResult["FAQ"]=[];
if ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["SRC"])
	$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]=[0=>$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]];
if ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["FILE_VALUE"]["SRC"])
	$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["FILE_VALUE"]=[0=>$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["FILE_VALUE"]];

if(!is_array($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]))
	$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]=[];
if (is_array($arResult["DETAIL_PICTURE"]))
{
	array_unshift($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"], $arResult["DETAIL_PICTURE"]);
}
foreach ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"] as $k=>$arItem)
{
	$file = CFile::ResizeImageGet($arItem, array('width'=>700, 'height'=>460), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	if ($file)
		$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["PREVIEW"][$k]=["SRC"=>$file["src"], "WIDTH"=>$file["width"], "HEIGHT"=>$file["height"]];
}

foreach ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO2"]["FILE_VALUE"] as $k=>$arItem)
{
	$file = CFile::ResizeImageGet($arItem, array('width'=>700, 'height'=>460), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	if ($file)
		$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["PREVIEW"][$k]=["SRC"=>$file["src"], "WIDTH"=>$file["width"], "HEIGHT"=>$file["height"]];
}

if (intval($arResult["PROPERTIES"]["faq"]["VALUE"])>0)
{
	$rs=CIBlockElement::GetList(["SORT"=>"ASC", "NAME"=>"ASC"], ["IBLOCK_ID"=>$arResult["PROPERTIES"]["faq"]["LINK_IBLOCK_ID"], "SECTION_ID"=>$arResult["PROPERTIES"]["faq"]["VALUE"], "ACTIVE"=>"Y"], false, false, ["ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT"]);
	while ($ar=$rs->GetNext())
	{
		$arResult["FAQ"][]=$ar;
	}
}
?>