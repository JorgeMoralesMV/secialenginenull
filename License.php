<?php
/*JorGe 2014-2015MED*/
class Install_Form_License extends Engine_Form
{
  public function init()
  {
	// Keygen by J0RG325 - @JorgeMoralesMV
  $license = "1382-1974-6689-2592";
    // Key
    $this->addElement('Text', 'key', array(
      'label' => 'License Key:',
	  'value' => $license,
      'required' => true,
      'allowEmpty' => false,
      'validators' => array(
        array('NotEmpty', true),
        new Engine_Validate_Callback(array(get_class($this), 'validateKey'))
      )
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
}
