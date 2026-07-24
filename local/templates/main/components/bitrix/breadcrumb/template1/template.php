<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

// Если цепочка пуста, ничего не выводим
if(empty($arResult))
	return "";

// Определяем название "Главной" в зависимости от текущего языка сайта
$mainTitle = "Главная";
if (SITE_DIR == "/en/") {
    $mainTitle = "Home";
} elseif (SITE_DIR == "/uz/") {
    $mainTitle = "Bosh sahifa";
}

// Проверяем, есть ли уже ссылка на текущую главную в начале массива
// Если нет (например, на страницах вне разделов), добавляем ее вручную
if ($arResult[0]["LINK"] !== SITE_DIR) {
    array_unshift($arResult, array(
        "TITLE" => $mainTitle,
        "LINK" => SITE_DIR,
    ));
}

$strReturn = '<div class="breadcrumbs" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">
				<span itemprop="name">'.$title.'</span>
			</a>';
	}
	else
	{
		$strReturn .= '<span>'.$title.'</span>';
	}
}

$strReturn .= '</div>';

return $strReturn;