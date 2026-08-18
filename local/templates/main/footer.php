		<?if ($APPLICATION->GetProperty('text-page')=="Y" || (defined("ERROR_404") && ERROR_404=="Y")): //text-page="Y"?>
					</div>
					
				</div>
			</section>
			<!-- \ page-main -->
		<?endif?>
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"feedback",
	Array(
		"AJAX_MODE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => Array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID"),
		"WEB_FORM_ID" => GetMessage('WEB_FORM_ID_FEEDBACK')
	)
);?>

		<!-- footer -->
		<footer class="footer" id="footer">
			<div class="grid">
				<div class="footer__top">
					<div class="grid__row footer__row-top">
						<div class="grid__col footer__col-logo">
							<?if(SITE_ID != "s1"):?>
								<a href="" class="logo footer__logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/logo-white_not_text.svg" alt=""></a>
							<?else:?>
								<a href="" class="logo footer__logo"><img src="<?=SITE_TEMPLATE_PATH?>/img/uploads/logo-white.svg" alt=""></a>
							<?endif?>
							<div class="footer__describe">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => SITE_DIR."footer_text.php"
									)
								);?>						
							</div>
						</div>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"bottom",
							Array(
								"ALLOW_MULTI_SELECT" => "Y",
								"CHILD_MENU_TYPE" => "bottom_sub",
								"DELAY" => "N",
								"MAX_LEVEL" => "2",
								"MENU_CACHE_GET_VARS" => array(""),
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "N",
								"ROOT_MENU_TYPE" => "bottom",
								"USE_EXT" => "Y"
							)
						);?>
						<div class="grid__col footer__col-sidebar">
							<div class="footer__subcol">
								<a href="tel:+<?=only_numbers($arContacts["phones"][0])?>" class="footer__phone site-phone phone-gradient-lock"><?=$arContacts["phones"][0]?></a>
								<div class="footer__time"><?=$arContacts["worktime_short"]?></div>								
							</div>
							<div class="footer__subcol">
								<a href="mailto:<?=$arContacts["email"][0]?>" class="footer__mail" title="<?=$arContacts["phones"][0].' '.$arContacts["phones_desc"][0]?>"><?=$arContacts["email"][0]?></a>
								<ul class="footer__addreses">
									<?foreach($arContacts["addresses"] as $k=>$address):?>
										<li><?=($arContacts["addresses_desc"][$k] ? $arContacts["addresses_desc"][$k].': ' : '').$address?></li>
									<?endforeach?>
								</ul>
					<div class="fdl">
						<style>
							.uz-link{padding-top:20px}
							.uz-link a{color:#ffffff;font-weight:500;font-size:14px;line-height:17px;text-decoration:none;}
						.right{display:flex;flex-direction:column;}
						.fdl{flex-grow:1;}
						</style>
					</div>
					<div class="uz-link">
						<a href="https://tentery.ru" target_="blank">Сайт компании Tentery&reg; в России</a>
					</div>								
							</div>


						</div>
					</div>					
				</div>
				<div class="footer__bottom">
					<div class="grid__row footer__row-bottom">
						<div class="grid__col">
							<a href="" class="footer__confidence" target="_blank"><?=GetMessage('FOOTER_PRIVACY_POLICY');?></a>
						</div>
						<div class="grid__col">
							<div class="footer__creater"><?=GetMessage('FOOTER_DEVELOPED_BY')?><a href="https://the-red-button.ru/" target="_blank">The Red Button</a></div>
						</div>
					</div>
				</div>

			</div>
		</footer>
		<!-- \ footer -->

	</div>
	<!-- \ centerlayer -->

	<div id="modal-call" class="modal-call site-modal">
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"callback",
	Array(
		"AJAX_MODE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => Array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID"),
		"WEB_FORM_ID" => GetMessage('WEB_FORM_ID_CALLBACK')
	)
);?>
</div>

  <svg xmlns="http://www.w3.org/2000/svg" style="display:none;">
    <symbol id="arrow-right" viewBox="0 0 12 19">
      <path d="M1.5 17.5L9.5 9.5L1.5 1.5" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
    </symbol>
  </svg>

<?/*
<div id="modal-result" class="modal-result site-modal">
    <div class="site-modal__content">
        <h2 class="title title--result js-modal-result">Ваша заявка отправлена, мы свяжемся с вами в ближайшее время</h2>
    </div>
</div>
*/?>
<script>
	//$(document).ready(function() {
    // Select all forms and attach a submit handler
	//$("form.s2").submit(function(event) {

	function check(){
		      event.preventDefault();
let nameField = document.getElementById("fn");
let phoneField = document.getElementById("pl");
let textField = document.getElementById("tl");
if (nameField.value === "" || phoneField.value === "" || textField.value === "" ) {
  alert("Заполните необходимые поля");
return false;
}

		      const $form = $("form.bottom-form");
			     const formData = $form.serialize(); 
		       const actionUrl = '/s2crm.php';
	        const method = $form.attr('method') || 'POST';

		        $.ajax({
			            type: method,
						url: actionUrl,
			            data: formData,
			           dataType: "json", // dataType: "json
			           encode: true,
	}).done(function(data) {
		if(data.status == 'success'){
            alert("Сообщение отправлено, менеджер скоро с вами свяжется");
	       }
	       $form.trigger("reset"); 
		}).fail(function(xhr, status, error) {  
	    console.error("Error:", error);
	});
	}
function check2(){
		      event.preventDefault();
let nameField = document.getElementById("fn");
let phoneField = document.getElementById("pl");
let textField = document.getElementById("tl");
if (nameField.value === "" || phoneField.value === "" || textField.value === "" ) {
  alert("Заполните необходимые поля");
return false;
}

		      const $form = $("form.s2");
			     const formData = $form.serialize(); 
		       const actionUrl = '/s2crm.php';
	        const method = $form.attr('method') || 'POST';

		        $.ajax({
			            type: method,
						url: actionUrl,
			            data: formData,
			           dataType: "json", // dataType: "json
			           encode: true,
	}).done(function(data) {
		if(data.status == 'success'){
            alert("Сообщение отправлено, менеджер скоро с вами свяжется");
	       }
	       $form.trigger("reset"); 
		}).fail(function(xhr, status, error) {  
	    console.error("Error:", error);
	});
	}
						//});

	//});
</script>
<?//$siteId = CMainPage::GetSiteByHost(); // Получает ID сайта на основе хоста
//echo $siteId;?>
</body>
</html>
<?
if(!$isMain && !$APPLICATION->GetPageProperty('SHOW_H1')):
ob_start();?>
	<h1 class="title title--h1<?if (defined("ERROR_404") && ERROR_404=="Y"):?> title--404<?endif?>"><?=$APPLICATION->GetTitle(false)?></h1>
<?$h1 = ob_get_clean();
$APPLICATION->AddViewContent('h1', $h1, 100);?>
<?endif?>
