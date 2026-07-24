<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<?if (LANGUAGE_ID == 'ru') {?>
<div class="form-default">
<h3 class="form-default__title title title--s40">
	<? if ($url1 = '/about/options/'){?>Оставьте заявку на услугу<? } else {?>Заказ шатра<?}?>
</h3>
<form method='POST' class='s2' id="<?=$elID;?>"  action="/send_post.php">
  <!-- Имя -->
  <br />
   <input type='text' name='contact[first_name]' id="fn" value='' required='' placeholder="Ваше имя *"/>
  <!-- Моб. тел. -->
  <br />
  <input type='text' name='contact[general_phone]' id="pl" value='' required='' placeholder="Ваш телефон *"/>
  <!-- E-mail -->
  <br />
  <input type='text' name='contact[email]' value=''  placeholder="Ваш e-mail"/>
  <input type='hidden' name='order[note]' value='tentery.uz' />
  <!-- Описание -->
  <br />
  <input type='text' name='contact[description]' id="tl" value='' required='' placeholder="Введите текст сообщения *"/>
<input type="text" name="first-name" style="display: none;" autocomplete="off" value="">
  <input type='hidden' name='token' value='6cecc14e0517bbcc5142f58e1b3a8bc3' />
  <input type='hidden' name='responsible_id' value='133479' />
 <input type='hidden' name='source_id' value='425711' />
<div class="form-default__footer">
	<div onclick="check2();" class="button button--blue">Отправить</div>
	<div class="confidence">Нажимая «Отправить» вы соглашаетесь с условиями <a href="" target="_blank">Политики конфиденциальности</a></div>
</div>
</form>
</div>
<?} elseif (LANGUAGE_ID == 'en') {?>
<div class="form-default">
<h3 class="form-default__title title title--s40">
	<? if ($url1 = '/en/about/options/'){?>Leave a request for the service<? } else {?>Order a tent<?}?>
</h3>

<form method='POST' class='s2'  id="<?=$elID;?>"  action="/send_post.php">
  <!-- Имя -->
  <br />
   <input type='text' name='contact[first_name]' id="fn" value='' required='' placeholder="Your name *"/>
  <!-- Моб. тел. -->
  <br />
  <input type='text' name='contact[general_phone]' id="pl" value='' required='' placeholder="Your phone *"/>
  <!-- E-mail -->
  <br />
  <input type='text' name='contact[email]' value=''  placeholder="Your e-mail"/>

  <br />
  <input type='text' name='contact[description]' id="tl" value='' required='' placeholder="Enter your message text *"/>
<input type='hidden' name='order[note]' value="tentery.uz" />
<input type='hidden' name='source_id' value='425711' />
  <input type='hidden' name='token' value='6cecc14e0517bbcc5142f58e1b3a8bc3' />
  <input type='hidden' name='responsible_id' value='133479' />
 <input type="text" name="first-name" style="display: none;" autocomplete="off" value="">
<div class="form-default__footer">
	<div onclick="check2();" class="button button--blue">Send</div>
	<div class="confidence">By clicking «Submit» you agree to the terms of the <a href="" target="_blank">Privacy Policy</a></div>
</div>
</form>
</div>
<?} elseif (LANGUAGE_ID == 'uz') {?>
<div class="form-default">
<h3 class="form-default__title title title--s40">
	<? if ($url1 = '/uz/about/options/'){?>Xizmat uchun so'rov qoldiring<? } else {?>Chodirga buyurtma bering<?}?>
</h3>
<form method='POST' class='s2'  id="<?=$elID;?>"  action="/send_post.php"> 
  <!-- Имя -->
  <br />
   <input type='text' name='contact[first_name]' id="fn" value='' required='' placeholder="ismingiz *"/>
  <!-- Моб. тел. -->
  <br />
  <input type='text' name='contact[general_phone]' id="pl" value='' required='' placeholder="Sizning telefoningiz *"/>
  <!-- E-mail -->
  <br />
  <input type='text' name='contact[email]' value=''  placeholder="Sizning elektron pochtangiz"/>
	<input type='hidden' name='order[note]' value='tentery.uz/uz/' />
  <!-- Описание -->
  <br />
<input type="text" name="first-name" style="display: none;" autocomplete="off" value="">
<input type='hidden' name='source_id' value='425711' />
  <input type='text' name='contact[description]' id="tl" value='' required='' placeholder="Xabar matnini kiriting *"/>
  <input type='hidden' name='token' value='6cecc14e0517bbcc5142f58e1b3a8bc3' />
  <input type='hidden' name='responsible_id' value='133479' />
 
<div class="form-default__footer">
	<input onclick="check2();" class="button button--blue">Yuborish</div>
	<div class="confidence">“Yuborish” tugmasini bosish orqali siz <a href="" target="_blank">Maxfiylik siyosati</a> shartlariga rozilik bildirasiz.</div>
</div>
</form>
</div>
<?}?>




		<div class="form-default" style="display:none">

<?if ($arResult["isFormNote"] != "Y")
{
?>
		<?=$arResult["FORM_HEADER"]?>
			<input type="hidden" name="additional-frombuttons" value="">
			<h3 class="form-default__title title title--s40"><?=str_replace('&lt;br&gt;', '<br>', $arResult["FORM_TITLE"])?></h3>
			<?//=$arResult["FORM_DESCRIPTION"]?>
			<?
			if ($arResult["isFormErrors"] == "Y"):?><div><?=$arResult["FORM_ERRORS_TEXT"];?></div><?endif;?>
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>
		<div><?=$arQuestion["HTML_CODE"]?></div>
	<?
		}
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
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
				<button class="button button--blue" type="submit" name="submit"><?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?></button>
				<div class="confidence"><?=GetMessage('FORM_CONFIDENCE')?></div>
			</div>
			
	
<?=$arResult["FORM_FOOTER"]?>
<?
}
else
{
	?>
	<h2 class="title title--result js-modal-result"><?=GetMessage('FORM_CALLBACK_NOTE')?></h2>
	<?
}
?>

,,,
		</div>
	</div>
</div>
