<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "");
$APPLICATION->SetPageProperty("keywords", "Склады в Узбекистане, Ангары в Узбекистане, Склад или аргар в Ташкенте.");
$APPLICATION->SetPageProperty("description", "Проектируем, производим и монтируем быстровозводимую инфраструктуру в любой точке Узбекистана. Сборно-разборные решения. Здания с жесткими стенами. Ангары. Мы предложим современные варианты быстровозводимых конструкций, которые будут дешевле и практичнее многих других популярных вариантов.");
$APPLICATION->SetTitle("Склады");
?>
<div class="grid">
    <div class="text-content" style="margin-bottom: 50px;">
        <p>Проектируем, производим и монтируем быстровозводимую инфраструктуру в Ташкенте и любой точке Узбекистана. Наши решения отличаются высоким качеством материалов и исполнения, длительным сроком службы, удобством использования, современными технологиями и передовыми эксплуатационными свойствами. Даём гарантию и оказываем техническую поддержку (в том числе выездную) на всём периоде эксплуатации наших конструкций. Предоставляем полный комплекс услуг, закрывающий все потребности клиента в процессе использования склада, ангара или быстровозводимого здания.</p>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"technologies",
	Array(
		"ACTIVE_DATE_FORMAT" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("PREVIEW_TEXT","PREVIEW_PICTURE"),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "40",
		"IBLOCK_TYPE" => "about",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "NAME",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
<div class="grid">
    <div class="text-content" style="margin-top: 50px;">
        <p>Если вам необходимо построить или арендовать склад, разместить персонал, организовать хранение оборудования или техники, построить производственное помещение, организовать зону погрузки/разгрузки товара – обратитесь к нам. Мы предложим современные варианты быстровозводимых конструкций, которые будут дешевле и практичнее многих других популярных вариантов.</p>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>