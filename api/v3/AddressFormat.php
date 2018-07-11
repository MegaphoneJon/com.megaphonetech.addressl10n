<?php
/**
 * This api exposes CiviCRM AddressFormat.
 *
 * @package CiviCRM_APIv3
 */

/**
 * Save a AddressFormat.
 *
 * @param array $params
 *
 * @return array
 */
function civicrm_api3_address_format_create($params) {
  return _civicrm_api3_basic_create(_civicrm_api3_get_BAO(__FUNCTION__), $params, 'AddressFormat');
}

/**
 * Get a AddressFormat.
 *
 * @param array $params
 *
 * @return array
 *   Array of retrieved AddressFormat property values.
 */
function civicrm_api3_address_format_get($params) {
  return _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}

/**
 * Delete a AddressFormat.
 *
 * @param array $params
 *
 * @return array
 *   Array of deleted values.
 */
function civicrm_api3_address_format_delete($params) {
  return _civicrm_api3_basic_delete(_civicrm_api3_get_BAO(__FUNCTION__), $params);
}
