<?php
	
	namespace App\Service;
	
	/**
	 * Class StaticHelper
	 *
	 * @package App\Service
	 */
	class StaticHelper
	{
		
		/**
		 * @var array $dataColumns_v1_00 Array for version 1.0 of the file uploader and importer
		 */
		private static $dataColumns_v1_00
			= [
				'A'  => 'external_account_id',
				'B'  => 'internal_account_id',
				'C'  => 'internal_owner_id',
				'D'  => 'internal_property_id',
				'E'  => 'name_formal',
				'F'  => 'name_first',
				'G'  => 'name_middle',
				'H'  => 'name_last',
				'I'  => 'name_suffix',
				'J'  => 'email',
				'K'  => 'phone_mobile',
				'L'  => 'phone_home',
				'M'  => 'phone_work',
				'N'  => 'phone_fax',
				'O'  => 'un',
				'P'  => 'pw',
				'Q'  => 'property_address_line1',
				'R'  => 'property_address_line2',
				'S'  => 'property_address_city',
				'T'  => 'property_address_state',
				'U'  => 'property_address_zip_code',
				'V'  => 'mailing_address_line1',
				'W'  => 'mailing_address_line2',
				'X'  => 'mailing_address_city',
				'Y'  => 'mailing_address_state',
				'Z'  => 'mailing_address_zip_code',
				'AA' => 'county',
				'AB' => 'lot',
				'AC' => 'block',
				'AD' => 'subdivision',
				'AE' => 'legal_description',
				'AF' => 'ownership_start_date',
			];
		
		/**
		 * @var array $dataMatchingColumns_v1_00 Array for version 1.0 of the file uploader and importer
		 */
		private static $dataMatchingColumns_v1_00
			= [
				'A' => 'external_account_id',
				'B' => 'internal_account_id',
				'C' => 'internal_owner_id',
				'D' => 'internal_property_id',
				'E' => 'name_formal',
				'F' => 'name_first',
				'G' => 'name_middle',
				'H' => 'name_last',
				'I' => 'name_suffix',
				'J' => 'email',
				'K' => 'phone_mobile',
				'L' => 'phone_home',
				'M' => 'phone_work',
				'N' => 'phone_fax',
				'O' => 'un',
				'P' => 'pw',
				'Q' => 'property_address_line1',
				'R' => 'property_address_line2',
				'S' => 'property_address_city',
				'T' => 'property_address_state',
				'U' => 'property_address_zip_code',
				'V' => 'mailing_address_line1',
				'W' => 'mailing_address_line2',
				'X' => 'mailing_address_city',
				'Y' => 'mailing_address_state',
				'Z' => 'mailing_address_zip_code',
			];
		
	}