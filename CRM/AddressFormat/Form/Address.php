<?php

/**
 * This class generates form components for Address Format by Country
 */
class CRM_AddressFormat_Form_Address extends CRM_Core_Form {

  /**
   * Set variables up before form is built.
   */
  public function preProcess() {
    parent::preProcess();
  }

  /**
   * Build the form object.
   */
  public function buildQuickForm() {
    parent::buildQuickForm();
    $this->setPageTitle(ts('Country - Address Format'));

    $this->_id = CRM_Utils_Request::retrieve('id', 'Positive', $this);
    if ($this->_action & CRM_Core_Action::DELETE) {
      $this->addButtons([
        [
          'type' => 'next',
          'name' => ts('Delete'),
          'isDefault' => TRUE,
        ],
        [
          'type' => 'cancel',
          'name' => ts('Cancel'),
        ],
      ]);
      return;
    }

    //get the tokens for Mailing Label field
    $tokens = CRM_Core_SelectValues::contactTokens();
    $this->assign('tokens', CRM_Utils_Token::formatTokensForDisplay($tokens));
    $this->applyFilter('__ALL__', 'trim');
    $countryList = CRM_AddressFormat_BAO_CountryAddressFormat::getCountryList($this->_id);
    $this->add('select', 'country_id', ts('Country'),
      ['' => '- select -'] + $countryList, TRUE, ['class' => 'crm-select2 huge']
    );
    $this->add('textarea',
      'format',
      ts('Address Format'),
      NULL,
      TRUE
    );
    $this->addButtons([
      [
        'type' => 'next',
        'name' => ts('Save'),
        'isDefault' => TRUE,
      ],
      [
        'type' => 'next',
        'name' => ts('Save and New'),
        'subName' => 'new',
      ],
      [
        'type' => 'cancel',
        'name' => ts('Cancel'),
      ],
    ]);
  }

  /**
   * Set the default values for the form.
   */
  public function setDefaultValues() {
    $defaults = [];
    if ($this->_id) {
      $result = civicrm_api3('Country', 'getsingle', [
        'return' => ["id", "address_format_id.format"],
        'address_format_id' => $this->_id,
      ]);
      $defaults = [
        'country_id' => $result['id'],
        'format' => $result['address_format_id.format'],
      ];
    }
    return $defaults;
  }

  /**
   * Process the form submission.
   */
  public function postProcess() {
    if ($this->_action & CRM_Core_Action::DELETE) {
      $result = CRM_AddressFormat_BAO_CountryAddressFormat::deleteAddressFormat($this->_id);
      if (!empty($result['is_error'])) {
        CRM_Core_Error::statusBounce($result['error_message'], CRM_Utils_System::url('civicrm/country/addressformat', "reset=1&action=browse"), ts('Cannot Delete'));
      }
      CRM_Core_Session::setStatus(ts('Selected Address Format by Country has been deleted.'), ts('Record Deleted'), 'success');
    }
    else {
      // store the submitted values in an array
      $params = $this->exportValues();
      try {
        CRM_AddressFormat_BAO_CountryAddressFormat::processForm($params, $this->_id);
        CRM_Core_Session::setStatus(ts('The Address format for the country has been saved.'), ts('Saved'), 'success');
      }
      catch (CRM_Core_Exception $e) {
        CRM_Core_Error::statusBounce($e->getMessage());
      }

      $buttonName = $this->controller->getButtonName();
      $session = CRM_Core_Session::singleton();

      if ($buttonName == $this->getButtonName('next', 'new')) {
        CRM_Core_Session::setStatus(ts(' You can add another Address format for a country.'));
        $session->replaceUserContext(CRM_Utils_System::url('civicrm/country/addressformat',
          "reset=1&action=add")
        );
      }
      else {
        $session->replaceUserContext(CRM_Utils_System::url('civicrm/country/addressformat',
          "reset=1&action=browse")
        );
      }
    }
  }

}
