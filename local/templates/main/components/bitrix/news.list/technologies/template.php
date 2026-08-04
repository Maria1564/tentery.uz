<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
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
$warehouseAdvantages = [];
$warehouseCardIds = array_column($arResult["ITEMS"], "ID");

if (!empty($warehouseCardIds) && CModule::IncludeModule("iblock")) {
	$advantagesIblock = CIBlock::GetList(
		[],
		[
			"TYPE" => "about",
			"CODE" => "warehouse_advantages",
		],
		true
	)->Fetch();

	if ($advantagesIblock) {
		$advantagesResult = CIBlockElement::GetList(
			["SORT" => "ASC", "NAME" => "ASC"],
			[
				"IBLOCK_ID" => (int) $advantagesIblock["ID"],
				"ACTIVE" => "Y",
				"PROPERTY_WAREHOUSE_CARD" => $warehouseCardIds,
			],
			false,
			false,
			["ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "PROPERTY_WAREHOUSE_CARD", "PROPERTY_ICON"]
		);

		while ($advantage = $advantagesResult->GetNext()) {
			$warehouseCardId = (int) $advantage["PROPERTY_WAREHOUSE_CARD_VALUE"];
			$icon = [];

			if ((int) $advantage["PROPERTY_ICON_VALUE"] > 0) {
				$icon = CFile::GetFileArray((int) $advantage["PROPERTY_ICON_VALUE"]);
			}

			$advantage["ICON"] = $icon;
			$warehouseAdvantages[$warehouseCardId][] = $advantage;
		}
	}
}
?>
<!-- technologies -->
<section class="technologies" id="technologies">
	<div class="grid">
		<? foreach ($arResult["ITEMS"] as $arItem): ?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="card-technologies" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<? if (is_array($arItem["PREVIEW_PICTURE"])): ?>
					<div class="card-technologies__img">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
							height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
							title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" loading="lazy" />
					</div>
				<? endif ?>
				<div class="card-technologies__content">
					<h3 class="card-technologies__title"><?= $arItem['NAME'] ?></h3>
					<div class="card-technologies__txt b-editor">
						<?= $arItem["PREVIEW_TEXT"] ?>
					</div>

					<? if (!empty($warehouseAdvantages[$arItem["ID"]])): ?>
						<div class="card-technologies__advantages">
							<? foreach ($warehouseAdvantages[$arItem["ID"]] as $advantage): ?>
								<div class="advantage">
									<? if (!empty($advantage["ICON"]["SRC"])): ?>
										<img src="<?= $advantage["ICON"]["SRC"] ?>" alt="<?= $advantage["NAME"] ?>">
									<? endif ?>
									<h4 class="advantage__title"><?= $advantage["NAME"] ?></h4>
									<? if ($advantage["PREVIEW_TEXT"]): ?>
										<p class="advantage__description"><?= $advantage["PREVIEW_TEXT"] ?></p>
									<? endif ?>
								</div>
							<? endforeach ?>
						</div>
					<? endif ?>
				</div>
			</div>
		<? endforeach ?>
	</div>
</section>
<!-- \ technologies -->
