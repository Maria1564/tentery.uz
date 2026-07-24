<?
$arLngIB=[
	2 =>["IB"=>3, "ID"=>3],
	3=> ["IB"=>2, "ID"=>2],
	1 =>["IB"=>2, "ID"=>2],
];


$arIB=$arLngIB[$arParams["IBLOCK_ID"]];

$arResult["OTHER"]=[];
$rs = CIblockElement::GetList([], ["ACTIVE"=>"Y", "ID"=>$arIB["ID"], "IBLOCK_ID"=> $arIB["IB"]], false, false, ["ID", "IBLOCK_ID", "PROPERTY_*"]);
if($ob = $rs->GetNextElement())
{
	$ar = $ob->GetFields();
	$ar["PROPERTIES"] = $ob->GetProperties();
	$ar["DISPLAY_PROPERTIES"]=array();
	foreach($arParams["PROPERTY_CODE"] as $pid)
	{
		$prop = &$ar["PROPERTIES"][$pid];
		if(
			(is_array($prop["VALUE"]) && count($prop["VALUE"])>0)
			|| (!is_array($prop["VALUE"]) && $prop["VALUE"] <> '')
		)
		{
			$ar["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue($ar, $prop);
		}
		\CIBlockFormatProperties::clearCache();
	}
	$arResult["OTHER"]=$ar;
}

if (is_array($arResult["PREVIEW_PICTURE"]))
{
	$file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"], array('width'=>363, 'height'=>513), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	if ($file)
	{
		$arResult["THUMB"]["SRC"]=$file["src"];
		$arResult["THUMB"]["WIDTH"]=$file["width"];
		$arResult["THUMB"]["HEIGHT"]=$file["height"];
	}
}