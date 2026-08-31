<?
function GetContacts($lng=false)
{
	if (!$lng) $lng=LANGUAGE_ID;
	$arLngIB=[
	"ru" =>["IB"=>1, "ID"=>1],
	"en" =>["IB"=>3, "ID"=>3],
	"uz" =>["IB"=>2, "ID"=>2],
	];
	$arIB=$arLngIB[$lng];

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize(["IBLOCK_ID"=>$arIB["IB"], "ID"=>$arIB["ID"]]), "/iblock/contactmain"))
	{
		$ar = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		CModule::IncludeModule("iblock");
		$rs=CIBlockElement::GetProperty($arIB["IB"], $arIB["ID"]);
		if(defined("BX_COMP_MANAGED_CACHE"))
		{
			global $CACHE_MANAGER;
			$CACHE_MANAGER->StartTagCache("/iblock/contactmain");
			$CACHE_MANAGER->RegisterTag("iblock_id_".$arIB["IB"]);

			while ($ar2 = $rs->Fetch())
			{
				if (!$ar2["VALUE"]) continue;
				//if ($ar2["CODE"]=="address") $ar2["VALUE"]=nl2br($ar2["VALUE"]);
				
				if ($ar2["MULTIPLE"]=="Y")
				{
					if (!isset($ar[$ar2["CODE"]]))
						$ar[$ar2["CODE"]]=[];
					$ar[$ar2["CODE"]][]=$ar2["VALUE"];
					
					if ($ar2["DESCRIPTION"])
					{
						if (!isset($ar[$ar2["CODE"]."_desc"]))
							$ar[$ar2["CODE"]."_desc"]=[];
						$ar[$ar2["CODE"]."_desc"][]=$ar2["DESCRIPTION"];
					}
					
				}
				else
				{
					$ar[$ar2["CODE"]]=$ar2["VALUE"];
					if ($ar2["DESCRIPTION"])
						$ar[$ar2["CODE"]."_desc"]=$ar2["DESCRIPTION"];
				}
				
				//print_r($ar);
			}
			foreach ($ar as $k=>$v)
			{
				if ($k=="social")
				{
					$ar[$k]=GetSocialLinks($v);
				}
			}

			$CACHE_MANAGER->EndTagCache();
		}
		else
		{
			if(!$ar = $dbRes->Fetch())
				$ar = [];
		}
		$obCache->EndDataCache($ar);
	}
	//print_r($ar);
	return $ar;
}
function GetSocialLinks($XML_ID)
{
	$ar2=[];
	CModule::IncludeModule("highloadblock");
	$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(2)->fetch(); 
	$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock); 
	$entity_data_class = $entity->getDataClass();
	$rs = $entity_data_class::getList(array(
					   "select" => array("*"),
					   "order" => array("ID" => "ASC"),
					   "filter" => array("UF_XML_ID"=>$XML_ID)
					));	
	while($ar = $rs->Fetch()){
		$ar2[]=$ar;
	}
	return $ar2;
}

function only_numbers($string) {
    return preg_replace('~[^0-9]+~','',$string);
}

function GetYoutubeCode($url)
{
    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}

function GetVideoType($str)
{
	$type=false;
	if (strpos($str, 'youtu') !== false)
		$type='youtube';
	elseif(strpos($str, 'vk.com') !== false)
		$type='vk';
	elseif(strpos($str, 'rutube.ru') !== false)
		$type='rutube';
	return $type;
}

function GetVKVideoCode($url)
{
	/*$pattern = '~.*video_ext\.php\?oid=([0-9]+)&id=([0-9]+).*?&hash=([^&]+)~x';//hash
	preg_match($pattern, $url, $matches);
	if (isset($matches[1]) && isset($matches[2]))
		return ["oid"=>$matches[1], "id"=>$matches[2], "hash"=>$matches[3]];*/
	
	$pattern = '~.*video-([0-9]+)_([0-9]+).*?~x';
	preg_match($pattern, $url, $matches);
	return (isset($matches[1]) && isset($matches[2])) ? ["oid"=>$matches[1], "id"=>$matches[2]] : false;
}
function GetRutubeCode($url)
{
	$pattern = '~.*(video|embed)/([a-z0-9]+)/.*?~x';
	preg_match($pattern, $url, $matches);
	return (isset($matches[2])) ? $matches[2] : false;
}

function TenterySpamSecret()
{
	return md5($_SERVER["DOCUMENT_ROOT"] . "|tentery_spam_guard");
}

function TenterySpamEnsureSession()
{
	if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
		session_start();
	}
}

