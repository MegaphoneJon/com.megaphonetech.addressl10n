<?php
use CRM_Myextension_ExtensionUtil as E;

class CRM_AddressFormat_Page_Address extends CRM_Core_Page_Basic {
  /**
   * The action links that we need to display for the browse screen.
   *
   * @var array
   */
  static $_links = NULL;

  /**
   * Get BAO Name.
   *
   * @return string
   *   Classname of BAO.
   */
  public function getBAOName() {
    return 'CRM_Core_DAO_AddressFormat';
  }

  /**
   * Get action Links.
   *
   * @return array
   *   (reference) of action links
   */
  public function &links() {
    if (!(self::$_links)) {
      self::$_links = [
        CRM_Core_Action::UPDATE => [
          'name' => ts('Edit'),
          'url' => 'civicrm/country/addressformat',
          'qs' => 'action=update&id=%%id%%&reset=1',
          'title' => ts('Edit Address Format'),
        ],
        CRM_Core_Action::DELETE => [
          'name' => ts('Delete'),
          'url' => 'civicrm/country/addressformat',
          'qs' => 'action=delete&id=%%id%%',
          'title' => ts('Delete Address Format'),
        ],
      ];
    }
    return self::$_links;
  }

  /**
   * Browse all address formats for country.
   */
  public function browse() {
    $addressFormats = [];
    $sql = 'SELECT caf.*, cc.name
      FROM civicrm_country cc
        INNER JOIN civicrm_address_format caf
          ON caf.id = cc.address_format_id
    ';
    $dao = CRM_Core_DAO::executeQuery($sql);

    while ($dao->fetch()) {
      $addressFormats[$dao->id] = [
        'name' => $dao->name,
        'format' => $dao->format,
      ];
      $action = array_sum(array_keys($this->links()));
      $addressFormats[$dao->id]['action'] = CRM_Core_Action::formLink(
        self::links(),
        $action,
        ['id' => $dao->id],
        ts('more'),
        FALSE,
        'addressformat.manage.action',
        'AddressFormat',
        $dao->id
      );
    }
    $this->assign('rows', $addressFormats);
  }

  /**
   * Get name of edit form.
   *
   * @return string
   *   Classname of edit form.
   */
  public function editForm() {
    return 'CRM_AddressFormat_Form_Address';
  }

  /**
   * Get edit form name.
   *
   * @return string
   *   name of this page.
   */
  public function editName() {
    return ts('Country - Address Format');
  }

  /**
   * Get user context.
   *
   * @param null $mode
   *
   * @return string
   *   user context.
   */
  public function userContext($mode = NULL) {
    return 'civicrm/country/addressformat';
  }

}
