<?php

class CRM_AddressFormat_BAO_CountryAddressFormat extends CRM_Core_DAO {
  /**
   * Get list of all country having address format as NULL
   * and also include country for addres format id
   *
   * @param int $addressId
   */
  public static function getCountryList($addressId) {
    $additonalWhereClause = $addressId ? " OR cc.address_format_id = {$addressId}" : '';
    $query = "SELECT cc.id, cc.name
      FROM civicrm_country cc
      WHERE cc.address_format_id IS NULL {$additonalWhereClause}
      ORDER BY name
    ";
    $countryList = [];
    $dao = CRM_Core_DAO::executeQuery($query);
    while ($dao->fetch()) {
      $countryList[$dao->id] = $dao->name;
    }
    return $countryList;
  }

  /**
   * Process form submission.
   *
   * @param array $submitValues
   * @param int $addressId
   */
  public static function processForm($submitValues, $addressId) {
    $addressFormatParams = [
      'format' => $submitValues['format'],
    ];
    if ($addressId) {
      $addressFormatParams['id'] = $addressId;
    }
    $addressFormat = civicrm_api3('AddressFormat', 'create', $addressFormatParams);
    if (empty($addressFormat['is_error'])) {
      self::updateCountry($submitValues['country_id'], $addressFormat['id']);
    }
  }

  /**
   * Set address format id for country.
   *
   * @param int $countryId
   * @param int $addressFormatId
   */
  public static function updateCountry($countryId, $addressFormatId) {
    self::updatePreviousCountry($addressFormatId);
    $params = [
      'id' => $countryId,
      'address_format_id' => $addressFormatId,
    ];
    civicrm_api3('Country', 'create', $params);
  }

  /**
   * Delete address format and update country.
   *
   * @param int $addressFormatId
   */
  public static function deleteAddressFormat($addressFormatId) {
    try {
      self::updatePreviousCountry($addressFormatId);
      return civicrm_api3('AddressFormat', 'delete', ['id' => $addressFormatId]);
    }
    catch (CiviCRM_API3_Exception $e) {
      return ['is_error' => TRUE, 'error_message' => $e->getMessage()];
    }
  }

  /**
   * Set NULL to Address format for Country.
   *
   * @param int $addressFormatId
   */
  public static function updatePreviousCountry($addressFormatId) {
    try {
      $countryId = civicrm_api3('Country', 'getvalue', [
        'return' => "id",
        'address_format_id' => $addressFormatId,
      ]);
    }
    catch (CiviCRM_API3_Exception $e) {
      return NULL;
    }
    $params = [
      'id' => $countryId,
      'address_format_id' => '',
    ];
    civicrm_api3('Country', 'create', $params);
  }

}
