<?php

require_once 'addressl10n.civix.php';
use CRM_Addressl10n_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function addressl10n_civicrm_config(&$config) {
  _addressl10n_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function addressl10n_civicrm_xmlMenu(&$files) {
  _addressl10n_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function addressl10n_civicrm_install() {
  _addressl10n_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function addressl10n_civicrm_postInstall() {
  _addressl10n_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function addressl10n_civicrm_uninstall() {
  _addressl10n_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function addressl10n_civicrm_enable() {
  _addressl10n_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function addressl10n_civicrm_disable() {
  _addressl10n_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function addressl10n_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _addressl10n_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function addressl10n_civicrm_managed(&$entities) {
  _addressl10n_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function addressl10n_civicrm_caseTypes(&$caseTypes) {
  _addressl10n_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function addressl10n_civicrm_angularModules(&$angularModules) {
  _addressl10n_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function addressl10n_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _addressl10n_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function addressl10n_civicrm_entityTypes(&$entityTypes) {
  _addressl10n_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
 */
function addressl10n_civicrm_navigationMenu(&$menu) {
  _addressl10n_civix_insert_navigation_menu($menu, 'Administer/Localization', [
    'label' => ts('Country - Address Format', ['domain' => 'com.megaphonetech.addressl10n']),
    'name' => 'country_address_format',
    'url' => CRM_Utils_System::url('civicrm/country/addressformat', 'reset=1', TRUE),
    'active' => 1,
    'operator' => NULL,
    'permission' => 'administer CiviCRM',
  ]);
  _addressl10n_civix_navigationMenu($menu);
}

/**
 * Implements hook_civicrm_apiWrappers().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_apiWrappers
 *
 */
function addressl10n_civicrm_apiWrappers(&$wrappers, $apiRequest) {
  if (strtolower($apiRequest['entity']) == 'addressformat' && $apiRequest['action'] == 'create') {
    $wrappers[] = new CRM_AddressFormat_APIWrapper();
  }
}
