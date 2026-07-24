<?
foreach($arResult["ITEMS"] as $k=>$arItem)
{
	$file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>140, 'height'=>100), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	if ($file)
	{
		$arResult["ITEMS"][$k]["~PREVIEW_PICTURE"]=$arResult["ITEMS"][$k]["PREVIEW_PICTURE"];
		$arResult["ITEMS"][$k]["PREVIEW_PICTURE"]=["SRC"=>$file["src"], "WIDTH"=>$file["width"], "HEIGHT"=>$file["height"]];
	}
}
$arResult["PICTURE"]=CFile::GetFileArray($arResult["PICTURE"]);
if ($arParams["BG"])
	$arResult["PICTURE"]["SRC"]=$arParams["BG"];
if ($arParams["TITLE"])
	$arResult["TITLE"]=$arParams["TITLE"];
else
	$arResult["TITLE"]=$arResult["DESCRIPTION"];
//print_r($arResult);