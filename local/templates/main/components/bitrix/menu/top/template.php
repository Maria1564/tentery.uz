<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="site-nav header__menu">
	<?foreach($arResult as $arItem):?>
		<li<?=(count((array)$arItem["ITEMS"])>0) ? ' class="has-child"' : ''?>><a href="<?=$arItem["LINK"]?>" <?if($arItem["SELECTED"]):?>class="selected"<?endif?>><?=$arItem["TEXT"]?></a>
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
<?endif?>