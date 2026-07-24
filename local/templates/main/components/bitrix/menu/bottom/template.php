<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
	<div class="grid__col footer__col-menu">
		<ul class="site-nav footer__menu">
			<?foreach($arResult as $arItem):?>
				<li class="has-child">
					<?if ($arItem["LINK"]):?>
						<a href="<?=$arItem["LINK"]?>" <?if($arItem["SELECTED"]):?>class="selected"<?endif?>><?=$arItem["TEXT"]?></a>
					<?else:?>
					<span></span>
					<?endif?>
					<?if(count((array)$arItem["ITEMS"])>0):?>
						<ul class="subnav">
							<?foreach ($arItem["ITEMS"] as $arItem2):?>
								<li><a href="<?=$arItem2["LINK"]?>" <?if($arItem2["SELECTED"]):?>class="selected"<?endif?>><?=$arItem2["TEXT"]?></a></li>
							<?endforeach?>
						</ul>
					<?endif?>
				</li>
			<?endforeach?>	
		</ul>
	</div>
<?endif?>