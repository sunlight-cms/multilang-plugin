<?php

namespace SunlightExtend\Multilang;

class Language
{
    /** ISO 639-1 */
    const CODES = [
        'ab' => 'Abkhaz',          'aa' => 'Afar',             'af' => 'Afrikaans',             'ak' => 'Akan',              'sq' => 'Albanian',
        'am' => 'Amharic',         'ar' => 'Arabic',           'an' => 'Aragonese',             'hy' => 'Armenian',          'as' => 'Assamese',
        'av' => 'Avaric',          'ae' => 'Avestan',          'ay' => 'Aymara',                'az' => 'Azerbaijani',       'bm' => 'Bambara',
        'ba' => 'Bashkir',         'eu' => 'Basque',           'be' => 'Belarusian',            'bn' => 'Bengali',           'bh' => 'Bihari',
        'bi' => 'Bislama',         'bs' => 'Bosnian',          'br' => 'Breton',                'bg' => 'Bulgarian',         'my' => 'Burmese',
        'ca' => 'Catalan',         'ch' => 'Chamorro',         'ce' => 'Chechen',               'ny' => 'Chichewa',          'zh' => 'Chinese',
        'cv' => 'Chuvash',         'kw' => 'Cornish',          'co' => 'Corsican',              'cr' => 'Cree',              'hr' => 'Croatian',
        'cs' => 'Czech',           'da' => 'Danish',           'dv' => 'Divehi',                'nl' => 'Dutch',             'dz' => 'Dzongkha',
        'en' => 'English',         'eo' => 'Esperanto',        'et' => 'Estonian',              'ee' => 'Ewe',               'fo' => 'Faroese',
        'fj' => 'Fijian',          'fi' => 'Finnish',          'fr' => 'French',                'ff' => 'Fula',              'gl' => 'Galician',
        'ka' => 'Georgian',        'de' => 'German',           'el' => 'Greek',                 'gn' => 'Guaraní',           'gu' => 'Gujarati',
        'ht' => 'Haitian',         'ha' => 'Hausa',            'he' => 'Hebrew',                'hz' => 'Herero',            'hi' => 'Hindi',
        'ho' => 'Hiri Motu',       'hu' => 'Hungarian',        'ia' => 'Interlingua',           'id' => 'Indonesian',        'ie' => 'Interlingue',
        'ga' => 'Irish',           'ig' => 'Igbo',             'ik' => 'Inupiaq',               'io' => 'Ido',               'is' => 'Icelandic',
        'it' => 'Italian',         'iu' => 'Inuktitut',        'ja' => 'Japanese',              'jv' => 'Javanese',          'kl' => 'Kalaallisut',
        'kn' => 'Kannada',         'kr' => 'Kanuri',           'ks' => 'Kashmiri',              'kk' => 'Kazakh',            'km' => 'Khmer',
        'ki' => 'Kikuyu',          'rw' => 'Kinyarwanda',      'ky' => 'Kyrgyz',                'kv' => 'Komi',              'kg' => 'Kongo',
        'ko' => 'Korean',          'ku' => 'Kurdish',          'kj' => 'Kwanyama',              'la' => 'Latin',             'lb' => 'Luxembourgish',
        'lg' => 'Ganda',           'li' => 'Limburgish',       'ln' => 'Lingala',               'lo' => 'Lao',               'lt' => 'Lithuanian',
        'lu' => 'Luba-Katanga',    'lv' => 'Latvian',          'gv' => 'Manx',                  'mk' => 'Macedonian',        'mg' => 'Malagasy',
        'ms' => 'Malay',           'ml' => 'Malayalam',        'mt' => 'Maltese',               'mi' => 'Māori',             'mr' => 'Marathi (Marāṭhī)',
        'mh' => 'Marshallese',     'mn' => 'Mongolian',        'na' => 'Nauru',                 'nv' => 'Navajo',            'nd' => 'Northern Ndebele',
        'ne' => 'Nepali',          'ng' => 'Ndonga',           'nb' => 'Norwegian Bokmål',      'nn' => 'Norwegian Nynorsk', 'no' => 'Norwegian',
        'ii' => 'Nuosu',           'nr' => 'Southern Ndebele', 'oc' => 'Occitan',               'oj' => 'Ojibwe',            'cu' => 'Old Church Slavonic',
        'om' => 'Oromo',           'or' => 'Oriya',            'os' => 'Ossetian',              'pa' => 'Panjabi',           'pi' => 'Pāli',
        'fa' => 'Persian (Farsi)', 'pl' => 'Polish',           'ps' => 'Pashto',                'pt' => 'Portuguese',        'qu' => 'Quechua',
        'rm' => 'Romansh',         'rn' => 'Kirundi',          'ro' => 'Romanian',              'ru' => 'Russian',           'sa' => 'Sanskrit (Saṁskṛta)',
        'sc' => 'Sardinian',       'sd' => 'Sindhi',           'se' => 'Northern Sami',         'sm' => 'Samoan',            'sg' => 'Sango',
        'sr' => 'Serbian',         'gd' => 'Scottish Gaelic',  'sn' => 'Shona',                 'si' => 'Sinhala',           'sk' => 'Slovak',
        'sl' => 'Slovene',         'so' => 'Somali',           'st' => 'Southern Sotho',        'es' => 'Spanish',           'su' => 'Sundanese',
        'sw' => 'Swahili',         'ss' => 'Swati',            'sv' => 'Swedish',               'ta' => 'Tamil',             'te' => 'Telugu',
        'tg' => 'Tajik',           'th' => 'Thai',             'ti' => 'Tigrinya',              'bo' => 'Tibetan Standard',  'tk' => 'Turkmen',
        'tl' => 'Tagalog',         'tn' => 'Tswana',           'to' => 'Tonga (Tonga Islands)', 'tr' => 'Turkish',           'ts' => 'Tsonga',
        'tt' => 'Tatar',           'tw' => 'Twi',              'ty' => 'Tahitian',              'ug' => 'Uyghur',            'uk' => 'Ukrainian',
        'ur' => 'Urdu',            'uz' => 'Uzbek',            've' => 'Venda',                 'vi' => 'Vietnamese',        'vo' => 'Volapük',
        'wa' => 'Walloon',         'cy' => 'Welsh',            'wo' => 'Wolof',                 'fy' => 'Western Frisian',   'xh' => 'Xhosa',
        'yi' => 'Yiddish',         'yo' => 'Yoruba',           'za' => 'Zhuang',                'zu' => 'Zulu',
    ];

    /**
     * @var array<string, self>
     */
    private static $inst = [];

    /**
     * @var string
     * @readonly
     */
    private $code;

    private function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @throws \OutOfBoundsException if code is invalid
     */
    static function fromCode(string $code): self
    {
        $lang = self::tryFromCode($code);

        if ($lang === null) {
            throw new \OutOfBoundsException(sprintf('Invalid language code "%s"', $code));
        }

        return $lang;
    }

    static function tryFromCode(string $code): ?self
    {
        if (isset(self::$inst[$code])) {
            return self::$inst[$code];
        }

        if (!isset(self::CODES[$code])) {
            return null;
        }

        return self::$inst[$code] = new self($code);
    }

    static function isValidCode(string $code): bool
    {
        return isset(self::CODES[$code]);
    }

    public function __toString(): string
    {
        return $this->code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTitle(): string
    {
        return self::CODES[$this->code];
    }
}
