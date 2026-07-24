<?
$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["PREVIEW"]=[];
if ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]["SRC"])
{
	$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]=[0=>$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"]];
}
if (is_array($arResult["DETAIL_PICTURE"]))
{
	array_unshift((array)$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"], $arResult["DETAIL_PICTURE"]);
}
foreach ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["FILE_VALUE"] as $k=>$arItem)
{
	$file = CFile::ResizeImageGet($arItem, array('width'=>700, 'height'=>760), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	if ($file)
		$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]["PREVIEW"][$k]=["SRC"=>$file["src"], "WIDTH"=>$file["width"], "HEIGHT"=>$file["height"]];
}
?>