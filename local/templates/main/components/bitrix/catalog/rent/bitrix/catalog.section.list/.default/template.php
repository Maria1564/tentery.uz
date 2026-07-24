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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>
<?$this->SetViewTarget('head_tabs_section');?>
<div class="page-header__categories">
	<a href="<?=$arResult['SECTIONS'][0]["LIST_PAGE_URL"]?>" class="button-small<?if(!$arParams["CURRENT_CODE"]):?> selected<?endif?>"><?=GetMessage('RENT_ALL')?></a>
	<?foreach ($arResult['SECTIONS'] as &$arSection):?>
		<?
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>
		<a href="<?=$arSection['SECTION_PAGE_URL']?>" class="button-small<?if($arSection["CODE"]==$arParams["CURRENT_CODE"]):?> selected<?endif?>" id="<?=$this->GetEditAreaId($arSection['ID']); ?>"><?=$arSection['NAME']?></a>
	<?endforeach?>
</div>
<?$this->EndViewTarget();?> 