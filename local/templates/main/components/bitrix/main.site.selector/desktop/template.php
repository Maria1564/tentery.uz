<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="grid__col header__col-lang">
	<div class="header__lang">
		<?foreach ($arResult["SITES"] as $key => $arSite):?>
			<?if ($arSite["CURRENT"] == "Y"):?>
				<button class="header__langButton"><svg><use xlink:href="#icon-world"></use></svg> <?=$arSite["NAME"]?></button>
			<?
				break;
			endif?>
		<?endforeach;?>
		<ul class="header__langList">
			<?foreach ($arResult["SITES"] as $key => $arSite):?>
				<li><a <?if ($arSite["CURRENT"] == "Y"):?>class="selected"<?else:?>href="<?=$arSite["DIR"]?>"<?endif?>><?=$arSite["NAME"]?></a></li>
			<?endforeach;?>
		</ul>
	</div>
</div>
