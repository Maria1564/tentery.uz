<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "");
$APPLICATION->SetPageProperty("keywords", "Склады в Узбекистане, Ангары в Узбекистане, Склад или аргар в Ташкенте.");
$APPLICATION->SetPageProperty("description", "Проектируем, производим и монтируем быстровозводимую инфраструктуру в любой точке Узбекистана. Сборно-разборные решения. Здания с жесткими стенами. Ангары. Мы предложим современные варианты быстровозводимых конструкций, которые будут дешевле и практичнее многих других популярных вариантов.");
$APPLICATION->SetTitle("Склады");
?>
<div class="grid">
	<div class="text-content" style="margin-bottom: 50px;">
		<p>Проектируем, производим и монтируем быстровозводимую инфраструктуру в Ташкенте и любой точке Узбекистана.
			Наши решения отличаются высоким качеством материалов и исполнения, длительным сроком службы, удобством
			использования, современными технологиями и передовыми эксплуатационными свойствами. Даём гарантию и
			оказываем техническую поддержку (в том числе выездную) на всём периоде эксплуатации наших конструкций.
			Предоставляем полный комплекс услуг, закрывающий все потребности клиента в процессе использования склада,
			ангара или быстровозводимого здания.</p>
	</div>
</div>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"technologies",
	array(
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
		"FIELD_CODE" => array("PREVIEW_TEXT", "PREVIEW_PICTURE"),
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
); ?>
<section class="warehouse__section">
	<div class="grid">
		<h2 class="warehouse__title">Опции</h2>

		<div class="warehouse-options__list">
			<? $APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"warehouse_options",
				array(
					"IBLOCK_TYPE" => "about",
					"IBLOCK_ID" => "7",
					"NEWS_COUNT" => "8",

					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "NAME",
					"SORT_ORDER2" => "ASC",

					"FIELD_CODE" => array(
						"PREVIEW_TEXT",
						"PREVIEW_PICTURE",
					),
					"PROPERTY_CODE" => array(),

					"DETAIL_URL" => "",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "N",

					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",

					"CHECK_DATES" => "N",
					"SET_TITLE" => "N",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_META_DESCRIPTION" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
				)
			); ?>
		</div>
	</div>
</section>
<section class="warehouse__section">
	<div class="grid">
		<a class="card-about-gallery b-img b-img--square warehouse-video__wrapper" data-fancybox-video=""
			data-src="#promo">
			<img src="<?= SITE_TEMPLATE_PATH ?>/img/uploads/bg-video.png" class="warehouse-video__img" alt=""
				loading="lazy">
			<button class="button-video about__btn-video"></button>
		</a>
		<div id="promo" style="display: none;">
			<iframe width="900" height="506" src="https://www.youtube.com/embed/VIDEO_ID" title="Video" frameborder="0"
				allowfullscreen>
			</iframe>
		</div>
	</div>
</section>
<section class="warehouse__section">
	<div class="grid">
		<h2 class="warehouse__title">Размеры и цены</h2>
		<div class="warehouse-prices__list">
			<? $APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"warehouse_prices",
				array(
					"IBLOCK_TYPE" => "catalog",
					"IBLOCK_ID" => "4",
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"SECTION_USER_FIELDS" => array(),
					"ELEMENT_SORT_FIELD" => "SORT",
					"ELEMENT_SORT_ORDER" => "ASC",
					"ELEMENT_SORT_FIELD2" => "NAME",
					"ELEMENT_SORT_ORDER2" => "ASC",
					"FILTER_NAME" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"SHOW_ALL_WO_SECTION" => "Y",
					"PAGE_ELEMENT_COUNT" => "4",
					"LINE_ELEMENT_COUNT" => "4",

					"FIELD_CODE" => array(
						"PREVIEW_TEXT",
						"PREVIEW_PICTURE",
					),
					"PROPERTY_CODE" => array(
						"square",
					),

					"OFFERS_FIELD_CODE" => array(),
					"OFFERS_PROPERTY_CODE" => array(),
					"OFFERS_SORT_FIELD" => "sort",
					"OFFERS_SORT_ORDER" => "asc",
					"OFFERS_SORT_FIELD2" => "id",
					"OFFERS_SORT_ORDER2" => "desc",

					"PRICE_CODE" => array(
						"BASE",
					),
					"USE_PRICE_COUNT" => "N",
					"SHOW_PRICE_COUNT" => "1",
					"PRICE_VAT_INCLUDE" => "Y",
					"CONVERT_CURRENCY" => "N",

					"BASKET_URL" => "/personal/basket.php",
					"ACTION_VARIABLE" => "action",
					"PRODUCT_ID_VARIABLE" => "id",
					"PRODUCT_QUANTITY_VARIABLE" => "quantity",
					"PRODUCT_PROPS_VARIABLE" => "prop",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_GROUPS" => "N",
					"CACHE_FILTER" => "N",
					"DISPLAY_COMPARE" => "N",

					"SET_TITLE" => "N",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_META_DESCRIPTION" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",

					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TEMPLATE" => ".default",
				)
			); ?>
		</div>
	</div>
</section>
<section class="warehouse__section">
	<div class="grid">
		<h2 class="warehouse__title">Реализованные проекты</h2>

		<div class="warehouse-gallery__list">
			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-1.png" alt="">
			</div>
			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-2.png" alt="">
			</div>
			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-3.png" alt="">
			</div>

			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-1.png" alt="">
			</div>
			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-3.png" alt="">
			</div>
			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-2.png" alt="">
			</div>

			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-3.png" alt="">
			</div>
			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-1.png" alt="">
			</div>
			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-2.png" alt="">
			</div>

			<div class="warehouse-gallery__item">
				<img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/gallery-1.png" alt="">
			</div>
			
		</div>
	</div>
</section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>