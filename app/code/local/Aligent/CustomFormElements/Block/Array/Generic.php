<?php

class Aligent_CustomFormElements_Block_Array_Generic extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract {

    public function __construct() {
        if (!$this->getTemplate()) {
            $this->setTemplate('aligent/customformelements/form/field/array.phtml');
        }

        parent::__construct();
    }

    public function setAddAfter($bValue) {
        $this->_addAfter = $bValue;
    }

    public function getAddAfter() {
        return $this->_addAfter;
    }

    public function setAddButtonLabel($vLabel) {
        $this->_addButtonLabel = $vLabel;
    }

    public function getAddButtonLabel() {
        return $this->_addButtonLabel;
    }

    public function setArrayRowsCache($vValue) {
        $this->_arrayRowsCache = $vValue;
        return $this;
    }
}