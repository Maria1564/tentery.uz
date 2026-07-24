<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("text-page", "Y");
$APPLICATION->SetPageProperty("page-class", "page-contacts");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("К сожалению, такой страницы не существует");
?>
<div class="text-404">Попробуйте проверить и ввести адрес заново или вернитесь на <a href="<?=SITE_DIR?>">Главную страницу</a></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>