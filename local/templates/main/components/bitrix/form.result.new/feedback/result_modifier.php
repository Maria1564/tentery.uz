<?
$dir=$APPLICATION->GetCurDir();
foreach ($arResult["QUESTIONS"] as $FIELD_SID => &$arQuestion)
{
	if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS']))
	{
		$arQuestion["HTML_CODE"]=str_replace('class="', 'class="error ', $arQuestion["HTML_CODE"]);
	}
	$title=$arQuestion["CAPTION"].($arQuestion["REQUIRED"] == "Y" ? ' *' : '');
	$arQuestion["HTML_CODE"]=str_replace('class="', ($arQuestion["REQUIRED"] == "Y" ? ' required' : '').' placeholder="'.$title.'" class="', $arQuestion["HTML_CODE"]);
	
	
	if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] =="email")
	{
		$arQuestion["HTML_CODE"]=str_replace('type="text"', 'type="email"', $arQuestion["HTML_CODE"]);
	}
	if ($FIELD_SID  =="phone")
	{
		$arQuestion["HTML_CODE"]=str_replace('type="text"', 'type="tel"', $arQuestion["HTML_CODE"]);
	}
	if ($FIELD_SID  =="page")
	{
		$arQuestion["HTML_CODE"]=str_replace('value="', 'value="'.$dir, $arQuestion["HTML_CODE"]);
	}
}
?>