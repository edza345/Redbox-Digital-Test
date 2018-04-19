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

class RedboxDigital_Linkedin_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getLinkedinAttributeCode()
    {
        $code = 'linkedin_profile';

        return $code;
    }

    public function getLinkedinEntityTypeId()
    {
        $code = 'customer';

        return $code;
    }

    public function getUsedInForms()
    {
        return array(
            'adminhtml_customer',
            'customer_account_create',
            'customer_account_edit',
            'checkout_register'
        );
    }

    public function linkedinIsEnabled()
    {
        return Mage::getStoreConfig('redboxdigital_linkedin/options/visible');
    }

    public function linkedinIsRequired()
    {
        return Mage::getStoreConfig('redboxdigital_linkedin/options/required');
    }
}