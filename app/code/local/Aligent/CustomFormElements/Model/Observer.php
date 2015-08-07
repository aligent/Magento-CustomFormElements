<?php

/**
 * JSON Serialised attribute backend observer functions.
 *
 * @category  Aligent
 * @package   CustomFormElements
 * @author    Aaron Edmonds <aarone@copio.us>
 * @author    Jim O'Halloran <jim@aligent.com.au>
 * @copyright 2014 Aligent Consulting.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://www.aligent.com.au/
 */
class Aligent_CustomFormElements_Model_Observer {

    /**
     * Observe the catalog_product_attribute_update_before event and ensure
     * attributes with the JSON backend are saved correctly.
     */
    public function catalogProductAttributeUpdateBefore(Varien_Event_Observer $oObserver) {
        $aAttrData = $oObserver->getEvent()->getAttributesData();

        $aCustomFormAttrs = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('backend_model', 'aligent_customformelements/entity_attribute_backend_serialized_json')
            ->load();

        foreach ($aAttrData as $vAttrCode => $vAttrValue) {
            $oAttribute = $aCustomFormAttrs->getItemByColumnValue('attribute_code', $vAttrCode);

            if ($oAttribute) {
                $aAttrData[$vAttrCode] = Mage::helper('aligent_customformelements')->jsonEncodeIfRequired($vAttrValue);
            }
        }

        $oObserver->getEvent()->setAttributesData($aAttrData);
    }
}