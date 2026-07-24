<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections", 
	"", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "28",
		"SECTION_ID" => "",
		"DEPTH_LEVEL" => "1",
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => "/uz/catalog/",
		"SECTION_PAGE_URL" => "/#SECTION_CODE#/",
		"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
	),
	false
);
$aMenuLinks=array_merge($aMenuLinks, $aMenuLinksExt);