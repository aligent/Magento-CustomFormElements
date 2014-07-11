<?php

class Aligent_CustomFormElements_Block_Array extends Varien_Data_Form_Element_Abstract {

    /** @var $_childBlock Aligent_CustomFormElements_Block_Array_Generic */
    protected $_childBlock;

    public function __construct($attributes=array()) {
        parent::__construct($attributes);

        $this->_childBlock = Mage::app()->getLayout()->createBlock('aligent_customformelements/array_generic');
    }

    public function getHtml() {
        $this->_childBlock->setElement($this);
        $html = $this->_childBlock->toHtml();
        $this->_childBlock->setArrayRowsCache(null); // doh, the object is used as singleton!

        return $html;
    }

    public function getHtmlAttributes() {
        return array();
    }

    public function setAddAfter($bValue) {
        $this->_childBlock->setAddAfter($bValue);
        return $this;
    }

    public function getAddAfter() {
        return $this->_childBlock->getAddAfter();
    }

    public function setAddButtonLabel($vLabel) {
        $this->_childBlock->setAddButtonLabel($vLabel);
        return $this;
    }

    public function getAddButtonLabel() {
        return $this->_childBlock->getAddButtonLabel();
    }

    /**
     * Add a column to array-grid
     *
     * @param string $name
     * @param array $params
     */
    public function addColumn($name, $params) {
        $this->_childBlock->addColumn($name, $params);
        return $this;
    }
}
