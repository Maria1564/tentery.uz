<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<ul class="header__langList header__langList--mobile">
	<?foreach ($arResult["SITES"] as $key => $arSite):?>
		<li><a <?if ($arSite["CURRENT"] == "Y"):?>class="selected"<?else:?>href="<?=$arSite["DIR"]?>"<?endif?>><?=$arSite["NAME"]?></a></li>
	<?endforeach;?>
</ul>
