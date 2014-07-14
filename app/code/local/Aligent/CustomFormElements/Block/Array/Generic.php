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

    /**
     * Retrieve element label html
     *
     * @return string
     */
    public function getElementLabelHtml() {
        $element = $this->getElement();
        $label = $element->getLabel();
        if (!empty($label)) {
            $element->setLabel($this->__($label));
        }
        return $element->getLabelHtml();
    }


    /**
     * Retireve associated with element attribute object
     *
     * @return Mage_Catalog_Model_Resource_Eav_Attribute
     */
    public function getAttribute() {
        return $this->getElement()->getEntityAttribute();
    }


    /**
     * Retrieve data object related with form
     *
     * @return Mage_Catalog_Model_Product || Mage_Catalog_Model_Category
     */
    public function getDataObject() {
        return $this->getElement()->getForm()->getDataObject();
    }


    /**
     * Check "Use default" checkbox display availability
     *
     * @return bool
     */
    public function canDisplayUseDefault() {
        if ($attribute = $this->getAttribute()) {
            if (!$attribute->isScopeGlobal()
                && $this->getDataObject()
                && $this->getDataObject()->getId()
                && $this->getDataObject()->getStoreId()) {
                return true;
            }
        }
        return false;
    }


    /**
     * Check default value usage fact
     *
     * @return bool
     */
    public function usedDefault() {
        $attributeCode = $this->getAttribute()->getAttributeCode();
        $defaultValue = $this->getDataObject()->getAttributeDefaultValue($attributeCode);

        if (!$this->getDataObject()->getExistsStoreValueFlag($attributeCode)) {
            return true;
        } else if ($this->getElement()->getValue() == $defaultValue &&
            $this->getDataObject()->getStoreId() != $this->_getDefaultStoreId()
        ) {
            return false;
        }
        if ($defaultValue === false && !$this->getAttribute()->getIsRequired() && $this->getElement()->getValue()) {
            return false;
        }
        return $defaultValue === false;
    }


    /**
     * Retrieve label of attribute scope
     *
     * GLOBAL | WEBSITE | STORE
     *
     * @return string
     */
    public function getScopeLabel()
    {
        $html = '';
        $attribute = $this->getElement()->getEntityAttribute();
        if (!$attribute || Mage::app()->isSingleStoreMode() || $attribute->getFrontendInput()=='gallery') {
            return $html;
        }
        if ($attribute->isScopeGlobal()) {
            $html .= Mage::helper('adminhtml')->__('[GLOBAL]');
        } elseif ($attribute->isScopeWebsite()) {
            $html .= Mage::helper('adminhtml')->__('[WEBSITE]');
        } elseif ($attribute->isScopeStore()) {
            $html .= Mage::helper('adminhtml')->__('[STORE VIEW]');
        }

        return $html;
    }

}