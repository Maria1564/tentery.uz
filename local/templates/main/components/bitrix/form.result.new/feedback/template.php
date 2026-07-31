<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<section class="form-section" id="form-section">
	<div class="grid">
		<div class="grid__row form-section__row">
			<div class="grid__col form-section__col-content">
				<div class="form-section__content">
					<h2 class="title title--h2 form-section__title"><?= $arResult["FORM_TITLE"] ?></h2>
					<div class="form-section__describe"><?= $arResult["FORM_DESCRIPTION"] ?></div>
					<div class="form-section__manager">
						<? $APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => SITE_DIR . "feedback_person.php"
							)
						); ?>


					</div>
				</div>
			</div>
			<div class="grid__col form-section__col-form">
				<div class="form-default form-section__form" style="display:none">

					<? if ($arResult["isFormNote"] != "Y") {
						?>
						<?= $arResult["FORM_HEADER"] ?>

						<?
						if ($arResult["isFormErrors"] == "Y"): ?>
							<div><?= $arResult["FORM_ERRORS_TEXT"]; ?></div><? endif; ?>
						<?
						foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
							if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden') {
								echo $arQuestion["HTML_CODE"];
							} else {
								?>
								<div><?= $arQuestion["HTML_CODE"] ?></div>
								<?
							}
						} //endwhile
						?>
						<?
						if ($arResult["isUseCaptcha"] == "Y") {
							/*
						?>
								<tr>
									<th colspan="2"><b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b></th>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" /></td>
								</tr>
								<tr>
									<td><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></td>
									<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>
								</tr>
						<?
						*/
						} // isUseCaptcha
						?>

						<div class="form-default__footer">
							<input type="hidden" name="web_form_submit" value="Y">
							<button class="button button--blue" type="submit"
								name="submit"><?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]); ?></button>
							<div class="confidence"><?= GetMessage('FORM_CONFIDENCE') ?></div>
						</div>


						<?= $arResult["FORM_FOOTER"] ?>
					<? } else { ?>
						<h2 class="title title--result js-modal-result"><?= GetMessage('FORM_CALLBACK_NOTE') ?></h2>
					<? } ?>
				</div>

				<?

				$elID = time();

				$url0 = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				$url0 = explode('?', $url0);
				$url0 = $url0[0];


				$protect = md5(md5(time()) . "astra7");

				$formContacts = include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/inc/form_contacts.php";
				$formContactLabels = [
					'ru' => [
						'phone' => 'По номеру телефона',
						'email' => 'По электронной почте',
						'socials' => 'В социальных сетях',
					],
					'en' => [
						'phone' => 'By phone',
						'email' => 'By email',
						'socials' => 'On social media',
					],
					'uz' => [
						'phone' => 'Telefon orqali',
						'email' => 'Elektron pochta orqali',
						'socials' => 'Ijtimoiy tarmoqlarda',
					],
				];
				$formContactText = $formContactLabels[LANGUAGE_ID] ?? $formContactLabels['ru'];
				?>
				<div class="form-default form-section__form">
					<div class="form-default__wrapper">
						<div class="form-default__info">
							<div class="form-default__container">
								<h4 class="form-default__sub-title"><?= htmlspecialcharsbx($formContactText['phone']) ?></h4>
								<div class="form-default__links">
									<? foreach ($formContacts['phones'] as $phone) { ?>
										<div class="form-default__links-item">
											<a href="<?= htmlspecialcharsbx($phone['href']) ?>" class="form-default__link"><?= htmlspecialcharsbx($phone['value']) ?></a>
											<? if ($phone['label'] !== '') { ?>
												<span class="form-default__label"><?= htmlspecialcharsbx($phone['label']) ?></span>
											<? } ?>
										</div>
									<? } ?>
								</div>
								<? if ($formContacts['worktime'] !== '') { ?>
									<span class="form-default__detail"><?= htmlspecialcharsbx($formContacts['worktime']) ?></span>
								<? } ?>
							</div>
							<div class="form-default__container">
								<h4 class="form-default__sub-title"><?= htmlspecialcharsbx($formContactText['email']) ?></h4>
								<div class="form-default__links">
									<? foreach ($formContacts['emails'] as $email) { ?>
										<div class="form-default__links-item">
											<a href="<?= htmlspecialcharsbx($email['href']) ?>" class="form-default__link"><?= htmlspecialcharsbx($email['value']) ?></a>
										</div>
									<? } ?>
								</div>
							</div>
							<div class="form-default__container form-default__container_full">
								<h4 class="form-default__sub-title"><?= htmlspecialcharsbx($formContactText['socials']) ?></h4>
								<div class="form-default__socials-list">
									<? foreach ($formContacts['socials'] as $social) { ?>
										<a href="<?= htmlspecialcharsbx($social['url']) ?>" class="form-default__social"
											style="background: <?= htmlspecialcharsbx($social['color']) ?>" target="_blank"
											rel="noopener" aria-label="<?= htmlspecialcharsbx($social['name']) ?>"
											title="<?= htmlspecialcharsbx($social['name']) ?>">
											<img src="<?= htmlspecialcharsbx($social['icon']) ?>" alt="">
										</a>
									<? } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>
<!-- \ form-section -->
