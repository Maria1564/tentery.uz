<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<div class="site-modal__scroll">
	<div class="site-modal__content">



		<?
		$elID = time();





		$url0 = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$url0 = explode('?', $url0);
		$url0 = $url0[0];

		$url1 = $_SERVER['REQUEST_URI'];
		$url1 = explode('?', $url1);
		$url1 = $url1[0];
		//Оставьте заявку на услугу
		$socialMeta = include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/inc/social_meta.php";

		$selectedSocials = [
			['code' => 'telegram', 'url' => 'https://t.me/'],
			['code' => 'whatsapp', 'url' => 'https://wa.me/'],
			['code' => 'max', 'url' => 'https://max.im/'],
			['code' => 'vk', 'url' => 'https://vk.com/'],
			['code' => 'youtube', 'url' => 'https://www.youtube.com/'],
		];
		?>
		<? if (LANGUAGE_ID == 'ru') { ?>
			<div class="form-default">
				<div class="form-default__wrapper">
					<h2 class="form-default__title">Свяжитесь с нами удобным способом</h2>
					<div class="form-default__info">
						<div class="form-default__container">
							<h4 class="form-default__sub-title">По номеру телефона</h4>
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
							<h4 class="form-default__sub-title">По электронной почте</h4>
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
							<h4 class="form-default__sub-title">В социальных сетях</h4>
							<div class="form-default__socials-list">
								<? foreach ($selectedSocials as $socialItem) {
									$socialCode = trim((string) ($socialItem['code'] ?? ''));
									$socialUrl = trim((string) ($socialItem['url'] ?? ''));

									if ($socialCode === '' || $socialUrl === '' || !isset($socialMeta[$socialCode])) {
										continue;
									}

									$social = $socialMeta[$socialCode];
									?>
									<a href="<?= htmlspecialcharsbx($socialUrl) ?>" class="form-default__social"
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
		<? } elseif (LANGUAGE_ID == 'en') { ?>
			<div class="form-default">
				<div class="form-default__wrapper">
					<h2 class="form-default__title">Свяжитесь с нами удобным способом</h2>
					<div class="form-default__info">
						<div class="form-default__container">
							<h4 class="form-default__sub-title">По номеру телефона</h4>
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
							<h4 class="form-default__sub-title">По электронной почте</h4>
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
							<h4 class="form-default__sub-title">В социальных сетях</h4>
							<div class="form-default__socials-list">
								<? foreach ($selectedSocials as $socialItem) {
									$socialCode = trim((string) ($socialItem['code'] ?? ''));
									$socialUrl = trim((string) ($socialItem['url'] ?? ''));

									if ($socialCode === '' || $socialUrl === '' || !isset($socialMeta[$socialCode])) {
										continue;
									}

									$social = $socialMeta[$socialCode];
									?>
									<a href="<?= htmlspecialcharsbx($socialUrl) ?>" class="form-default__social"
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
		<? } elseif (LANGUAGE_ID == 'uz') { ?>
			<div class="form-default">
				<div class="form-default__wrapper">
					<h2 class="form-default__title">Свяжитесь с нами удобным способом</h2>
					<div class="form-default__info">
						<div class="form-default__container">
							<h4 class="form-default__sub-title">По номеру телефона</h4>
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
							<h4 class="form-default__sub-title">По электронной почте</h4>
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
							<h4 class="form-default__sub-title">В социальных сетях</h4>
							<div class="form-default__socials-list">
								<? foreach ($selectedSocials as $socialItem) {
									$socialCode = trim((string) ($socialItem['code'] ?? ''));
									$socialUrl = trim((string) ($socialItem['url'] ?? ''));

									if ($socialCode === '' || $socialUrl === '' || !isset($socialMeta[$socialCode])) {
										continue;
									}

									$social = $socialMeta[$socialCode];
									?>
									<a href="<?= htmlspecialcharsbx($socialUrl) ?>" class="form-default__social"
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
		<? } ?>




		<div class="form-default" style="display:none">

			<? if ($arResult["isFormNote"] != "Y") {
				?>
				<?= $arResult["FORM_HEADER"] ?>
				<input type="hidden" name="additional-frombuttons" value="">
				<h3 class="form-default__title title title--s40">
					<?= str_replace('&lt;br&gt;', '<br>', $arResult["FORM_TITLE"]) ?>
				</h3>
				<?//=$arResult["FORM_DESCRIPTION"] ?>
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
				<?
			} else {
				?>
				<h2 class="title title--result js-modal-result"><?= GetMessage('FORM_CALLBACK_NOTE') ?></h2>
				<?
			}
			?>

			,,,
		</div>
	</div>
</div>