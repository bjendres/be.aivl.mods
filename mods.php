<?php
/*-------------------------------------------------------+
| AIVL CiviCRM Minor Customisations                      |
| Copyright (C) 2017 AIVL                                |
| Author: B. Endres (endres@systopia.de)                 |
|         E. Hommel (erik.hommel@civicoop.org)           |
+--------------------------------------------------------+
| License: AGPLv3, see LICENSE file                      |
+--------------------------------------------------------*/

require_once 'mods.civix.php';

/**
 * post hook to set an contact external identifier upon creation
 *
 * @see https://civicoop.plan.io/issues/906
 */
function mods_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  if ($op == 'create') {
    if (($objectName == 'Individual') || ($objectName == 'Organization') || ($objectName == 'Household')) {
      if ((empty($objectRef->external_identifier) || $objectRef->external_identifier=='null') && !empty($objectId)) {
        // check if objectId is already taken as an external ID
        $contact_id = (int) $objectId;
        $external_identifier_in_use = CRM_Core_DAO::singleValueQuery("SELECT id FROM civicrm_contact WHERE external_identifier='{$contact_id}';");
        if (empty($external_identifier_in_use)) {
          // we can go ahead and set this ID as external_identifier
          civicrm_api3('Contact', 'create', array('id' => $contact_id, 'external_identifier' => $contact_id));
        }
      }
    }
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function mods_civicrm_config(&$config) {
  _mods_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function mods_civicrm_xmlMenu(&$files) {
  _mods_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function mods_civicrm_install() {
  _mods_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function mods_civicrm_uninstall() {
  _mods_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function mods_civicrm_enable() {
  _mods_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function mods_civicrm_disable() {
  _mods_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function mods_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _mods_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function mods_civicrm_managed(&$entities) {
  _mods_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function mods_civicrm_caseTypes(&$caseTypes) {
  _mods_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function mods_civicrm_angularModules(&$angularModules) {
_mods_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function mods_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _mods_civix_civicrm_alterSettingsFolders($metaDataFolders);
}
