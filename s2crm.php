<?
$fn = preg_replace('/\s+/', '', $_POST['contact']['first_name']);
if(empty($fn)){
  	echo 'Отправлено';
	die();
}
$pn = preg_replace('/\s+/', '', $_POST['contact']['general_phone']);
if(empty($pn)){
  	echo 'Отправлено';
	die();
}

if (isset($_POST['first-name']) && !empty($_POST['first-name'])) {
    echo "Ошибка: Не заполняйте скрытые поля.";
	die();
} else {
  	echo 'Отправлено';
	die();
}

