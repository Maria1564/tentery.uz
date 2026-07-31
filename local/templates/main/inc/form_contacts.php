<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!function_exists('getFormContactsData')) {
    function getFormContactsData($elementCode = '', $iblockCode = '')
    {
        $contacts = [
            'phones' => [],
            'emails' => [],
            'worktime' => '',
            'socials' => [],
        ];

        $lang = defined('LANGUAGE_ID') ? LANGUAGE_ID : 'ru';

        if ($elementCode === '') {
            $elementCodes = [
                'ru' => 'feedback_callback_ru',
                'en' => 'feedback_callback_en',
                'uz' => 'feedback_callback_uz',
            ];
            $elementCode = $elementCodes[$lang] ?? $elementCodes['ru'];
        }

        if ($iblockCode === '') {
            $iblockCodes = [
                'ru' => 'form_contacts',
                'en' => 'form_contacts_en',
                'uz' => 'form_contacts_uz',
            ];
            $iblockCode = $iblockCodes[$lang] ?? $iblockCodes['ru'];
        }

        $socialMeta = include $_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/inc/social_meta.php";

        if (!CModule::IncludeModule('iblock')) {
            return $contacts;
        }

        $element = CIBlockElement::GetList(
            ['SORT' => 'ASC', 'ID' => 'ASC'],
            [
                'IBLOCK_CODE' => $iblockCode,
                'IBLOCK_TYPE' => 'contacts',
                'CODE' => $elementCode,
                'ACTIVE' => 'Y',
            ],
            false,
            ['nTopCount' => 1],
            ['ID', 'IBLOCK_ID']
        )->Fetch();

        if (!$element) {
            return $contacts;
        }

        $properties = CIBlockElement::GetProperty(
            (int) $element['IBLOCK_ID'],
            (int) $element['ID'],
            ['sort' => 'asc', 'id' => 'asc']
        );

        $selectedSocialCodes = [];
        $socialUrls = [];

        while ($property = $properties->Fetch()) {
            $code = $property['CODE'];
            $value = trim((string) $property['VALUE']);

            if ($value === '') {
                continue;
            }

            if ($code === 'PHONES') {
                $digits = preg_replace('/\D+/', '', $value);
                $contacts['phones'][] = [
                    'value' => $value,
                    'label' => trim((string) $property['DESCRIPTION']),
                    'href' => $digits !== '' ? 'tel:+' . $digits : '',
                ];
            } elseif ($code === 'EMAILS') {
                $contacts['emails'][] = [
                    'value' => $value,
                    'href' => 'mailto:' . $value,
                ];
            } elseif ($code === 'WORKTIME') {
                $contacts['worktime'] = $value;
            } elseif ($code === 'SOCIAL_LINKS') {
                $socialCode = trim((string) $property['VALUE_XML_ID']);
                if ($socialCode !== '') {
                    $selectedSocialCodes[] = $socialCode;
                }
            } elseif (strpos($code, 'SOCIAL_URL_') === 0) {
                $socialCode = strtolower(substr($code, strlen('SOCIAL_URL_')));
                $socialUrls[$socialCode] = $value;
            }
        }

        foreach ($selectedSocialCodes as $socialCode) {
            $socialUrl = trim((string) ($socialUrls[$socialCode] ?? ''));

            if ($socialUrl === '' || !isset($socialMeta[$socialCode])) {
                continue;
            }

            $contacts['socials'][] = [
                'code' => $socialCode,
                'url' => $socialUrl,
                'name' => $socialMeta[$socialCode]['name'],
                'color' => $socialMeta[$socialCode]['color'],
                'icon' => $socialMeta[$socialCode]['icon'],
            ];
        }

        return $contacts;
    }
}

return getFormContactsData();
