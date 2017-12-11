<?php

/**
 * Array Form Element
 *
 * @category  Aligent
 * @package   CustomFormElements
 * @author    Jim O'Halloran <jim@aligent.com.au>
 * @copyright 2014 Aligent Consulting.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.aligent.com.au/
 */
class Aligent_CustomFormElements_Block_Array extends Varien_Data_Form_Element_Abstract {

    /** @var $_childBlock Aligent_CustomFormElements_Block_Array_Generic */
    protected $_childBlock;

    public function __construct($attributes=array()) {
        parent::__construct($attributes);

        $this->_childBlock = Mage::app()->getLayout()->createBlock('aligent_customformelements/array_generic');
        $this->_childBlock->addData($attributes);
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


    /**
     * Enable or Disable the "Add After" buttons.
     *
     * @param $bValue boolean
     * @return $this
     */
    public function setAddAfter($bValue) {
        $this->_childBlock->setAddAfter($bValue);
        return $this;
    }


    /**
     * Indicates whether or not the "Add After" buttons will be displayed.
     *
     * @return bool
     */
    public function getAddAfter() {
        return $this->_childBlock->getAddAfter();
    }


    /**
     * Sets the label for the "Add" button.
     *
     * @param $vLabel string
     * @return $this
     */
    public function setAddButtonLabel($vLabel) {
        $this->_childBlock->setAddButtonLabel($vLabel);
        return $this;
    }


    /**
     * Returns the label for the "Add" button.
     *
     * @return string
     */
    public function getAddButtonLabel() {
        return $this->_childBlock->getAddButtonLabel();
    }


    /**
     * Enable or disable the "Copy JSON" and "Paste JSON" buttons.
     *
     * @param $bEnabled boolean True to show buttons
     * @return $this
     */
    public function setCanCopyPasteJson($bEnabled) {
        $this->_childBlock->setCanCopyPasteJson($bEnabled);
        return $this;
    }


    /**
     * Returns true if the "Copy JSON" and "Paste JSON" buttons are enabled.
     *
     * @return boolean
     */
    public function getCanCopyPasteJson() {
        return $this->_childBlock->getCanCopyPasteJson();
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

    public function getAfterElementHtml() {
        if (parent::getAfterElementHtml() != '') {
            return Mage::app()->getLayout()->createBlock('core/template')
                ->setTemplate('aligent/customformelements/form/field/array/change.phtml')
                ->setElement($this)
                ->toHtml();
        }
        return '';

    }
}
