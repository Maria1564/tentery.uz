<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>

<? foreach ($arResult["ITEMS"] as $arItem): ?>
    <?
    $this->AddEditAction(
        $arItem['ID'],
        $arItem['EDIT_LINK'],
        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
    );

    $this->AddDeleteAction(
        $arItem['ID'],
        $arItem['DELETE_LINK'],
        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
    );
    ?>

    <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="card-option card-option--vertical"
        id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

        <? if (is_array($arItem["PREVIEW_PICTURE"])): ?>
            <div class="card-option__img">
                <div class="b-img">
                    <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" loading="lazy">
                </div>
            </div>
        <? endif; ?>

        <div class="card-option__content">
            <h3 class="card-option__title title title--h3">
                <?= $arItem["NAME"] ?>
            </h3>

            <div class="card-option__txt">
                <?= $arItem["PREVIEW_TEXT"] ?>
            </div>
        </div>
    </a>
<? endforeach; ?>