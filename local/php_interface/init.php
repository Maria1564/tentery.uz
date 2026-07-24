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
?>