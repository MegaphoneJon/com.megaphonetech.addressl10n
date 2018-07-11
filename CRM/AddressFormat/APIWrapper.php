<?php
class CRM_AddressFormat_APIWrapper implements API_Wrapper {
  /**
   * the wrapper contains a method that allows you to alter the parameters of the api request (including the action and the entity)
   */
  public function fromApiInput($apiRequest) {
    return $apiRequest;
  }

  /**
   * alter the result before returning it to the caller.
   */
  public function toApiOutput($apiRequest, $result) {
    if (isset($result['id'])) {
      $countryId = CRM_Utils_Array::value('country_id', $apiRequest['params']);
      if ($countryId) {
        CRM_AddressFormat_BAO_CountryAddressFormat::updateCountry($countryId, $result['id']);
      }
    }
    return $result;
  }

}
