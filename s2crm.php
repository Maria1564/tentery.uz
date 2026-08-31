<?
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

function s2crmResponse($message = 'Отправлено')
{
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode([
		'status' => 'success',
		'message' => $message,
	], JSON_UNESCAPED_UNICODE);
	die();
}

function s2crmSpamSecret()
{
	return md5($_SERVER["DOCUMENT_ROOT"] . "|tentery_spam_guard");
}

function s2crmSpamToken($startedAt)
{
	$nonce = isset($_POST['as_nonce']) ? (string)$_POST['as_nonce'] : '';
	return hash_hmac("sha256", "s2crm|" . (int)$startedAt . "|" . $nonce, s2crmSpamSecret());
}

function s2crmRateLimited()
{
	$ip = preg_replace('/[^0-9a-fA-F:\.]/', '', $_SERVER['REMOTE_ADDR'] ?? 'unknown');
	$file = sys_get_temp_dir() . '/tentery_s2crm_' . md5($ip) . '.txt';
	$now = time();

	if (is_file($file)) {
		$last = (int)file_get_contents($file);
		if ($last && ($now - $last) < 20) {
			return true;
		}
	}

	file_put_contents($file, (string)$now, LOCK_EX);
	return false;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	s2crmResponse();
}

$fn = preg_replace('/\s+/', '', $_POST['contact']['first_name'] ?? '');
if ($fn === '') {
	s2crmResponse();
}

$pn = preg_replace('/\s+/', '', $_POST['contact']['general_phone'] ?? '');
if ($pn === '') {
	s2crmResponse();
}

if (!empty($_POST['first-name']) || !empty($_POST['as_company'])) {
	s2crmResponse();
}

$startedAt = isset($_POST['as_started']) ? (int)$_POST['as_started'] : 0;
$nonce = isset($_POST['as_nonce']) ? (string)$_POST['as_nonce'] : '';
$token = isset($_POST['as_token']) ? (string)$_POST['as_token'] : '';
$age = time() - $startedAt;
$sessionStartedAt = $_SESSION["tentery_spam_tokens"]["s2crm"][$nonce] ?? 0;

if (!$startedAt || !$nonce || !$token || !$sessionStartedAt || (int)$sessionStartedAt !== $startedAt || $age < 3 || $age > 86400) {
	s2crmResponse();
}

unset($_SESSION["tentery_spam_tokens"]["s2crm"][$nonce]);

if (!hash_equals(s2crmSpamToken($startedAt), $token)) {
	s2crmResponse();
}

if (s2crmRateLimited()) {
	s2crmResponse();
}

s2crmResponse();
?>
