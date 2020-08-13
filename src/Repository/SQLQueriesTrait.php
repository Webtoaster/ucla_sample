<?php
	
	namespace App\Repository;
	
	/**
	 * Trait SQLQueriesTrait
	 *
	 * @package App\Repository
	 */
	trait SQLQueriesTrait
	{
		
		use RepositoryCommonTraits;
		
		/**
		 *  Goes through Import table and converts empty strings to NULL in the Import Table by calling a stored procedure.
		 *  return int
		 */
		private function callProcedureConvertEmptyStringToNull():int
		{
			$sql = ' call convertEmptyStringToNull() ';
			
			return $this->executeSQLCommand($sql);
		}
		
		
		
		// /**
		//  * @param  int  $user_id
		//  *
		//  * @return array
		//  */
		// private function selectAllAssociationsByUserId(int $user_id):array
		// {
		//
		//
		//
		// 	$primary_company_id = $this->selectPrimaryCompanyIdByUserId($user_id);
		//
		//
		// 	$sql = '
		//
		//
		//         ';
		//
		//
		// 	$relationship_type_id   = 5100;
		// 	$relationship_is_active = 1;
		// 	$company_is_active      = 1;
		//
		// 	$params = compact(
		// 		'company_id',
		// 		'relationship_type_id',
		// 		'relationship_is_active',
		// 		'company_is_active'
		// 	);
		//
		// }
		
		/**
		 *
		 */
		private function deleteOrphanedRegistrations():void
		{
			$sql = '';
			
			/**
			 * You may need to add this to the SQL code in case your SQL server has a problem
			 * with TimeZones not being set.
			 * $sql .= 'SET time_zone = \''.$_ENV['MYSQL_TIME_ZONE'].'\';';
			 */
			$sql .= '
                DELETE FROM	person
				WHERE
				      person.has_started_registration = 1 AND
					  person.is_verified = 0 AND
					  person.created_at < CURRENT_TIMESTAMP - INTERVAL ' . $_ENV['ELAPSED_TIME_ORPHANED_REGISTRANT']
			        . ' SECOND ';
			
			$params = [];
			
			$this->executeSQLDelete($sql, $params);
		}
		
		
		/**
		 * @param  int     $association_id
		 * @param  string  $original_uploaded_file_name
		 * @param  string  $new_file_name
		 * @param  string  $mime_type
		 * @param  string  $guessed_file_extension
		 * @param  string  $absolute_file_path
		 * @param  string  $web_path
		 * @param  int     $company_id
		 *
		 * @return int
		 */
		private function insertIntoUpload(
			int $company_id,
			int $association_id,
			string $original_uploaded_file_name,
			string $new_file_name,
			string $mime_type,
			string $guessed_file_extension,
			string $absolute_file_path,
			string $web_path
		):int
		{
			$created_from_ip = $this->clientIp;
			$updated_from_ip = $this->clientIp;
			$is_active       = 1;
			
			$sql = '
                INSERT INTO
                 upload(
                   company_id
                  ,association_id
                  ,original_uploaded_file_name
                  ,new_file_name
                  ,mime_type
                  ,guessed_file_extension
                  ,absolute_file_path
                  ,web_path
                  ,created_from_ip
                  ,updated_from_ip
                  ,created_at
                  ,updated_at
                  ,is_active)
                VALUES
                 (
                   :company_id
                  ,:association_id
                  ,:original_uploaded_file_name
                  ,:new_file_name
                  ,:mime_type
                  ,:guessed_file_extension
                  ,:absolute_file_path
                  ,:web_path
                  ,:created_from_ip
                  ,:updated_from_ip
                  ,NOW()
                  ,NOW()
                  ,:is_active
                  )
            ';
			
			$params = compact(
				'company_id',
				'association_id',
				'original_uploaded_file_name',
				'new_file_name',
				'mime_type',
				'guessed_file_extension',
				'absolute_file_path',
				'web_path',
				'updated_from_ip',
				'created_from_ip',
				'is_active'
			);
			
			return $this->executeSQLInsertStatement($sql, $params);
		}
		
		
		/**
		 * @param  array  $params
		 *
		 * @return int
		 */
		private function insertIntoImport(array $params):int
		{
			
			$sql = '
                INSERT INTO import
                (
                    import_status_id
                    ,association_id
                    ,company_id
                    ,upload_id
                    ,external_account_id
                    ,internal_account_id
                    ,internal_owner_id
                    ,internal_property_id
                    ,un
                    ,pw
                    ,ownership_start_date
                    ,created_at
                    ,name_first
                    ,name_middle
                    ,name_last
                    ,name_suffix
                    ,name_formal
                    ,phone_home
                    ,phone_mobile
                    ,phone_work
                    ,phone_fax
                    ,email
                    ,mailing_address_line1
                    ,mailing_address_line2
                    ,mailing_address_city
                    ,mailing_address_state
                    ,mailing_address_zip_code
                   -- ,mailing_address_country
                    ,property_address_line1
                    ,property_address_line2
                    ,property_address_city
                    ,property_address_state
                    ,property_address_zip_code
                    ,county
                    ,lot
                    ,block
                    ,subdivision
                    ,legal_description
                )
                VALUES
                (
                    :import_status_id
                    ,:association_id
                    ,:company_id
                    ,:upload_id
                    ,:external_account_id
                    ,:internal_account_id
                    ,:internal_owner_id
                    ,:internal_property_id
                    ,:un
                    ,:pw
                    ,:ownership_start_date
                    ,NOW()
                    ,:name_first
                    ,:name_middle
                    ,:name_last
                    ,:name_suffix
                    ,:name_formal
                    ,:phone_home
                    ,:phone_mobile
                    ,:phone_work
                    ,:phone_fax
                    ,:email
                    ,:mailing_address_line1
                    ,:mailing_address_line2
                    ,:mailing_address_city
                    ,:mailing_address_state
                    ,:mailing_address_zip_code
                  --  ,:mailing_address_country
                    ,:property_address_line1
                    ,:property_address_line2
                    ,:property_address_city
                    ,:property_address_state
                    ,:property_address_zip_code
                    ,:county
                    ,:lot
                    ,:block
                    ,:subdivision
                    ,:legal_description
                )';
			
			//  In this case, we are going to import Params directly from the parent method calling the
			//  repository method.
			
			//            $params = compact(
			//                'import_status_id',
			//                'association_id',
			//                'company_id',
			//                'external_account_id',
			//                'internal_account_id',
			//                'internal_owner_id',
			//                'internal_property_id',
			//                'un',
			//                'pw',
			//                'ownership_start_date',
			//                'created_at',
			//                'name_first',
			//                'name_middle',
			//                'name_last',
			//                'name_suffix',
			//                'name_formal',
			//                'phone_home',
			//                'phone_mobile',
			//                'phone_work',
			//                'phone_fax',
			//                'email',
			//                'mailing_address_line1',
			//                'mailing_address_line2',
			//                'mailing_address_city',
			//                'mailing_address_state',
			//                'mailing_address_zip_code',
			//                'mailing_address_country',
			//                'property_address_line1',
			//                'property_address_line2',
			//                'property_address_city',
			//                'property_address_state',
			//                'property_address_zip_code',
			//                'county',
			//                'lot',
			//                'block',
			//                'subdivision',
			//                'legal_description'
			//            );
			
			return $this->executeSQLInsertStatement($sql, $params);
		}
		
		
		/**
		 * @param  array  $params
		 *
		 * @return int
		 */
		private function insertRelationshipMaster(array $params):int
		{
			$sql = '
                INSERT INTO relationship(
                        association_id
                        ,company_id
                        ,election_id
                        ,owner_id
                        ,permission_id
                        ,person_id
                        ,proxy_id
                        ,relationship_type_id
                        ,supervisor_id
                #  --------------------------------------
                        ,created_from_ip
                        ,updated_from_ip
                        ,created_at
                        ,updated_at
                        ,is_active
                ) VALUES (
                        :association_id
                        ,:company_id
                        ,:election_id
                        ,:owner_id
                        ,:permission_id
                        ,:person_id
                        ,:proxy_id
                        ,:relationship_type_id
                        ,:supervisor_id
                #  --------------------------------------
                        ,:created_from_ip
                        ,:updated_from_ip
                        ,NOW()
                        ,NOW()
                        ,:is_active
                         )
            ';
			
			return $this->executeSQLInsertStatement($sql, $params);
		}
		
		
		/**
		 * @param  int  $user_id
		 *
		 * @return int
		 */
		private function insertSelfRelationship(int $user_id):int
		{
			$sql = '
                INSERT INTO relationship(
                    person_id
                    ,supervisor_id
                    ,relationship_type_id
                    ,created_at
                    ,updated_at
                    ,is_active
                ) VALUES(
                    :user_id
                    ,:user_id
                    ,100
                    ,NOW()
                    ,NOW()
                    ,1
                )
            ';
			
			$this->values = compact('user_id');
			
			return $this->executeSQLInsertStatement($sql, $this->values);
		}
		
		
		/**
		 * @param  int  $user_id
		 * @param  int  $association_id
		 *
		 * @return bool
		 */
		private function selectIsUserInAssociation(int $user_id, int $association_id):bool
		{
			$relationship_type_id = 5100;
			$is_active            = 1;
			
			$sql = '
                    SELECT count(relationship_id) AS `count`
                    FROM
                     relationship
                    WHERE
                     person_id = :person_id
                     AND
                     association_id = :association_id
                     AND
                     relationship_type_id = :relationship_type_id
                     AND
                     is_active = :is_active
            ';
			
			$params = compact('user_id', 'association_id', 'relationship_type_id', 'is_active');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['count'];
		}
		
		
		/**
		 * @param  int  $person_id
		 * @param  int  $company_id
		 *
		 * @return bool
		 */
		private function selectIsUserInCompany(int $person_id, int $company_id):bool
		{
			$relationship_type_id = 5200;
			$is_active            = 1;
			
			$sql = '
                SELECT count(relationship.relationship_id) AS `count`
                FROM relationship
                WHERE
                    person_id = :person_id
                    AND
                    company_id = :company_id
                    AND
                    relationship_type_id = :relationship_type_id
                    AND
                    is_active = :is_active
            ';
			
			$params = compact('person_id', 'company_id', 'relationship_type_id', 'is_active');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return (int)$rs['count'] > 0;
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return bool
		 */
		private function selectDoesUserHaveAUserToCompanyRelationship(int $person_id):bool
		{
			$relationship_type_id = 5200;
			$is_active            = 1;
			$supervisor_id        = $person_id;
			
			$sql = '
                SELECT count(relationship.relationship_id) AS `count`
                FROM relationship
                WHERE
                    person_id = :person_id
                    AND
                    relationship_type_id = :relationship_type_id
                    AND
                    is_active = :is_active
            ';
			
			$params = compact('person_id', 'relationship_type_id', 'is_active');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return (int)$rs['count'] > 0;
		}
		
		
		/**
		 * @param  int  $company_id
		 *
		 * @return int
		 */
		private function selectCountUsersInCompany(int $company_id):int
		{
			$relationship_type_id = 5200;
			$is_active            = 1;
			
			$sql = '
                    SELECT count(relationship_id) AS `count`
                    FROM
                     relationship
                    WHERE
                     company_id = :company_id
                     AND
                     relationship_type_id = :relationship_type_id
                     AND
                     is_active = 1
            ';
			
			$this->values = compact('company_id', 'relationship_type_id', 'is_active');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $this->values);
			
			return $rs['count'];
		}
		
		
		/**
		 * @param  int  $company_id
		 *
		 * @return int
		 */
		private function selectCountAssociationsInCompany(int $company_id):int
		{
			$relationship_type_id = 200;
			$is_active            = 1;
			
			$sql = '
                    SELECT count(relationship_id) AS `count`
                    FROM
                     relationship
                    WHERE
                     company_id = :company_id
                     AND
                     relationship_type_id = :relationship_type_id
                     AND
                     is_active = 1
            ';
			
			$this->values = compact('company_id', 'relationship_type_id', 'is_active');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $this->values);
			
			return $rs['count'];
		}
		
		
		/**
		 * @param  int  $person_id
		 *
		 * @return bool
		 */
		private function selectDoesUserHaveSelfRelationship(int $person_id):bool
		{
			$relationship_type_id = 100;
			$is_active            = 1;
			
			$sql = '
                    SELECT count(relationship_id) AS `count`
                    FROM
                     relationship
                    WHERE
                     person_id = :person_id
                     AND
                     supervisor_id = :person_id
                     AND
                     relationship_type_id = :relationship_type_id
                     AND
                     is_active = :is_active
            ';
			
			$params = compact('person_id', 'relationship_type_id', 'is_active');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['count'] > 0;
		}
		
		
		
		
		//  ----------- Above this line have been reviewed
		//  ---------------------------------------------------
		//  ----------- Requires Review Below This Line
		
		/**
		 * @param  int  $user_id
		 *
		 * @return int
		 */
		private function selectNumberOfCompaniesToUser(int $user_id):int
		{
			$relationship_type_id = 5200;
			// $is_active            = 1;
			
			$sql = '
                    SELECT count(relationship_id) AS `count`
                    FROM
                     relationship
                    WHERE
                     person_id = :user_id
                     AND
                     relationship_type_id = :relationship_type_id
                     -- AND
                     -- is_active = 1
            ';
			
			$this->values = compact('user_id', 'relationship_type_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $this->values);
			
			dump($rs, ['from countNumberOfCompaniesToUser']);
			
			return $rs['count'];
		}
		
		
		/**
		 * @param  int  $race_id
		 *
		 * @return int
		 * '
		 */
		private function selectNumberOfOptionsInARace(int $race_id):int
		{
			$sql    = '
                SELECT COUNT(*)   AS `count`
                FROM race_option
                WHERE race_id = :race_id
                  AND is_active > 0
            ';
			$params = compact('race_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['count'];
		}
		
		
		/**
		 * @param  int  $election_id
		 *
		 * @return int
		 */
		private function selectNumberOfRacesInAnElection(int $election_id):int
		{
			$sql = '
                SELECT count(*)   AS `count`
                FROM race
                WHERE election_id = :election_id
                  AND is_active > 0
            ';
			
			$params = compact('election_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['count'];
		}
		
		
		/**
		 * @param  int  $association_id
		 *
		 * @return int
		 * '
		 */
		private function selectNumberOfPropertiesUploadedToAnAssociation(int $association_id):int
		{
			$sql = '
                SELECT COUNT(*)   AS `count`
                FROM property
                WHERE (property.association_id = :association_id)
                  AND (property.is_active > 0)
            ';
			
			$params = compact('association_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['count'];
		}
		
		/**
		 * @param  int  $association_id
		 *
		 * @return int
		 * '
		 */
		private function selectNumberOfPropertiesDeclaredInAnAssociation(int $association_id):int
		{
			$sql = '
                SELECT company.number_of_properties  AS `number_of_properties`
                FROM association association
                         RIGHT OUTER JOIN company company
                                          ON (association.company_id = company.company_id)
                WHERE (association.association_id = :association_id)
            ';
			
			$params = compact('association_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['count'];
		}
		
		/**
		 * @param  int  $election_id
		 *
		 * @return int
		 * '
		 */
		private function selectNumberOfBallotsCastInAnElection(int $election_id):int
		{
			$sql = '
            
            
            
            
            
            
            
            
            ';
			
			$params = compact('election_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['count'];
		}
		
		
		/**
		 * @param  int  $race_id
		 *
		 * @return int
		 * '
		 */
		private function selectNumberOfVotesCastInARace(int $race_id):int
		{
			$sql = '
            
            
            
            
            
            
            
            
            ';
			
			$params = compact('race_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['count'];
		}
		
		
		/**
		 * @param  int  $association_id
		 *
		 * @return int
		 */
		private function selectPrimaryCompanyIdByAssociationId(int $association_id):int
		{
			$is_active            = 1;
			$relationship_type_id = 200;
			
			$sql = '
                SELECT
                relationship.company_id AS company_id
                FROM
                 relationship
                WHERE
                 relationship.association_id = :association_id
                 AND
                 relationship.relationship_type_id = :relationship_type_id
                 AND
                 relationship.is_active = :is_active
                ORDER BY relationship.relationship_id
                LIMIT 1
            ';
			
			$params = compact('association_id', 'is_active', 'relationship_type_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['company_id'];
		}
		
		
		/**
		 * @param  int  $user_id
		 *
		 * @return int
		 */
		private function selectPrimaryCompanyIdByUserId(int $user_id):int
		{
			$is_active            = 1;
			$relationship_type_id = 5200;
			
			$sql = '
                SELECT
                	relationship.company_id AS company_id
                FROM
                 	relationship
                WHERE
	                 relationship.person_id = :user_id
	                 AND
	                 relationship.relationship_type_id = :relationship_type_id
	                 AND
	                 relationship.is_active = :is_active
                ORDER BY
                    relationship.relationship_id
                LIMIT 1
            ';
			
			$params = compact('user_id', 'is_active', 'relationship_type_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['company_id'];
		}
		
		
		/**
		 * @param  int  $user_id
		 *
		 * @return array|mixed[]
		 * '
		 */
		private function selectUnionCompanyAndAllAssociationsByUserId(int $user_id):array
		{
			$company_relationship_type_id     = 5200;
			$association_relationship_type_id = 200;
			$company_id                       = $this->selectPrimaryCompanyIdByUserId($user_id);
			
			$params = compact(
				'user_id',
				'company_relationship_type_id',
				'association_relationship_type_id',
				'company_id'
			);
			
			$sql_start = '
                SELECT
                 relationship.relationship_id             AS relationshipId
                ,company.company_id                       AS companyId
                ,0                                        AS associationId
                ';
			
			$sql_columns = '
                ,relationship_type.description_short      AS relationshipTypeDescription
                ,company.name_formal                      AS nameFormal
                ,company.physical_address_line1           AS physicalAddressLine1
                ,company.physical_address_line2           AS physicalAddressLine2
                ,company.physical_address_city            AS physicalAddressCity
                ,company.physical_address_state           AS physicalAddressState
                ,company.physical_address_zip_code        AS physicalAddressZipCode
                ,company.display_physical_address         AS displayPhysicalAddress
                ,relationship.supervisor_id               AS supervisorId
                ,relationship.relationship_type_id        AS relationshipTypeId
                ,relationship.is_active                   AS isActive
                ,company.number_of_sections               AS numberOfSections
                ,company.number_of_properties             AS numberOfProperties
                ,company.is_management_company            AS isManagementCompany
                ,company.is_association_company           AS isAssociationCompany
                ,company.mailing_address_line1            AS mailingAddressLine1
                ,company.mailing_address_line2            AS mailingAddressLine2
                ,company.mailing_address_city             AS mailingAddressCity
                ,company.mailing_address_state            AS mailingAddressState
                ,company.mailing_address_zip_code         AS mailingAddressZipCode
                ,company.mailing_address_country          AS mailingAddressCountry
                ,company.display_mailing_address          AS displayMailingAddress
                ,company.billing_address_line1            AS billingAddressLine1
                ,company.billing_address_line2            AS billingAddressLine2
                ,company.billing_address_city             AS billingAddressCity
                ,company.billing_address_state            AS billingAddressState
                ,company.billing_address_zip_code         AS billingAddressZipCode
                ,company.display_billing_address          AS displayBillingAddress
                ,company.phone_work                       AS phoneWork
                ,company.phone_fax                        AS phoneFax
                ,company.url                              AS url
                ,company.created_from_ip                  AS createdFromIp
                ,company.updated_from_ip                  AS updatedFromIp
                ,company.created_at                       AS createdAt
                ,company.updated_at                       AS updatedAt
            ';
			
			$sql_middle = '
                FROM
                 (relationship relationship
                  LEFT OUTER JOIN company company
                    ON (relationship.company_id = company.company_id))
                 LEFT OUTER JOIN relationship_type relationship_type
                   ON (relationship.relationship_type_id =
                       relationship_type.relationship_type_id)
                WHERE
                  relationship.relationship_type_id = :company_relationship_type_id
                  AND
                  relationship.person_id = :user_id
                
                UNION ALL
                
                SELECT
                 relationship.relationship_id       AS relationship_id
                ,company.company_id                 AS company_id
                ,relationship.association_id        AS association_id
                
               ';
			
			$sql_end = '
                FROM
                 (relationship relationship
                  LEFT OUTER JOIN company company
                    ON (relationship.association_id = company.company_id))
                 LEFT OUTER JOIN relationship_type relationship_type
                   ON (relationship.relationship_type_id =
                       relationship_type.relationship_type_id)
                WHERE
                  relationship.relationship_type_id = :association_relationship_type_id
                  AND
                  relationship.company_id = :company_id
            ';
			
			$sql = $sql_start . $sql_columns . $sql_middle . $sql_columns . $sql_end;
			
			return $this->executeSQLQueryAndResults($sql, $params);
		}
		
		/**
		 * @param  int  $association_id
		 *
		 * @return int
		 */
		private function selectParentCompanyByAssociationId(int $association_id):int
		{
			$relationship_type_id = 200;
			$is_active            = 1;
			
			$sql = '
            SELECT
              company_id AS company_id
            FROM
              relationship
            WHERE
              association_id = :association_id
              AND
              relationship_type_id = :relationship_type_id
              AND
              is_active = :is_active
            ';
			
			$params = compact('association_id', 'relationship_type_id', 'is_active');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return $rs['company_id'];
		}
		
		
		/**
		 * @param  int  $user_id
		 *
		 * @return array|mixed[]
		 * '
		 */
		private function selectPrimaryCompanyByUserId(int $user_id):array
		{
			$company_relationship_type_id     = 5200;
			$association_relationship_type_id = 200;
			$company_id                       = $this->selectPrimaryCompanyIdByUserId($user_id);
			
			$params = compact(
				'user_id',
				'company_relationship_type_id',
				'association_relationship_type_id',
				'company_id'
			);
			
			$sql_start = '
                SELECT
                 relationship.relationship_id             AS relationshipId
                ,company.company_id                       AS companyId
                ,0                                        AS associationId
                ';
			
			$sql_columns = '
                ,relationship_type.description_short      AS relationshipTypeDescription
                ,company.name_formal                      AS nameFormal
                ,company.physical_address_line1           AS physicalAddressLine1
                ,company.physical_address_line2           AS physicalAddressLine2
                ,company.physical_address_city            AS physicalAddressCity
                ,company.physical_address_state           AS physicalAddressState
                ,company.physical_address_zip_code        AS physicalAddressZipCode
                ,company.display_physical_address         AS displayPhysicalAddress
                ,relationship.supervisor_id               AS supervisorId
                ,relationship.relationship_type_id        AS relationshipTypeId
                ,relationship.is_active                   AS isActive
                ,company.number_of_sections               AS numberOfSections
                ,company.number_of_properties             AS numberOfProperties
                ,company.is_management_company            AS isManagementCompany
                ,company.is_association_company           AS isAssociationCompany
                ,company.mailing_address_line1            AS mailingAddressLine1
                ,company.mailing_address_line2            AS mailingAddressLine2
                ,company.mailing_address_city             AS mailingAddressCity
                ,company.mailing_address_state            AS mailingAddressState
                ,company.mailing_address_zip_code         AS mailingAddressZipCode
                ,company.mailing_address_country          AS mailingAddressCountry
                ,company.display_mailing_address          AS displayMailingAddress
                ,company.billing_address_line1            AS billingAddressLine1
                ,company.billing_address_line2            AS billingAddressLine2
                ,company.billing_address_city             AS billingAddressCity
                ,company.billing_address_state            AS billingAddressState
                ,company.billing_address_zip_code         AS billingAddressZipCode
                ,company.display_billing_address          AS displayBillingAddress
                ,company.phone_work                       AS phoneWork
                ,company.phone_fax                        AS phoneFax
                ,company.url                              AS url
                ,company.created_from_ip                  AS createdFromIp
                ,company.updated_from_ip                  AS updatedFromIp
                ,company.created_at                       AS createdAt
                ,company.updated_at                       AS updatedAt
            ';
			
			$sql_middle = '
                FROM
                 (relationship relationship
                  LEFT OUTER JOIN company company
                    ON (relationship.company_id = company.company_id))
                 LEFT OUTER JOIN relationship_type relationship_type
                   ON (relationship.relationship_type_id =
                       relationship_type.relationship_type_id)
                WHERE
                  relationship.relationship_type_id = :company_relationship_type_id
                  AND
                  relationship.person_id = :user_id
                
                UNION ALL
                
                SELECT
                 relationship.relationship_id       AS relationship_id
                ,company.company_id                 AS company_id
                ,relationship.association_id        AS association_id
                
               ';
			
			$sql_end = '
                FROM
                 (relationship relationship
                  LEFT OUTER JOIN company company
                    ON (relationship.association_id = company.company_id))
                 LEFT OUTER JOIN relationship_type relationship_type
                   ON (relationship.relationship_type_id =
                       relationship_type.relationship_type_id)
                WHERE
                  relationship.relationship_type_id = :association_relationship_type_id
                  AND
                  relationship.company_id = :company_id
            ';
			
			$sql = $sql_start . $sql_columns . $sql_middle . $sql_columns . $sql_end;
			
			return $this->executeSQLQueryAndResults($sql, $params);
		}
		
		
		/**
		 * @param $association_id
		 *
		 * @return array
		 * '
		 */
		private function selectAssociationByAssociationId(int $association_id):array
		{
			$sql = '
                SELECT
                 relationship.relationship_id             AS relationshipId
                ,relationship.company_id                  AS companyId
                ,relationship.association_id              AS associationId
                ,relationship.supervisor_id               AS supervisorId
                ,relationship.relationship_type_id        AS relationshipTypeId
                ,company.name_formal                      AS nameFormal
                ,company.physical_address_line1           AS physicalAddressLine1
                ,company.physical_address_line2           AS physicalAddressLine2
                ,company.physical_address_city            AS physicalAddressCity
                ,company.physical_address_state           AS physicalAddressState
                ,company.physical_address_zip_code        AS physicalAddressZipCode
                ,company.display_physical_address         AS displayPhysicalAddress
                ,company.number_of_sections               AS numberOfSections
                ,company.number_of_properties             AS numberOfProperties
                ,company.is_management_company            AS isManagementCompany
                ,company.is_association_company           AS isAssociationCompany
                ,company.mailing_address_line1            AS mailingAddressLine1
                ,company.mailing_address_line2            AS mailingAddressLine2
                ,company.mailing_address_city             AS mailingAddressCity
                ,company.mailing_address_state            AS mailingAddressState
                ,company.mailing_address_zip_code         AS mailingAddressZipCode
                ,company.mailing_address_country          AS mailingAddressCountry
                ,company.display_mailing_address          AS displayMailingAddress
                ,company.billing_address_line1            AS billingAddressLine1
                ,company.billing_address_line2            AS billingAddressLine2
                ,company.billing_address_city             AS billingAddressCity
                ,company.billing_address_state            AS billingAddressState
                ,company.billing_address_zip_code         AS billingAddressZipCode
                ,company.display_billing_address          AS displayBillingAddress
                ,company.phone_work                       AS phoneWork
                ,company.phone_fax                        AS phoneFax
                ,company.url                              AS url
                
                FROM
                 relationship
                 LEFT OUTER JOIN company
                   ON (relationship.association_id = company.company_id)
                WHERE
                 relationship.association_id = :association_id
                 AND
                 relationship.relationship_type_id = :relationship_type_id
                 AND
                 relationship.is_active = :is_active
                 AND
                 company.is_association_company = :is_association_company
                LIMIT 1
                 ';
			
			$relationship_type_id   = 200;
			$is_active              = 1;
			$is_association_company = 1;
			
			$params = compact('association_id', 'relationship_type_id', 'is_active', 'is_association_company');
			
			return $this->executeSQLQueryAndSingleRowResults($sql, $params);
		}
		
		
		/**
		 * @param  int  $user_id
		 *
		 * @return array
		 * '
		 */
		private function selectAllCompaniesByUserId(int $user_id):array
		{
			$sql = '
                SELECT
                 relationship.relationship_id AS relationshipId
                ,relationship.person_id AS userId
                ,relationship.person_id AS personId
                ,relationship.company_id AS companyId
                ,relationship.association_id AS associationId
                ,relationship.supervisor_id AS supervisorId
                ,relationship.relationship_type_id AS relationshipTypeId
                ,relationship.permission_id AS permissionId
                ,relationship.is_active AS isActive
                ,company.name_formal AS nameFormal
                ,company.physical_address_line1 AS physicalAddressLine1
                ,company.physical_address_line2 AS physicalAddressLine2
                ,company.physical_address_city AS physicalAddressCity
                ,company.physical_address_state AS physicalAddressState
                ,company.physical_address_zip_code AS physicalAddressZipCode
                ,company.display_physical_address AS displayPhysicalAddress
                ,company.number_of_sections AS numberOfSections
                ,company.number_of_properties AS numberOfProperties
                ,company.is_management_company AS isManagementCompany
                ,company.is_association_company AS isAssociationCompany
                ,company.mailing_address_line1 AS mailingAddressLine1
                ,company.mailing_address_line2 AS mailingAddressLine2
                ,company.mailing_address_city AS mailingAddressCity
                ,company.mailing_address_state AS mailingAddressState
                ,company.mailing_address_zip_code AS mailingAddressZipCode
                ,company.mailing_address_country AS mailingAddressCountry
                ,company.display_mailing_address AS displayMailingAddress
                ,company.billing_address_line1 AS billingAddressLine1
                ,company.billing_address_line2 AS billingAddressLine2
                ,company.billing_address_city AS billingAddressCity
                ,company.billing_address_state AS billingAddressState
                ,company.billing_address_zip_code AS billingAddressZipCode
                ,company.display_billing_address AS displayBillingAddress
                ,company.phone_work AS phoneWork
                ,company.phone_fax AS phoneFax
                ,company.url AS url
                FROM
                 relationship
                 LEFT OUTER JOIN company
                   ON (relationship.company_id = company.company_id)
                WHERE
                 (relationship.person_id = :user_id)
                 AND
                 (relationship.relationship_type_id = :relationship_type_id)
                 AND
                 (relationship.is_active = :is_active)
            ';
			
			$relationship_type_id   = 5200;
			$is_active              = 1;
			$is_association_company = 1;
			
			$params = compact('user_id', 'relationship_type_id', 'is_active', 'is_association_company');
			
			return $this->executeSQLQueryAndResults($sql, $params);
		}
		
		
		/**
		 * @param  int  $company_id
		 *
		 * @return array
		 */
		private function selectAllAssociationIdsByParentCompanyId(int $company_id):array
		{
			$sql = '
                SELECT
                     relationship.association_id AS association_id
                    FROM
                     (relationship
                      LEFT OUTER JOIN company
                        ON (relationship.association_id = company.company_id))
                     LEFT OUTER JOIN relationship_type
                       ON (relationship.relationship_type_id =
                           relationship_type.relationship_type_id)
                    WHERE
                      relationship.company_id = :company_id
                      AND
                      relationship.relationship_type_id = :relationship_type_id
                      AND
                      relationship.is_active = :relationship_is_active
                      AND
                      company.is_active = :company_is_active
					ORDER BY company.name_formal
            ';
			
			$relationship_type_id   = 200;
			$relationship_is_active = 1;
			$company_is_active      = 1;
			
			$params = compact(
				'company_id',
				'relationship_type_id',
				'relationship_is_active',
				'company_is_active'
			);
			
			return $this->executeSQLQueryAndResults($sql, $params);
		}
		
		
		/**
		 * @param  int  $company_id
		 *
		 * @return array
		 */
		private function selectAllAssociationsByParentCompanyId(int $company_id):array
		{
			$sql = '
                SELECT
                     relationship.association_id AS associationId
                    ,company.company_id AS companyId
                    ,company.name_formal AS nameFormal
                    ,company.physical_address_line1 AS physicalAddressLine1
                    ,company.physical_address_line2 AS physicalAddressLine2
                    ,company.physical_address_city AS physicalAddressCity
                    ,company.physical_address_state AS physicalAddressState
                    ,company.physical_address_zip_code AS physicalAddressZipCode
                    ,company.display_physical_address AS displayPhysicalAddress
                    ,company.number_of_sections AS numberOfSections
                    ,company.number_of_properties AS numberOfProperties
                    ,company.is_management_company AS isManagementCompany
                    ,company.is_association_company AS isAssociationCompany
                    ,company.mailing_address_line1 AS mailingAddressLine1
                    ,company.mailing_address_line2 AS mailingAddressLine2
                    ,company.mailing_address_city AS mailingAddressCity
                    ,company.mailing_address_state AS mailingAddressState
                    ,company.mailing_address_zip_code AS mailingAddressZipCode
                    ,company.mailing_address_country AS mailingAddressCountry
                    ,company.display_mailing_address AS displayMailingAddress
                    ,company.billing_address_line1 AS billingAddressLine1
                    ,company.billing_address_line2 AS billingAddressLine2
                    ,company.billing_address_city AS billingAddressCity
                    ,company.billing_address_state AS billingAddressState
                    ,company.billing_address_zip_code AS billingAddressZipCode
                    ,company.display_billing_address AS displayBillingAddress
                    ,company.phone_work AS phoneWork
                    ,company.phone_fax AS phoneFax
                    ,company.url AS url

                    FROM
                     (relationship
                      LEFT OUTER JOIN company
                        ON (relationship.association_id = company.company_id))
                     LEFT OUTER JOIN relationship_type
                       ON (relationship.relationship_type_id =
                           relationship_type.relationship_type_id)
                    WHERE
                      relationship.company_id = :company_id
                      AND
                      relationship.relationship_type_id = :relationship_type_id
                      AND
                      relationship.is_active = :relationship_is_active
                      AND
                      company.is_active = :company_is_active
					ORDER BY company.name_formal
            ';
			
			$relationship_type_id   = 200;
			$relationship_is_active = 1;
			$company_is_active      = 1;
			
			$params = compact(
				'company_id',
				'relationship_type_id',
				'relationship_is_active',
				'company_is_active'
			);
			
			return $this->executeSQLQueryAndResults($sql, $params);
		}
		
		
		/**
		 * @deprecated
		 *
		 * @param  int  $person_id
		 *
		 * @return int
		 */
		private function selectCountUserToSelfRelationshipsByPersonId(int $person_id):int
		{
			$relationship_type_id = 100;
			$is_active            = 1;
			$supervisor_id        = $person_id;
			
			$sql = '
                SELECT count(relationship.relationship_id) AS `count`
                FROM relationship
                WHERE
                    person_id = :person_id
                    AND
                    supervisor_id = :supervisor_id
                    AND
                    relationship_type_id = :relationship_type_id
                    AND
                    is_active = :is_active
            ';
			
			$params = compact('person_id', 'relationship_type_id', 'supervisor_id', 'is_active');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return (int)$rs['count'];
		}
		
		/**
		 * @deprecated
		 *
		 * @param  int  $user_id
		 *
		 * @see private function selectCountUserToCompanyRelationshipsByPersonId(int $person_id):int
		 * @return int
		 */
		private function selectCountRelationshipsOfUser(int $user_id = 0):int
		{
			$sql = '
                SELECT count(relationship.relationship_id) AS `count`
                FROM relationship
                WHERE relationship.person_id = :user_id
            ';
			
			$params = compact('user_id');
			
			$rs = $this->executeSQLQueryAndSingleRowResults($sql, $params);
			
			return (int)$rs['count'];
		}
		
	}
