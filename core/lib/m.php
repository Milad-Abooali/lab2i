<?php
/**
 * Class M
 *
 * Mahan | Static Functions
 *
 * @package    App\Core
 * @author     Milad Abooali <m.abooali@hotmail.com>
 * @copyright  2012 - 2020 Codebox
 * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
 * @version    1.0.0
 */

    namespace App\Core;

    if (!defined('START')) die('__ You just find me! 😹 . . . <a href="javascript:history.back()">Go Back</a>');

    use function print_r;

    /**
     * Class M
     *
     * Mahan core functions
     *
     * @package    App\Core
     * @author     Milad Abooali <m.abooali@hotmail.com>
     * @copyright  2012 - 2020 Codebox
     * @license    http://codebox.ir/license/1_0.txt  Codebox License 1.0
     * @version    1.0
     */
    class M
    {

        /**
         * Print input in pre as code
         * @param string|array $input
         * @param bool $eol
         * @param string|bool $block
         */
        public static function print($input, $block=false, $eol=false) {
            echo ($block) ? "<$block>" : null;
            echo ($eol) ? PHP_EOL : null;;
            echo '<pre><code>';
            if(is_array($input)) {
                print_r($input);
            } else {
                print($input);
            }
            echo '</code></pre>';
            echo ($eol) ? PHP_EOL : null;;
            echo ($block) ? "</$block>" : null;
        }

        /**
         * App logs raw print
         * @param int $type     0 print on page | 1 console log
         */
        public static function log($type=0) {
            global $app_logs;
            if ($type==1) {
                $log['Mahan Log'] = $app_logs;
                M::console($log);
            } elseif (isset($_GET['mLog']) || LOG_FORCE) {
                echo PHP_EOL."<!-- Log by Mahan -->".PHP_EOL;
                echo '<style>
                        #m-log {
                            height: 10%;
                            overflow: hidden;
                            margin-bottom:100px;
                        }
                        #m-log:hover {
                            height: auto;
                        }
                        .m-log-table {
                            font-family: sans-serif;
                            font-size: 12px;
                            width: 1150px;
                            max-width: 90%;
                            border-collapse: collapse;
                            margin: 20px auto;
                        }
                        .m-log-table .m-log-by th {
                            background: #ffca08;
                            color: #fff;
                        }
                        .m-log-table th {
                            text-transform: capitalize;
                            text-align: center;
                            font-weight: 600;
                            font-size: 13px;
                            color: #039;
                            background: #b9c9fe;
                            padding: 8px;
                        }
                        .m-log-table td {
                            background: #e8edff;
                            border-top: 1px solid #fff;
                            color: #669;
                            padding: 8px;
                        }
                        .m-log-table tbody tr:hover td {
                            background: #d0dafd;
                        }
                        </style>';
                echo '<div id="m-log"><table class="m-log-table">';
                echo "<tr class='m-log-by'><th>Mahan App Logs</th></tr>";
                foreach ($app_logs as $section_name => $section) {
                    echo "<tr><th>$section_name</th></tr>";
                    echo "<tr><td>";
                    M::print($section);
                    echo "</td></tr>";
                }
                echo '</table></div>';
            }
        }

        /**
         * Time of process
         */
        public static function pTime() {
            return M::nf((microtime(true)-START)*1000,'4').' ms';
        }

        /**
         * Add Log
         * @param string $type
         * @param string|null $text
         * @param null $error
         * @param string|null $sub
         * @param null $id
         * @return bool
         */
        public static function aLog($type, $text=null, $error=null, $sub=null, $id=null) {
            global $app_logs;
            $error = ($error) ? ' <b style="color:red">😭</b> ' : ' <b style="color:darkolivegreen">✓</b> ';
            if ($id) {
                if ($sub) {
                    (!LOG[$type]) ?: $app_logs[$type][$sub][$id] = '[<b style="color: darkslateblue">'.M::nf((microtime(true)-START)*1000,'4').' ms</b>] '.$error.$text;
                } else {
                    (!LOG[$type]) ?: $app_logs[$type][$id] = '[<b style="color: darkslateblue">'.M::nf((microtime(true)-START)*1000,'4').' ms</b>] '.$error.$text;
                }
            } else {
                if ($sub) {
                    (!LOG[$type]) ?: $app_logs[$type][$sub][] = '[<b style="color: darkslateblue">'.M::nf((microtime(true)-START)*1000,'4').' ms</b>] '.$error.$text;
                } else {
                    (!LOG[$type]) ?: $app_logs[$type][] = '[<b style="color: darkslateblue">'.M::nf((microtime(true)-START)*1000,'4').' ms</b>] '.$error.$text;
                }
            }
            return true;
        }


        /**
         * Add JS to output
         * @param string $data
         */
        public static function addJS($data) {
            echo "<script>$data</script>";
        }

        /**
         * Alert on page
         * @param $data
         */
        public static function alert($data) {
            echo '<script>alert(JSON.stringify('.json_encode($data).'))</script>';
        }

        /**
         * Add to console log
         * @param null $data
         */
        public static function console($data=NULL) {
            echo '<script>console.log('.json_encode($data).')</script>';
        }

        /**
         * Get Client IP
         * @return mixed
         */
        public static function getClientIP () {
            return (!empty($_SERVER['HTTP_CLIENT_IP'])) ? $_SERVER['HTTP_CLIENT_IP'] : (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        }

        /**
         * Format Numbers
         * @param int $num
         * @param int $dot
         * @return string
         */
        static function nf ($num=0, $dot=0) {
            if ($dot==0) {
                $num = round ($num);
                $output = number_format ($num, 0, '.', ',');
            } else {
                $output = number_format ($num, $dot, '.', ' ');
            }
            return $output;
        }

        /**
         * Countries - ISO 3166-1 alpha-2
         * @return array
         */
        static function countries () {
            return array
            (
                'AF' => 'Afghanistan',
                'AX' => 'Aland Islands',
                'AL' => 'Albania',
                'DZ' => 'Algeria',
                'AS' => 'American Samoa',
                'AD' => 'Andorra',
                'AO' => 'Angola',
                'AI' => 'Anguilla',
                'AQ' => 'Antarctica',
                'AG' => 'Antigua And Barbuda',
                'AR' => 'Argentina',
                'AM' => 'Armenia',
                'AW' => 'Aruba',
                'AU' => 'Australia',
                'AT' => 'Austria',
                'AZ' => 'Azerbaijan',
                'BS' => 'Bahamas',
                'BH' => 'Bahrain',
                'BD' => 'Bangladesh',
                'BB' => 'Barbados',
                'BY' => 'Belarus',
                'BE' => 'Belgium',
                'BZ' => 'Belize',
                'BJ' => 'Benin',
                'BM' => 'Bermuda',
                'BT' => 'Bhutan',
                'BO' => 'Bolivia',
                'BA' => 'Bosnia And Herzegovina',
                'BW' => 'Botswana',
                'BV' => 'Bouvet Island',
                'BR' => 'Brazil',
                'IO' => 'British Indian Ocean Territory',
                'BN' => 'Brunei Darussalam',
                'BG' => 'Bulgaria',
                'BF' => 'Burkina Faso',
                'BI' => 'Burundi',
                'KH' => 'Cambodia',
                'CM' => 'Cameroon',
                'CA' => 'Canada',
                'CV' => 'Cape Verde',
                'KY' => 'Cayman Islands',
                'CF' => 'Central African Republic',
                'TD' => 'Chad',
                'CL' => 'Chile',
                'CN' => 'China',
                'CX' => 'Christmas Island',
                'CC' => 'Cocos (Keeling) Islands',
                'CO' => 'Colombia',
                'KM' => 'Comoros',
                'CG' => 'Congo',
                'CD' => 'Congo, Democratic Republic',
                'CK' => 'Cook Islands',
                'CR' => 'Costa Rica',
                'CI' => 'Cote D\'Ivoire',
                'HR' => 'Croatia',
                'CU' => 'Cuba',
                'CY' => 'Cyprus',
                'CZ' => 'Czech Republic',
                'DK' => 'Denmark',
                'DJ' => 'Djibouti',
                'DM' => 'Dominica',
                'DO' => 'Dominican Republic',
                'EC' => 'Ecuador',
                'EG' => 'Egypt',
                'SV' => 'El Salvador',
                'GQ' => 'Equatorial Guinea',
                'ER' => 'Eritrea',
                'EE' => 'Estonia',
                'ET' => 'Ethiopia',
                'FK' => 'Falkland Islands (Malvinas)',
                'FO' => 'Faroe Islands',
                'FJ' => 'Fiji',
                'FI' => 'Finland',
                'FR' => 'France',
                'GF' => 'French Guiana',
                'PF' => 'French Polynesia',
                'TF' => 'French Southern Territories',
                'GA' => 'Gabon',
                'GM' => 'Gambia',
                'GE' => 'Georgia',
                'DE' => 'Germany',
                'GH' => 'Ghana',
                'GI' => 'Gibraltar',
                'GR' => 'Greece',
                'GL' => 'Greenland',
                'GD' => 'Grenada',
                'GP' => 'Guadeloupe',
                'GU' => 'Guam',
                'GT' => 'Guatemala',
                'GG' => 'Guernsey',
                'GN' => 'Guinea',
                'GW' => 'Guinea-Bissau',
                'GY' => 'Guyana',
                'HT' => 'Haiti',
                'HM' => 'Heard Island & Mcdonald Islands',
                'VA' => 'Holy See (Vatican City State)',
                'HN' => 'Honduras',
                'HK' => 'Hong Kong',
                'HU' => 'Hungary',
                'IS' => 'Iceland',
                'IN' => 'India',
                'ID' => 'Indonesia',
                'IR' => 'Iran, Islamic Republic Of',
                'IQ' => 'Iraq',
                'IE' => 'Ireland',
                'IM' => 'Isle Of Man',
                'IL' => 'Israel',
                'IT' => 'Italy',
                'JM' => 'Jamaica',
                'JP' => 'Japan',
                'JE' => 'Jersey',
                'JO' => 'Jordan',
                'KZ' => 'Kazakhstan',
                'KE' => 'Kenya',
                'KI' => 'Kiribati',
                'KR' => 'Korea',
                'KW' => 'Kuwait',
                'KG' => 'Kyrgyzstan',
                'LA' => 'Lao People\'s Democratic Republic',
                'LV' => 'Latvia',
                'LB' => 'Lebanon',
                'LS' => 'Lesotho',
                'LR' => 'Liberia',
                'LY' => 'Libyan Arab Jamahiriya',
                'LI' => 'Liechtenstein',
                'LT' => 'Lithuania',
                'LU' => 'Luxembourg',
                'MO' => 'Macao',
                'MK' => 'Macedonia',
                'MG' => 'Madagascar',
                'MW' => 'Malawi',
                'MY' => 'Malaysia',
                'MV' => 'Maldives',
                'ML' => 'Mali',
                'MT' => 'Malta',
                'MH' => 'Marshall Islands',
                'MQ' => 'Martinique',
                'MR' => 'Mauritania',
                'MU' => 'Mauritius',
                'YT' => 'Mayotte',
                'MX' => 'Mexico',
                'FM' => 'Micronesia, Federated States Of',
                'MD' => 'Moldova',
                'MC' => 'Monaco',
                'MN' => 'Mongolia',
                'ME' => 'Montenegro',
                'MS' => 'Montserrat',
                'MA' => 'Morocco',
                'MZ' => 'Mozambique',
                'MM' => 'Myanmar',
                'NA' => 'Namibia',
                'NR' => 'Nauru',
                'NP' => 'Nepal',
                'NL' => 'Netherlands',
                'AN' => 'Netherlands Antilles',
                'NC' => 'New Caledonia',
                'NZ' => 'New Zealand',
                'NI' => 'Nicaragua',
                'NE' => 'Niger',
                'NG' => 'Nigeria',
                'NU' => 'Niue',
                'NF' => 'Norfolk Island',
                'MP' => 'Northern Mariana Islands',
                'NO' => 'Norway',
                'OM' => 'Oman',
                'PK' => 'Pakistan',
                'PW' => 'Palau',
                'PS' => 'Palestinian Territory, Occupied',
                'PA' => 'Panama',
                'PG' => 'Papua New Guinea',
                'PY' => 'Paraguay',
                'PE' => 'Peru',
                'PH' => 'Philippines',
                'PN' => 'Pitcairn',
                'PL' => 'Poland',
                'PT' => 'Portugal',
                'PR' => 'Puerto Rico',
                'QA' => 'Qatar',
                'RE' => 'Reunion',
                'RO' => 'Romania',
                'RU' => 'Russian Federation',
                'RW' => 'Rwanda',
                'BL' => 'Saint Barthelemy',
                'SH' => 'Saint Helena',
                'KN' => 'Saint Kitts And Nevis',
                'LC' => 'Saint Lucia',
                'MF' => 'Saint Martin',
                'PM' => 'Saint Pierre And Miquelon',
                'VC' => 'Saint Vincent And Grenadines',
                'WS' => 'Samoa',
                'SM' => 'San Marino',
                'ST' => 'Sao Tome And Principe',
                'SA' => 'Saudi Arabia',
                'SN' => 'Senegal',
                'RS' => 'Serbia',
                'SC' => 'Seychelles',
                'SL' => 'Sierra Leone',
                'SG' => 'Singapore',
                'SK' => 'Slovakia',
                'SI' => 'Slovenia',
                'SB' => 'Solomon Islands',
                'SO' => 'Somalia',
                'ZA' => 'South Africa',
                'GS' => 'South Georgia And Sandwich Isl.',
                'ES' => 'Spain',
                'LK' => 'Sri Lanka',
                'SD' => 'Sudan',
                'SR' => 'Suriname',
                'SJ' => 'Svalbard And Jan Mayen',
                'SZ' => 'Swaziland',
                'SE' => 'Sweden',
                'CH' => 'Switzerland',
                'SY' => 'Syrian Arab Republic',
                'TW' => 'Taiwan',
                'TJ' => 'Tajikistan',
                'TZ' => 'Tanzania',
                'TH' => 'Thailand',
                'TL' => 'Timor-Leste',
                'TG' => 'Togo',
                'TK' => 'Tokelau',
                'TO' => 'Tonga',
                'TT' => 'Trinidad And Tobago',
                'TN' => 'Tunisia',
                'TR' => 'Turkey',
                'TM' => 'Turkmenistan',
                'TC' => 'Turks And Caicos Islands',
                'TV' => 'Tuvalu',
                'UG' => 'Uganda',
                'UA' => 'Ukraine',
                'AE' => 'United Arab Emirates',
                'GB' => 'United Kingdom',
                'US' => 'United States',
                'UM' => 'United States Outlying Islands',
                'UY' => 'Uruguay',
                'UZ' => 'Uzbekistan',
                'VU' => 'Vanuatu',
                'VE' => 'Venezuela',
                'VN' => 'Viet Nam',
                'VG' => 'Virgin Islands, British',
                'VI' => 'Virgin Islands, U.S.',
                'WF' => 'Wallis And Futuna',
                'EH' => 'Western Sahara',
                'YE' => 'Yemen',
                'ZM' => 'Zambia',
                'ZW' => 'Zimbabwe',
            );
        }




    }