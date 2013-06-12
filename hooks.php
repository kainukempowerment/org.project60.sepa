<?php

/**
 * This hook makes it possible to implement PRE ooks by definine the appropriate method in a logic class
 * 
 * @param type $op
 * @param type $objectName
 * @param type $id
 * @param type $params
 */
function sepa_civicrm_pre($op, $objectName, $id, &$params) {
  $parts = array(
      'hook',
      'pre',
      strtolower($objectName),
      strtolower($op)
  );
  $methodName = implode('_', $parts);
  CRM_Core_Session::setStatus(ts('SEPA hook response'), $methodName, 'alert');
  if (method_exists('CRM_Sepa_Logic_Mandates', $methodName))
    CRM_Sepa_Logic_Mandates::$methodName($id, $params);
}

/**
 * This hook makes it possible to implement POST ooks by definine the appropriate method in a logic class
 * 
 * @param type $op
 * @param type $objectName
 * @param type $id
 * @param type $params
 */
function sepa_civicrm_post( $op, $objectName, $objectId, &$objectRef ) {
  $parts = array(
      'hook',
      'post',
      strtolower($objectName),
      strtolower($op)
  );
  $methodName = implode('_', $parts);
  //CRM_Core_Session::setStatus(ts('SEPA hook response'), $methodName, 'alert');
  if (method_exists('CRM_Sepa_Logic_Mandates', $methodName)) {
    CRM_Sepa_Logic_Mandates::$methodName($objectId, $objectRef);
  }
}