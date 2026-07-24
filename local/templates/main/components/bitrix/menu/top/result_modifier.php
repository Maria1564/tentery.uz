<?
$menuList = array();
$lev = 0;
$lastInd = 0;
$parents = array();
$cnt=0;
foreach ($arResult as $arItem)
{
    $lev = $arItem['DEPTH_LEVEL'];
    if ($arItem['IS_PARENT'])
	{
        $arItem['ITEMS'] = array();
    }

    if ($lev == 1)
	{  
		$menuList[] = $arItem;
        $lastInd = count($menuList)-1;
        $parents[$lev] = &$menuList[$lastInd];
		
		$cnt=0;
    }
	else
	{
        $cnt++;
		$parents[$lev-1]['ITEMS'][] = $arItem;
		$parents[1]['CNT']=$cnt;
        $lastInd = count($parents[$lev-1]['ITEMS'])-1;
        $parents[$lev] = &$parents[$lev-1]['ITEMS'][$lastInd];
    }
}

$arResult = $menuList;
?>