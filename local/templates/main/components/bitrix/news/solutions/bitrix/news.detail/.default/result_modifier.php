<?
$arResult["RENT"]=[];
$arResult["SALE"]=[];
$arResult["OPTIONS"]=[];
if (count((array)$arResult["PROPERTIES"]["rent"]["VALUE"])>0)
{
	$rs=CIBlockElement::GetList(["SORT"=>"ASC", "NAME"=>"ASC"], ["IBLOCK_ID"=>$arResult["PROPERTIES"]["rent"]["LINK_IBLOCK_ID"], "ID"=>$arResult["PROPERTIES"]["rent"]["VALUE"], "ACTIVE"=>"Y"], false, false, ["ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]);
	while ($ar=$rs->GetNext())
	{
		$ar["PREVIEW_PICTURE"]=CFile::GetFileArray($ar["PREVIEW_PICTURE"]);
		$arResult["RENT"][]=$ar;
	}
}
if (count((array)$arResult["PROPERTIES"]["sale"]["VALUE"])>0)
{
	$rs=CIBlockElement::GetList(["SORT"=>"ASC", "NAME"=>"ASC"], ["IBLOCK_ID"=>$arResult["PROPERTIES"]["sale"]["LINK_IBLOCK_ID"], "ID"=>$arResult["PROPERTIES"]["sale"]["VALUE"], "ACTIVE"=>"Y"], false, false, ["ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "DETAIL_PAGE_URL"]);
	while ($ar=$rs->GetNext())
	{
		$ar["PREVIEW_PICTURE"]=CFile::GetFileArray($ar["PREVIEW_PICTURE"]);
		$arResult["SALE"][]=$ar;
	}
}

if (count((array)$arResult["PROPERTIES"]["options"]["VALUE"])>0)
{
	$arResult["OPTIONS"]=$arResult["PROPERTIES"]["options"]["VALUE"];
	$this->__component->SetResultCacheKeys(["OPTIONS"]);
}
?>