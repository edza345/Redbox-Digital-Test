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

class RedboxDigital_Linkedin_Model_Source_Required
{

    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label'=>Mage::helper('redboxdigital_linkedin')->__('True')),
            array('value' => 0, 'label'=>Mage::helper('redboxdigital_linkedin')->__('False')),

        );
    }
}