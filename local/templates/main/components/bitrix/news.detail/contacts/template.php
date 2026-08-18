<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//print_r($arResult);

function ShowProps($arProp)
{
?>
	<?foreach($arProp as $pid=>$arProperty):?>
		<?
			if ($pid=="social")
			{
				$arProperty["XML_VALUE"]=GetSocialLinks($arProperty["VALUE"]);
				//print_r($arProperty["XML_VALUE"]);
			}
			if ($arProperty["MULTIPLE"]=="Y" && !is_array($arProperty["DISPLAY_VALUE"]))
				$arProperty["DISPLAY_VALUE"]=[0=>$arProperty["DISPLAY_VALUE"]];
		?>
		<div class="col-contacts__item">
			<h3 class="col-contacts__title"><?=$arProperty["NAME"]?></h3>
			<?if (is_array($arProperty["DISPLAY_VALUE"])):?>
			<ul>
				<?foreach($arProperty["DISPLAY_VALUE"] as $k=>$v):?>
					<?if ($pid=="phones")
					{
					
						if (stripos('WhatsApp', $arProperty["DESCRIPTION"][$k])!==false)
						{
							$arProperty["DESCRIPTION"][$k]='<a href="https://wapp.click/'.only_numbers($v).'">'.$arProperty["DESCRIPTION"][$k].'</a>';
						}
						if (preg_match('/(\@[A-Za-z_\-]+)/',$arProperty["DESCRIPTION"][$k]))
						//if (stripos('Telegram', $arProperty["DESCRIPTION"][$k])!==false && strpos('@', $arProperty["DESCRIPTION"][$k])!==false)
						{
							$arProperty["DESCRIPTION"][$k]= preg_replace('/\@([A-Za-z_\-]+)/', '<a href="https://t.me/$1" target="__blank">@$1</a>', $arProperty["DESCRIPTION"][$k]);
						}
							
						$v='<a href="tel:+'.only_numbers($v).'" class="phone-gradient-lock"><b>'.$v.'</b></a>';
						
					}
					if ($pid=="email")
					{
						$v='<a href="mailto:'.$v.'" class="email-gradient-lock"><b>'.$v.'</b></a>';
					}
					if ($pid=="social")
					{
						$v='<a href="'.$arProperty["XML_VALUE"][$k]["UF_LINK"].'" target="__blank"><b>'.$arProperty["XML_VALUE"][$k]["UF_LINK"].'</b> '.$arProperty["XML_VALUE"][$k]["UF_NAME"].'</a>';
					}
					?>
					<li><?=$v?><?=($arProperty["DESCRIPTION"][$k] ? ' '.$arProperty["DESCRIPTION"][$k] : '')?></li>
				<?endforeach?>
			</ul>
			<?else:?>
				<div><b><?=$arProperty["DISPLAY_VALUE"]?></b></div>
			<?endif?>
		</div>
	<?endforeach?>	
<?
}
?>
<!-- contacts-info -->
<section class="contacts-info" id="contacts-info">
	<div class="grid">
		<div class="grid__row contacts-info__row">
			<div class="grid__col contacts-info__col">
				<div class="col-contacts">
					<?ShowProps($arResult["DISPLAY_PROPERTIES"])?>
				</div>				
			</div>
			<div class="grid__col contacts-info__col">
				<div class="col-contacts">
					<?ShowProps($arResult["OTHER"]["DISPLAY_PROPERTIES"])?>
				</div>
			</div>
			<?if (is_array($arResult["PREVIEW_PICTURE"])):?>
				<div class="grid__col contacts-info__col">
					<a href="" class="col-contacts col-contacts--img" data-fancybox="" data-src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>">
						<img src="<?=$arResult["THUMB"]["SRC"]?>" alt="">
					</a>
				</div>
			<?endif?>
		</div>

	</div>
</section>
<!-- \ contacts-info -->

<?if ($arResult["PROPERTIES"]["map"]["VALUE"]):?>
<!-- contacts-map -->
<section class="contacts-map" id="contacts-map">
	<div class="grid">
		<div class="contacts-map__map" id="contacts-map__map" data-map='{"coords":[<?=$arResult["PROPERTIES"]["map"]["VALUE"]?>], "pointer":"<?=SITE_TEMPLATE_PATH?>/img/pointer-round.svg", "address": "<?=htmlspecialchars($arResult["DISPLAY_PROPERTIES"]["manufacturer_address"]["DISPLAY_VALUE"])?>"<?=(intval($arResult["PROPERTIES"]["scale"]["VALUE"])>0 ? ', "zoom":'.$arResult["PROPERTIES"]["scale"]["VALUE"] : '')?>}'></div>
	</div>
</section>
<!-- \ contacts-map -->
<?endif?>
