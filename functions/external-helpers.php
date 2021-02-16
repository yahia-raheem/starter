<?php
/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the template as $template_args array
 * @param string filepart
 * @param mixed wp_args style argument list
 */
function hm_get_template_part( $file, $template_args = array(), $cache_args = array() ) {

	$template_args = wp_parse_args( $template_args );
	$cache_args = wp_parse_args( $cache_args );

	if ( $cache_args ) {

		foreach ( $template_args as $key => $value ) {
			if ( is_scalar( $value ) || is_array( $value ) ) {
				$cache_args[$key] = $value;
			} else if ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
				$cache_args[$key] = call_user_method( 'get_id', $value );
			}
		}

		if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {

			if ( ! empty( $template_args['return'] ) )
				return $cache;

			echo $cache;
			return;
		}

	}

	$file_handle = $file;

	do_action( 'start_operation', 'hm_template_part::' . $file_handle );

	if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
		$file = get_stylesheet_directory() . '/' . $file . '.php';

	elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
		$file = get_template_directory() . '/' . $file . '.php';

	ob_start();
	$return = require( $file );
	$data = ob_get_clean();

	do_action( 'end_operation', 'hm_template_part::' . $file_handle );

	if ( $cache_args ) {
		wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
	}

	if ( ! empty( $template_args['return'] ) )
		if ( $return === false )
			return false;
		else
			return $data;

	echo $data;
}

/**
 * Get Countries (WordPress)
 * 
 * Get translated Countries in WordPress. Runs output through a 
 * filter before returning to allow for customization through third
 * party plugins and themes, or for select removal/modification/addition 
 * of countries for whatever reason.
 * 
 * Function Usage: 
 * search and replace all instances of `countries` and replace it with your 
 * theme or plugin's textdomain (countries:twentyseventeen). Then call as:
 * $countries = countries_get_countries();
 * 
 * Filter Usage:
 * function example_countries_filter( $countries ) {
 * 		// add a translatable country:
 * 		$countries['XX'] = __( 'Country Name', 'countries' );
 * 		// remove a country:
 * 		unset( $countries['YY'] );
 *		// modify a country:
 *		$countries['US'] = __( 'America, F*ck Yeah.', 'countries' );
 * 		// always return countries!
 * 		return $countries;
 * }
 * add_filter( 'example_countries_filters', 'example_countries_callback', 10 );
 * 
 * @link https://developer.wordpress.org/themes/functionality/internationalization/
 * @link https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/
 * @link https://developer.wordpress.org/reference/functions/__/
 * @link https://developer.wordpress.org/plugins/hooks/filters/
 * @link https://developer.wordpress.org/reference/functions/apply_filters/
 * @link https://developer.wordpress.org/reference/functions/add_filter/
 * 
 * @return array Countries as Country code => Country name
 */
