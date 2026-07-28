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
				?>
				<div class="form-default form-section__form">
					<? if (LANGUAGE_ID == 'ru') { ?>
						<div class="form-default__info">
							<div class="form-default__container">
								<h4 class="form-default__title">По номеру телефона</h4>
								<div class="form-default__links">
									<div class="form-default__links-item">
										<a href="" class="form-default__link">+99 899 864 18 34</a>
										<span class="form-default__label">Екубов Азизжон</span>
									</div>
									<div class="form-default__links-item">
										<a href="" class="form-default__link">+99 899 864 18 34</a>
										<span class="form-default__label">Екубов Азизжон</span>
									</div>
								</div>
								<span class="form-default__detail">Ежедневно: с 08:00 до 20:00</span>
							</div>
							<div class="form-default__container">
								<h4 class="form-default__title">По электронной почте</h4>
								<div class="form-default__links">
									<div class="form-default__links-item">
										<a href="" class="form-default__link">info@tentery.uz</a>
									</div>
									<div class="form-default__links-item">
										<a href="" class="form-default__link">info@tentery.uz</a>
									</div>
								</div>
							</div>
							<div class="form-default__container form-default__container_full">
								<h4 class="form-default__title">В социальных сетях</h4>
								<div class="form-default__socials-list">
									<div class="form-default__social">
										
									</div>
								</div>
							</div>
						</div>
					<? } elseif (LANGUAGE_ID == 'en') { ?>
						<form method='POST' class='s2  bottom-form' id="<?= $elID; ?>" action="/send_post.php">
							<!-- Имя -->
							<br />
							<input type='text' name='contact[first_name]' id="fn" value='' required=''
								placeholder="Your name *" />
							<!-- Моб. тел. -->
							<br />
							<input type='text' name='contact[general_phone]' id="pl" value='' required=''
								placeholder="Your phone *" />
							<!-- E-mail -->
							<br />
							<input type='text' name='contact[email]' value='' id="ml" placeholder="Your e-mail" />
							<input type='hidden' name='order[note]' value='tentery.uz/en/' />
							<!-- Описание -->
							<br />
							<input type="hidden" name="zf" value="<?= $protect ?>">
							<input type='text' name='contact[description]' id="tl" value='' required=''
								placeholder="Enter your message text *" />
							<input type="text" name="first-name" style="display: none;" autocomplete="off" value="">
							<input type='hidden' name='token' value='6cecc14e0517bbcc5142f58e1b3a8bc3' />
							<input type='hidden' name='responsible_id' value='133479' />
							<input type='hidden' name='source_id' value='425711' />
							<div class="form-default__footer">
								<!--input type="submit" class="button button--blue" value="Send"/-->
								<div onclick="check();" class="button button--blue">Send</div>
								<div class="confidence">By clicking «Submit» you agree to the terms of the <a href=""
										target="_blank">Privacy Policy</a></div>
							</div>
					</div>
					</form>
				<? } elseif (LANGUAGE_ID == 'uz') { ?>
					<form method='POST' class='s2 bottom-form' id="<?= $elID; ?>" action="/send_post.php">
						<!-- Имя -->
						<br />
						<input type='text' name='contact[first_name]' id="fn" value='' required=''
							placeholder="ismingiz *" />
						<!-- Моб. тел. -->
						<br />
						<input type='text' name='contact[general_phone]' id="pl" value='' required=''
							placeholder="Sizning telefoningiz *" />
						<!-- E-mail -->
						<br />
						<input type='text' name='contact[email]' value='' id="ml"
							placeholder="Sizning elektron pochtangiz" />
						<input type='hidden' name='order[note]' value='tentery.uz/uz/' />
						<!-- Описание -->
						<br /><input type='hidden' name='source_id' value='425711' />
						<input type="hidden" name="zf" value="<?= $protect ?>">
						<input type='text' name='contact[description]' id="tl" value='' required=''
							placeholder="Xabar matnini kiriting *" />
						<input type="text" name="first-name" style="display: none;" autocomplete="off" value="">
						<input type='hidden' name='token' value='6cecc14e0517bbcc5142f58e1b3a8bc3' />
						<input type='hidden' name='responsible_id' value='133479' />

						<div class="form-default__footer">
							<!--input type="submit" class="button button--blue" value="Yuborish"/-->
							<div onclick="check();" class="button button--blue">Yuborish</div>
							<div class="confidence">“Yuborish” tugmasini bosish orqali siz <a href=""
									target="_blank">Maxfiylik siyosati</a> shartlariga rozilik bildirasiz.</div>
						</div>
				</div>
				</form>
			<? } ?>
		</div>
	</div>
	</div>
</section>
<!-- \ form-section -->