function TenterySpamToken($formId, $startedAt, $nonce)
{
	return hash_hmac("sha256", (string)$formId . "|" . (int)$startedAt . "|" . (string)$nonce, TenterySpamSecret());
}

function TenterySpamData($formId)
{
	TenterySpamEnsureSession();

	$formKey = (string)$formId;
	$startedAt = time();
	$nonce = bin2hex(random_bytes(16));

	if (!isset($_SESSION["tentery_spam_tokens"]) || !is_array($_SESSION["tentery_spam_tokens"])) {
		$_SESSION["tentery_spam_tokens"] = [];
	}

	if (!isset($_SESSION["tentery_spam_tokens"][$formKey]) || !is_array($_SESSION["tentery_spam_tokens"][$formKey])) {
		$_SESSION["tentery_spam_tokens"][$formKey] = [];
	}

	$_SESSION["tentery_spam_tokens"][$formKey][$nonce] = $startedAt;

	return [
		"started" => $startedAt,
		"nonce" => $nonce,
		"token" => TenterySpamToken($formId, $startedAt, $nonce),
	];
}

function TenterySpamFields($formId)
{
	$spamData = TenterySpamData($formId);
	?>
	<div style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;" aria-hidden="true">
		<label>Company</label>
		<input type="text" name="as_company" value="" tabindex="-1" autocomplete="off">
	</div>
	<input type="hidden" name="as_started" value="<?=$spamData["started"]?>">
	<input type="hidden" name="as_nonce" value="<?=$spamData["nonce"]?>">
	<input type="hidden" name="as_token" value="<?=$spamData["token"]?>">
	<?
}

function TenterySpamIsBlocked($formId, $values)
{
	$validatedKey = (string)$formId;
	if (!empty($GLOBALS["TENTERY_SPAM_VALIDATED"][$validatedKey])) {
		return false;
	}

	if (!empty($values["as_company"])) {
		return true;
	}

	$startedAt = isset($values["as_started"]) ? (int)$values["as_started"] : 0;
	$nonce = isset($values["as_nonce"]) ? (string)$values["as_nonce"] : "";
	$token = isset($values["as_token"]) ? (string)$values["as_token"] : "";

	if (!$startedAt || !$nonce || !$token) {
		return true;
	}

	TenterySpamEnsureSession();
	$formKey = (string)$formId;
	$sessionStartedAt = $_SESSION["tentery_spam_tokens"][$formKey][$nonce] ?? 0;

	if (!$sessionStartedAt || (int)$sessionStartedAt !== $startedAt) {
		return true;
	}

	$age = time() - $startedAt;
	if ($age < 3 || $age > 86400) {
		return true;
	}

	unset($_SESSION["tentery_spam_tokens"][$formKey][$nonce]);

	if (!hash_equals(TenterySpamToken($formId, $startedAt, $nonce), $token)) {
		return true;
	}

	return false;
}

function TenterySpamRateLimited($formId)
{
	$ip = preg_replace('/[^0-9a-fA-F:\.]/', '', $_SERVER['REMOTE_ADDR'] ?? 'unknown');
	$file = sys_get_temp_dir() . '/tentery_form_' . md5($formId . '|' . $ip) . '.txt';
	$now = time();

	if (is_file($file)) {
		$last = (int)file_get_contents($file);
		if ($last && ($now - $last) < 20) {
			return true;
		}
	}

	file_put_contents($file, (string)$now, LOCK_EX);
	return false;
}

AddEventHandler("form", "onBeforeResultAdd", "TenteryOnBeforeFormResultAdd");
function TenteryOnBeforeFormResultAdd($WEB_FORM_ID, &$arFields, &$arrVALUES)
{
	if (TenterySpamIsBlocked($WEB_FORM_ID, $_POST) || TenterySpamRateLimited($WEB_FORM_ID)) {
		global $APPLICATION;
		$APPLICATION->ThrowException("Spam protection");
		return false;
	}

	return true;
}

if (
	($_SERVER["REQUEST_METHOD"] ?? "") === "POST"
	&& (isset($_POST["WEB_FORM_ID"]) || isset($_POST["web_form_submit"]))
) {
	$tenteryPostFormId = isset($_POST["WEB_FORM_ID"]) ? (int)$_POST["WEB_FORM_ID"] : 0;

	if (
		!$tenteryPostFormId
		|| TenterySpamIsBlocked($tenteryPostFormId, $_POST)
		|| TenterySpamRateLimited($tenteryPostFormId)
	) {
		http_response_code(403);
		echo "Spam protection";
		die();
	}

	$GLOBALS["TENTERY_SPAM_VALIDATED"][(string)$tenteryPostFormId] = true;
}
?>
