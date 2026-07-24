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
if (count($arResult['SECTIONS'])>0)
{
?>
<?$this->SetViewTarget('head_tabs_section');?>
	<div class="page-header__categories">
		<a href="<?=$arResult['SECTIONS'][0]["LIST_PAGE_URL"]?>" class="button-small<?=(!$arParams["PARENT_SECTION_CODE"] ? ' selected' : '')?>"><?=GetMessage("TABS_ALL")?></a>
		<?foreach ($arResult['SECTIONS'] as &$arSection)
		{
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
			?>
			<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="button-small<?=($arParams["PARENT_SECTION_CODE"]==$arSection["CODE"] ? ' selected' : '')?>" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><?=$arSection["NAME"]?></a>
		<?}?>
	</div>
	<?$this->EndViewTarget();?>
<?
}
?>