function hm_get_countries() {

	$countries = array(
		'AF' => __( 'Afghanistan', 'countries' ), 
		'AL' => __( 'Albania', 'countries' ), 
		'DZ' => __( 'Algeria', 'countries' ), 
		'AS' => __( 'American Samoa', 'countries' ), 
		'AD' => __( 'Andorra', 'countries' ), 
		'AO' => __( 'Angola', 'countries' ), 
		'AI' => __( 'Anguilla', 'countries' ), 
		'AQ' => __( 'Antarctica', 'countries' ), 
		'AG' => __( 'Antigua and Barbuda', 'countries' ), 
		'AR' => __( 'Argentina', 'countries' ), 
		'AM' => __( 'Armenia', 'countries' ), 
		'AW' => __( 'Aruba', 'countries' ), 
		'AU' => __( 'Australia', 'countries' ), 
		'AT' => __( 'Austria', 'countries' ), 
		'AZ' => __( 'Azerbaijan', 'countries' ), 
		'BS' => __( 'Bahamas', 'countries' ), 
		'BH' => __( 'Bahrain', 'countries' ), 
		'BD' => __( 'Bangladesh', 'countries' ), 
		'BB' => __( 'Barbados', 'countries' ), 
		'BY' => __( 'Belarus', 'countries' ), 
		'BE' => __( 'Belgium', 'countries' ), 
		'BZ' => __( 'Belize', 'countries' ), 
		'BJ' => __( 'Benin', 'countries' ), 
		'BM' => __( 'Bermuda', 'countries' ), 
		'BT' => __( 'Bhutan', 'countries' ), 
		'BO' => __( 'Bolivia', 'countries' ), 
		'BA' => __( 'Bosnia and Herzegovina', 'countries' ), 
		'BW' => __( 'Botswana', 'countries' ), 
		'BV' => __( 'Bouvet Island', 'countries' ), 
		'BR' => __( 'Brazil', 'countries' ), 
		'BQ' => __( 'British Antarctic Territory', 'countries' ), 
		'IO' => __( 'British Indian Ocean Territory', 'countries' ), 
		'VG' => __( 'British Virgin Islands', 'countries' ), 
		'BN' => __( 'Brunei', 'countries' ), 
		'BG' => __( 'Bulgaria', 'countries' ), 
		'BF' => __( 'Burkina Faso', 'countries' ), 
		'BI' => __( 'Burundi', 'countries' ), 
		'KH' => __( 'Cambodia', 'countries' ), 
		'CM' => __( 'Cameroon', 'countries' ), 
		'CA' => __( 'Canada', 'countries' ), 
		'CT' => __( 'Canton and Enderbury Islands', 'countries' ), 
		'CV' => __( 'Cape Verde', 'countries' ), 
		'KY' => __( 'Cayman Islands', 'countries' ), 
		'CF' => __( 'Central African Republic', 'countries' ), 
		'TD' => __( 'Chad', 'countries' ), 
		'CL' => __( 'Chile', 'countries' ), 
		'CN' => __( 'China', 'countries' ), 
		'CX' => __( 'Christmas Island', 'countries' ), 
		'CC' => __( 'Cocos [Keeling] Islands', 'countries' ), 
		'CO' => __( 'Colombia', 'countries' ), 
		'KM' => __( 'Comoros', 'countries' ), 
		'CG' => __( 'Congo - Brazzaville', 'countries' ), 
		'CD' => __( 'Congo - Kinshasa', 'countries' ), 
		'CK' => __( 'Cook Islands', 'countries' ), 
		'CR' => __( 'Costa Rica', 'countries' ), 
		'HR' => __( 'Croatia', 'countries' ), 
		'CU' => __( 'Cuba', 'countries' ), 
		'CY' => __( 'Cyprus', 'countries' ), 
		'CZ' => __( 'Czech Republic', 'countries' ), 
		'CI' => __( 'Côte d’Ivoire', 'countries' ), 
		'DK' => __( 'Denmark', 'countries' ), 
		'DJ' => __( 'Djibouti', 'countries' ), 
		'DM' => __( 'Dominica', 'countries' ), 
		'DO' => __( 'Dominican Republic', 'countries' ), 
		'NQ' => __( 'Dronning Maud Land', 'countries' ), 
		'DD' => __( 'East Germany', 'countries' ), 
		'EC' => __( 'Ecuador', 'countries' ), 
		'EG' => __( 'Egypt', 'countries' ), 
		'SV' => __( 'El Salvador', 'countries' ), 
		'GQ' => __( 'Equatorial Guinea', 'countries' ), 
		'ER' => __( 'Eritrea', 'countries' ), 
		'EE' => __( 'Estonia', 'countries' ), 
		'ET' => __( 'Ethiopia', 'countries' ), 
		'FK' => __( 'Falkland Islands', 'countries' ), 
		'FO' => __( 'Faroe Islands', 'countries' ), 
		'FJ' => __( 'Fiji', 'countries' ), 
		'FI' => __( 'Finland', 'countries' ), 
		'FR' => __( 'France', 'countries' ), 
		'GF' => __( 'French Guiana', 'countries' ), 
		'PF' => __( 'French Polynesia', 'countries' ), 
		'TF' => __( 'French Southern Territories', 'countries' ), 
		'FQ' => __( 'French Southern and Antarctic Territories', 'countries' ), 
		'GA' => __( 'Gabon', 'countries' ), 
		'GM' => __( 'Gambia', 'countries' ), 
		'GE' => __( 'Georgia', 'countries' ), 
		'DE' => __( 'Germany', 'countries' ), 
		'GH' => __( 'Ghana', 'countries' ), 
		'GI' => __( 'Gibraltar', 'countries' ), 
		'GR' => __( 'Greece', 'countries' ), 
		'GL' => __( 'Greenland', 'countries' ), 
		'GD' => __( 'Grenada', 'countries' ), 
		'GP' => __( 'Guadeloupe', 'countries' ), 
		'GU' => __( 'Guam', 'countries' ), 
		'GT' => __( 'Guatemala', 'countries' ), 
		'GG' => __( 'Guernsey', 'countries' ), 
		'GN' => __( 'Guinea', 'countries' ), 
		'GW' => __( 'Guinea-Bissau', 'countries' ), 
		'GY' => __( 'Guyana', 'countries' ), 
		'HT' => __( 'Haiti', 'countries' ), 
		'HM' => __( 'Heard Island and McDonald Islands', 'countries' ), 
		'HN' => __( 'Honduras', 'countries' ), 
		'HK' => __( 'Hong Kong SAR China', 'countries' ), 
		'HU' => __( 'Hungary', 'countries' ), 
		'IS' => __( 'Iceland', 'countries' ), 
		'IN' => __( 'India', 'countries' ), 
		'ID' => __( 'Indonesia', 'countries' ), 
		'IR' => __( 'Iran', 'countries' ), 
		'IQ' => __( 'Iraq', 'countries' ), 
		'IE' => __( 'Ireland', 'countries' ), 
		'IM' => __( 'Isle of Man', 'countries' ), 
		'IL' => __( 'Israel', 'countries' ), 
		'IT' => __( 'Italy', 'countries' ), 
		'JM' => __( 'Jamaica', 'countries' ), 
		'JP' => __( 'Japan', 'countries' ), 
		'JE' => __( 'Jersey', 'countries' ), 
		'JT' => __( 'Johnston Island', 'countries' ), 
		'JO' => __( 'Jordan', 'countries' ), 
		'KZ' => __( 'Kazakhstan', 'countries' ), 
		'KE' => __( 'Kenya', 'countries' ), 
		'KI' => __( 'Kiribati', 'countries' ), 
		'KW' => __( 'Kuwait', 'countries' ), 
		'KG' => __( 'Kyrgyzstan', 'countries' ), 
		'LA' => __( 'Laos', 'countries' ), 
		'LV' => __( 'Latvia', 'countries' ), 
		'LB' => __( 'Lebanon', 'countries' ), 
		'LS' => __( 'Lesotho', 'countries' ), 
		'LR' => __( 'Liberia', 'countries' ), 
		'LY' => __( 'Libya', 'countries' ), 
		'LI' => __( 'Liechtenstein', 'countries' ), 
		'LT' => __( 'Lithuania', 'countries' ), 
		'LU' => __( 'Luxembourg', 'countries' ), 
		'MO' => __( 'Macau SAR China', 'countries' ), 
		'MK' => __( 'Macedonia', 'countries' ), 
		'MG' => __( 'Madagascar', 'countries' ), 
		'MW' => __( 'Malawi', 'countries' ), 
		'MY' => __( 'Malaysia', 'countries' ), 
		'MV' => __( 'Maldives', 'countries' ), 
		'ML' => __( 'Mali', 'countries' ), 
		'MT' => __( 'Malta', 'countries' ), 
		'MH' => __( 'Marshall Islands', 'countries' ), 
		'MQ' => __( 'Martinique', 'countries' ), 
		'MR' => __( 'Mauritania', 'countries' ), 
		'MU' => __( 'Mauritius', 'countries' ), 
		'YT' => __( 'Mayotte', 'countries' ), 
		'FX' => __( 'Metropolitan France', 'countries' ), 
		'MX' => __( 'Mexico', 'countries' ), 
		'FM' => __( 'Micronesia', 'countries' ), 
		'MI' => __( 'Midway Islands', 'countries' ), 
		'MD' => __( 'Moldova', 'countries' ), 
		'MC' => __( 'Monaco', 'countries' ), 
		'MN' => __( 'Mongolia', 'countries' ), 
		'ME' => __( 'Montenegro', 'countries' ), 
		'MS' => __( 'Montserrat', 'countries' ), 
		'MA' => __( 'Morocco', 'countries' ), 
		'MZ' => __( 'Mozambique', 'countries' ), 
		'MM' => __( 'Myanmar [Burma]', 'countries' ), 
		'NA' => __( 'Namibia', 'countries' ), 
		'NR' => __( 'Nauru', 'countries' ), 
		'NP' => __( 'Nepal', 'countries' ), 
		'NL' => __( 'Netherlands', 'countries' ), 
		'AN' => __( 'Netherlands Antilles', 'countries' ), 
		'NT' => __( 'Neutral Zone', 'countries' ), 
		'NC' => __( 'New Caledonia', 'countries' ), 
		'NZ' => __( 'New Zealand', 'countries' ), 
		'NI' => __( 'Nicaragua', 'countries' ), 
		'NE' => __( 'Niger', 'countries' ), 
		'NG' => __( 'Nigeria', 'countries' ), 
		'NU' => __( 'Niue', 'countries' ), 
		'NF' => __( 'Norfolk Island', 'countries' ), 
		'KP' => __( 'North Korea', 'countries' ), 
		'VD' => __( 'North Vietnam', 'countries' ), 
		'MP' => __( 'Northern Mariana Islands', 'countries' ), 
		'NO' => __( 'Norway', 'countries' ), 
		'OM' => __( 'Oman', 'countries' ), 
		'PC' => __( 'Pacific Islands Trust Territory', 'countries' ), 
		'PK' => __( 'Pakistan', 'countries' ), 
		'PW' => __( 'Palau', 'countries' ), 
		'PS' => __( 'Palestinian Territories', 'countries' ), 
		'PA' => __( 'Panama', 'countries' ), 
		'PZ' => __( 'Panama Canal Zone', 'countries' ), 
		'PG' => __( 'Papua New Guinea', 'countries' ), 
		'PY' => __( 'Paraguay', 'countries' ), 
		'YD' => __( 'People\'s Democratic Republic of Yemen', 'countries' ), 
		'PE' => __( 'Peru', 'countries' ), 
		'PH' => __( 'Philippines', 'countries' ), 
		'PN' => __( 'Pitcairn Islands', 'countries' ), 
		'PL' => __( 'Poland', 'countries' ), 
		'PT' => __( 'Portugal', 'countries' ), 
		'PR' => __( 'Puerto Rico', 'countries' ), 
		'QA' => __( 'Qatar', 'countries' ), 
		'RO' => __( 'Romania', 'countries' ), 
		'RU' => __( 'Russia', 'countries' ), 
		'RW' => __( 'Rwanda', 'countries' ), 
		'BL' => __( 'Saint Barthélemy', 'countries' ), 
		'SH' => __( 'Saint Helena', 'countries' ), 
		'KN' => __( 'Saint Kitts and Nevis', 'countries' ), 
		'LC' => __( 'Saint Lucia', 'countries' ), 
		'MF' => __( 'Saint Martin', 'countries' ), 
		'PM' => __( 'Saint Pierre and Miquelon', 'countries' ), 
		'VC' => __( 'Saint Vincent and the Grenadines', 'countries' ), 
		'WS' => __( 'Samoa', 'countries' ), 
		'SM' => __( 'San Marino', 'countries' ), 
		'SA' => __( 'Saudi Arabia', 'countries' ), 
		'SN' => __( 'Senegal', 'countries' ), 
		'RS' => __( 'Serbia', 'countries' ), 
		'CS' => __( 'Serbia and Montenegro', 'countries' ), 
		'SC' => __( 'Seychelles', 'countries' ), 
		'SL' => __( 'Sierra Leone', 'countries' ), 
		'SG' => __( 'Singapore', 'countries' ), 
		'SK' => __( 'Slovakia', 'countries' ), 
		'SI' => __( 'Slovenia', 'countries' ), 
		'SB' => __( 'Solomon Islands', 'countries' ), 
		'SO' => __( 'Somalia', 'countries' ), 
		'ZA' => __( 'South Africa', 'countries' ), 
		'GS' => __( 'South Georgia and the South Sandwich Islands', 'countries' ), 
		'KR' => __( 'South Korea', 'countries' ), 
		'ES' => __( 'Spain', 'countries' ), 
		'LK' => __( 'Sri Lanka', 'countries' ), 
		'SD' => __( 'Sudan', 'countries' ), 
		'SR' => __( 'Suriname', 'countries' ), 
		'SJ' => __( 'Svalbard and Jan Mayen', 'countries' ), 
		'SZ' => __( 'Swaziland', 'countries' ), 
		'SE' => __( 'Sweden', 'countries' ), 
		'CH' => __( 'Switzerland', 'countries' ), 
		'SY' => __( 'Syria', 'countries' ), 
		'ST' => __( 'São Tomé and Príncipe', 'countries' ), 
		'TW' => __( 'Taiwan', 'countries' ), 
		'TJ' => __( 'Tajikistan', 'countries' ), 
		'TZ' => __( 'Tanzania', 'countries' ), 
		'TH' => __( 'Thailand', 'countries' ), 
		'TL' => __( 'Timor-Leste', 'countries' ), 
		'TG' => __( 'Togo', 'countries' ), 
		'TK' => __( 'Tokelau', 'countries' ), 
		'TO' => __( 'Tonga', 'countries' ), 
		'TT' => __( 'Trinidad and Tobago', 'countries' ), 
		'TN' => __( 'Tunisia', 'countries' ), 
		'TR' => __( 'Turkey', 'countries' ), 
		'TM' => __( 'Turkmenistan', 'countries' ), 
		'TC' => __( 'Turks and Caicos Islands', 'countries' ), 
		'TV' => __( 'Tuvalu', 'countries' ), 
		'UM' => __( 'U.S. Minor Outlying Islands', 'countries' ), 
		'PU' => __( 'U.S. Miscellaneous Pacific Islands', 'countries' ), 
		'VI' => __( 'U.S. Virgin Islands', 'countries' ), 
		'UG' => __( 'Uganda', 'countries' ), 
		'UA' => __( 'Ukraine', 'countries' ), 
		'SU' => __( 'Union of Soviet Socialist Republics', 'countries' ), 
		'AE' => __( 'United Arab Emirates', 'countries' ), 
		'GB' => __( 'United Kingdom', 'countries' ), 
		'US' => __( 'United States', 'countries' ), 
		'ZZ' => __( 'Unknown or Invalid Region', 'countries' ), 
		'UY' => __( 'Uruguay', 'countries' ), 
		'UZ' => __( 'Uzbekistan', 'countries' ), 
		'VU' => __( 'Vanuatu', 'countries' ), 
		'VA' => __( 'Vatican City', 'countries' ), 
		'VE' => __( 'Venezuela', 'countries' ), 
		'VN' => __( 'Vietnam', 'countries' ), 
		'WK' => __( 'Wake Island', 'countries' ), 
		'WF' => __( 'Wallis and Futuna', 'countries' ), 
		'EH' => __( 'Western Sahara', 'countries' ), 
		'YE' => __( 'Yemen', 'countries' ), 
		'ZM' => __( 'Zambia', 'countries' ), 
		'ZW' => __( 'Zimbabwe', 'countries' ), 
		'AX' => __( 'Åland Islands', 'countries' ), 
	);
	
	/**
	 * Filter the countries before returning
	 * 
	 * @param array $countries countries array for filtering
	 */
	$countries = apply_filters( 'hm_countries_filters', $countries );

	/**
	 * Return the translated and filtered countries
	 */
	return $countries;
}