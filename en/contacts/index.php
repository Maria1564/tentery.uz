<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "«Tentery» tent structures contacts");
$APPLICATION->SetPageProperty("keywords", "«Tentery» Tent Contacts, Tent Construction Uzbekistan Contacts, Tent Construction Uzbekistan Contacts, Tentery Contacts.");
$APPLICATION->SetPageProperty("description", "«Tentery CA Company» sells, rents, and provides full-cycle service for tents in Uzbekistan. Tentery CA (Tentery Central Asia) is a separate division of Tentery, a leading Russian manufacturer of tent structures.");
$APPLICATION->SetTitle("Contacts");
?><?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"contacts",
	Array(
		"ACTIVE_DATE_FORMAT" => "",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "contacts",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => "3",
		"FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"",),
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "contacts",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PROPERTY_CODE" => array(0=>"phones",1=>"social",2=>"worktime",3=>"manufacturer_address",4=>"office_tashkent",5=>"email",6=>"",),
		"SET_BROWSER_TITLE" => "N",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>