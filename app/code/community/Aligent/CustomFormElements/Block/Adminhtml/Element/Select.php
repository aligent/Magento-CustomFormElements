<?php
class Aligent_CustomFormElements_Block_Adminhtml_Element_Select extends Mage_Core_Block_Abstract {
    const INPUT_PLACEHOLDER_CLASS = 'custom-el-input-placeholder';
    protected $_oOptions = array();
    protected $_bMultiple = false;
    protected $_bRequired = false;

    public function setOptionSource($vSourceClassName) {
        if (is_object($vSourceClassName)) {
            $oSource = $vSourceClassName;
        } else {
            $oSource = Mage::getSingleton($vSourceClassName);
        }

        $oSource = Mage::getSingleton($vSourceClassName);
        if (method_exists($oSource, 'toOptionArray')) {
            $this->_oOptions = $oSource->toOptionArray();
        } elseif (method_exists($oSource, 'getAllOptions')) {
            $this->_oOptions = $oSource->getAllOptions();
        }
        return $this;
    }

    public function setMultiple($bMultiple) {
        $this->_bMultiple = $bMultiple;
        return $this;
    }

    public function setRequired($bRequired) {
        $this->_bRequired = $bRequired;
        return $this;
    }

    protected function getInputField() {
        $html = '<input onChange="updateSelect(this)" type="text" name="' . $this->getInputName() . '" value="#{' . $this->getColumnName() . '}" ' .
            'class="input-text '. self::INPUT_PLACEHOLDER_CLASS .' "' .
            'style="display : none;" >';
        return $html;
    }

    protected function getElementHtml() {
        $vAddtional = $this->_bMultiple ? 'multiple' : '';
        $html = '<select id="'.$this->getInputName().'" onChange="updateField(this)" '. $vAddtional .' >';
        // Added blank value option (single select only)
        if ($this->_bRequired && !$this->_bMultiple) {
            $html .= '<option value="">Please select an option</option>';
        }

        foreach ($this->_oOptions as $aOption) {
            $html .= '<option value="'.$aOption['value'].'"> '. $aOption['label'] .' </option>';
        }

        $html .= '</select>';
        return $html;
    }

    protected  function _toHtml() {
        $html = $this->getElementHtml() . $this->getInputField();
        return $html;
    }
}
