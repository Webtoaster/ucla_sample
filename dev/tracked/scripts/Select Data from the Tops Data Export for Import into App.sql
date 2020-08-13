


SELECT

-- property_file.`Account Number` as `InternalAccountID`

CONCAT('SG', property_file.Section, property_file.`Property ID`)  as `InternalAccountId`
,owners_file.`Account Number` as `ExternalAccountId`
,owners_file.`Owner ID` as `OwnerId`
,CONCAT(property_file.`Community ID`, property_file.`Property ID`) as `PropertyId`

,NULL as `NameFirst`
,NULL as `NameMiddle`
,NULL as `NameLast`
,NULL as `NameSuffix`
,owners_file.`Owner1 Full Name` as `NameFormal`

,owners_file.Home as `PhoneHome`
,owners_file.`Alternate Phone Unlisted` as `PhoneMobile`
,owners_file.Work as `PhoneWork`
,NULL as `PhoneFax`
 
,NULL as `Email`
,NULL as `Username`
,NULL as `Password`
 

 
 
,CONCAT_WS(' ', property_file.`Street Number`, property_file.`Street Name`) as `PhysicalAddressLine1`
, NULL            as `PhysicalAddressLine2`
,'Dallas'    as `PhysicalAddressCity`
,'Tx'             as `PhysicalAddressState`
,'77043'          as `PhysicalAddressZipCode`
 
,CONCAT_WS(' ', property_file.`Street Number`, property_file.`Street Name`) as `MailingAddressLine1`
,NULL             as `MailingAddressLine2`
,'Dallas'    as `MailingAddressCity`
,'Tx'             as `MailingAddressState`
,'77043'          as `MailingAddressZipCode`
 
 
,CONCAT_WS(' ', property_file.`Street Number`, property_file.`Street Name`) as `PropertyAddressLine1`
,NULL             as `PropertyAddressLine2`
,'Dallas'    as `PropertyAddressCity`
,'Tx'             as `PropertyAddressState`
,'77043'          as `PropertyAddressZipCode`
 
 
,'Dallas' as `County`
, FLOOR(1 + (RAND() * 15)) as `Lot`
, FLOOR(1 + (RAND() * 15)) as `Block`
, 'Silver Green CIA' as `Subdivision`

,NULL as `Section`
,NULL as `Township`
,NULL as `Range`
 
,NULL as `LegalDescription`
 
,NULL as `DateStart`

-- ,owners_file.`Person Type Sequence`
-- ,owners_file.`Action Level Key`
-- ,owners_file.`Record Number`
-- ,owners_file.`Seq No`
-- ,owners_file.`Auto Number Key`
-- ,owners_file.`Community Enterprise Auto ID`
-- ,owners_file.`Management Company ID`


-- ,property_file.`Account Number`


-- 
-- ,property_file.`Legal 1`
-- ,property_file.`Legal 2`
-- ,property_file.`Resale Date`
-- ,owners_file.`Owner1 Last Name`
-- 
-- ,owners_file.`Owner2 Last Name`
-- ,owners_file.`Owner2 Full Name`
-- ,owners_file.`Owner ID`
-- ,owners_file.`Community ID`
-- ,owners_file.`Street Number`
-- ,owners_file.`Street Name`
-- ,owners_file.City
-- ,owners_file.State
-- ,owners_file.Zip
-- ,owners_file.`Alt Address 1`
-- ,owners_file.`Alt Address 2`
-- ,owners_file.`Alt City`
-- ,owners_file.`Alt State`
-- ,owners_file.`Alt Zip`
-- ,owners_file.`Alt Zip4`
-- 
-- 
-- 
-- -- ,owners_file.`Person Type`
-- -- ,owners_file.`Home Phone Unlisted`
-- -- ,owners_file.`Work Phone Unlisted`
-- 
-- ,owners_file.`Account Number`
-- ,owners_file.`Apt Number`
-- ,owners_file.`Whole Street Sort`
-- ,owners_file.`LotUnit Number`
-- ,owners_file.`Cost Center`
-- ,owners_file.Section
-- ,owners_file.`Asssess Value`
-- ,owners_file.`Sq Footage`
-- ,owners_file.`Legal 1`
-- ,owners_file.`Legal 2`
-- ,owners_file.`Owner Ratio`
-- ,owners_file.`Foreign Address Flag`
-- ,owners_file.`Alternate Address Flag`
-- ,owners_file.`Alt Carrier`
-- ,owners_file.Alternate
-- ,owners_file.`Hold Payment Flg`
-- ,owners_file.`Inv Statemnt Flg`
-- ,owners_file.`Settlement Date`
-- ,owners_file.`Lease Expiration Date`
-- ,owners_file.`Del Lttr Flag`
-- ,owners_file.`Mailing Label Flg`
-- ,owners_file.`Accelerated Flg`
-- ,owners_file.`Hold Collection Flg`
-- ,owners_file.`Direct Debit Y Or N`
-- ,owners_file.`Direct Debit Bank Code`
-- ,owners_file.`Direct Debit Bank ID`
-- ,owners_file.`Direct Debit Account Number`
-- ,owners_file.`Direct Debit Account Type`
-- ,owners_file.`Direct Debit Last Processed Date`
-- ,owners_file.`A1 Category`
-- ,owners_file.`C1 Category`
-- ,owners_file.`C2 Category`
-- ,owners_file.`C3 Category`
-- ,owners_file.`C4 Category`
-- ,owners_file.`C5 Category`
-- ,owners_file.`C6 Category`
-- ,owners_file.`C7 Category`
-- ,owners_file.`C8 Category`
-- ,owners_file.`C9 Category`
-- ,owners_file.`Flex Data 1`
-- ,owners_file.`Flex Data 2`
-- ,owners_file.`Flex Data 3`
-- ,owners_file.`Flex Data 4`
-- ,owners_file.`Flex Data 5`
-- ,owners_file.`2nd Alternate Address Flag`
-- ,owners_file.`2nd Alt Address 1`
-- ,owners_file.`2nd Alt Address 2`
-- ,owners_file.`2nd Alternate City`
-- ,owners_file.`2nd Alternate State`
-- ,owners_file.`2nd Alternate Zip`
-- ,owners_file.`2nd Alternate Zip Plus 4`
-- ,owners_file.`2nd Alternate Carrier`
-- ,owners_file.`2nd Alt Mailing Label Flg`
-- ,owners_file.`Fax Number`
-- ,owners_file.`Security Deposit`
-- ,owners_file.`Last Delinquency Action`
-- ,owners_file.`Balance Due`

FROM
 tops.`property file` property_file
 LEFT OUTER JOIN tops.`owners file` owners_file
   ON (property_file.`Account Number` = owners_file.`Account Number`)

 
 WHERE
  (owners_file.`Person Type` = 'H')
 
 