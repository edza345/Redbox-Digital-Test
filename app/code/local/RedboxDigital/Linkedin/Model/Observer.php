<?php
/**
 * RedboxDigital_Linkedin
 *
 * @category  Redbox
 * @package   RedboxDigital_Linkedin
 * @author    Edgars Pavuls <edgarsp@scandiweb.com>
 * @copyright Copyright (c) 2018 Scandiweb, Ltd (http://scandiweb.com)
 * @license   http://opensource.org/licenses/afl-3.0.php Academic Free License (AFL 3.0)
 */

class RedboxDigital_Linkedin_Model_Observer
{
    public function adminSystemConfigChangedSectionRedboxdigitalLinkedin()
    {
        $entitySetup = Mage::getModel('eav/entity_setup', 'customer_setup');
        $entityConfig = Mage::getSingleton('eav/config');
        $helper = Mage::helper('redboxdigital_linkedin');
        /**
         * Get Store Config
         */
        $configIsRequired = $helper->linkedinIsRequired();
        $configIsEnabled = $helper->linkedinIsEnabled();
        /**
         * Get Attribute parameters
         */
        $entityType = $helper->getLinkedinEntityTypeId();
        $attributeCode = $helper->getLinkedinAttributeCode();
        $isUsedInForm = $helper->getUsedInForms();
        $linkedinAttribute = Mage::getModel('eav/entity_attribute')->loadByCode($entityType, $attributeCode);
        $linkedinIsRequired = $linkedinAttribute->getIsRequired();
        /**
         * Compare config with attribute options, if config is different, then proceed to set new data for attribute
         */
        if ($configIsRequired !== $linkedinIsRequired) {
            $entitySetup->updateAttribute($entityType, $attributeCode, array('is_required' => $configIsRequired));
        }
        if ($configIsEnabled) {
            $entityConfig->getAttribute('customer', 'linkedin_profile')
                ->setData('used_in_forms', $isUsedInForm)
                ->save();
        } else {
            $entityConfig->getAttribute('customer', 'linkedin_profile')
                ->setData('used_in_forms', array())
                ->save();
        }
    }
}