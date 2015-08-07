<?php

/**
 * JSON Serialised attribute backend.  Based on the Magento Serialized backend.
 *
 * @category  Aligent
 * @package   CustomFormElements
 * @author    Jim O'Halloran <jim@aligent.com.au>
 * @copyright 2014 Aligent Consulting.
 * @copyright Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.aligent.com.au/
 */
class Aligent_CustomFormElements_Model_Entity_Attribute_Backend_Serialized_Json
    extends Mage_Eav_Model_Entity_Attribute_Backend_Serialized {

    /**
     * Serialize before saving
     *
     * @param Varien_Object $object
     * @return Mage_Eav_Model_Entity_Attribute_Backend_Serialized
     */
    public function beforeSave($object) {
        // parent::beforeSave() is not called intentionally
        $attrCode = $this->getAttribute()->getAttributeCode();
        if ($object->hasData($attrCode)) {
            $object->setData($attrCode, Mage::helper('aligent_customformelements')->jsonEncodeIfRequired($object->getData($attrCode)));
        }

        return $this;
    }


    /**
     * Try to unserialize the attribute value
     *
     * @param Varien_Object $object
     * @return Mage_Eav_Model_Entity_Attribute_Backend_Serialized
     */
    protected function _unserialize(Varien_Object $object) {
        $attrCode = $this->getAttribute()->getAttributeCode();
        if ($object->getData($attrCode)) {
            try {
                $unserialized = Mage::helper('core')->jsonDecode($object->getData($attrCode));
                $object->setData($attrCode, $unserialized);
            } catch (Exception $e) {
                $object->unsetData($attrCode);
            }
        }

        return $this;
    }
}
