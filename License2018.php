<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: License.php 9747 2012-07-26 02:08:08Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
class Install_Form_License extends Engine_Form
{
  public function init()
  {
    // Key
    $this->addElement('Text', 'key', array(
      'label' => 'License Key:',
	  'value' => $this->generateKey(),
      'required' => true,
      'allowEmpty' => false,
      'validators' => array(
      )
    ));

    // Email
    $this->addElement('Text', 'email', array(
      'label' => 'License Email:',
      'required' => true,
      'allowEmpty' => false,
      'validators' => array(
        'EmailAddress',
      )
    ));

    // Statistics
    $this->addElement('Radio', 'statistics', array(
      'label' => 'Allow us to collect information about your server environment?',
      'required' => true,
      'description' => 'With your permission, we would like to collect some '.
        'information about your server to help us improve SocialEngine in the '.
        'future. The exact information we will collect is: PHP version and ' .
        'list of extensions, MySQL version, Web-server type and version, '.
        'SocialEngine version. This information will NOT be shared with any '.
        'third party and will only be used by our development team as we build '.
        'new modules. If you do not wish to send this information, please '.
        'uncheck the box below. We sincerely appreciate your support!',
      'multiOptions' => array(
        '1' => 'Yes, allow information to be reported.',
        '0' => 'No, do not allow information to be reported.',
      ),
      'value' => '1',
    ));

    // Submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Continue...',
      'type' => 'submit',
      'order' => 10000,
      'ignore' => true,
      'decorators' => array(
        'ViewHelper',
        array('HtmlTag', array('tag' => 'div', 'class' => 'form-wrapper submit-wrapper')),
      )
    ));

    $this->addElement('Hidden', 'valid', array(
      'label' => 'Continue...',
      'type' => 'submit',
      'order' => 10001,
    ));
    
    // Modify decorators
    $this->loadDefaultDecorators();
    $this->getDecorator('FormErrors')->setSkipLabels(true);
  }

  static public function validateKey($value)
  {
    $license = trim($value);
    if( !preg_match("/^[0-9]{4}[-]{1}[0-9]{4}[-]{1}[0-9]{4}[-]{1}[0-9]{4}?$/", $license) ) {
      return false;
    }
    if( substr($license,10,1) * substr($license,11,1) * substr($license,12,1) * substr($license,13,1) != substr($license,15,4) ) {
      return false;
    }
    if( preg_match('/^[0\-]+$/', $license) ) {
      return false;
    }

    return true;
  }
  
  // Keygen by J0RG325
  static public function generateKey()
  {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $max = strlen($chars)-1;

    $key = null;
    for($i=0; $i < 16; $i++) {
    $key .= $chars{mt_rand(0, $max)};
    }
    $key = str_split($key, 4);

    return $key[0].'-'.$key[1].'-'.$key[2].'-'.$key[3];
  }
}