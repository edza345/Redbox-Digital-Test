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

class RedboxDigital_Linkedin_Model_Customer_Form extends Mage_Customer_Model_Form {

    /**
     * Validate data array and check if vlaue is unique for custo mattributes with is_uniqe==1
     *
     * @param array $data
     * @return boolean|array
     */
    public function validateData(array $data)
    {
        $errors = array();
        foreach ($this->getAttributes() as $attribute) {
            if ($this->_isAttributeOmitted($attribute)) {
                continue;
            }
            $dataModel = $this->_getAttributeDataModel($attribute);
            $dataModel->setExtractedData($data);
            if (!isset($data[$attribute->getAttributeCode()])) {
                $data[$attribute->getAttributeCode()] = null;
            }
            $result = $dataModel->validateValue($data[$attribute->getAttributeCode()]);
            if ($result !== true) {
                $errors = array_merge($errors, $result);
            }
            if ($attribute->getIsUnique()) {
                $cid = $this->getEntity()->getData('entity_id'); //get current customer id
                $cli = Mage::getModel('customer/customer')
                    ->getCollection()
                    ->addAttributeToFilter($attribute->getAttributeCode(), $data[$attribute->getAttributeCode()])
                    ->addFieldToFilter('entity_id',   array('neq' => $cid)); //exclude current user from results  //###### not working......
                if (count($cli)>0) {
                    $label = $attribute->getStoreLabel();
                    $errors = array_merge($errors, array(Mage::helper('customer')->__('"%s" already used!',$label)));
                }
            }
        }
        if (count($errors) == 0) {
            return true;
        }

        return $errors;
    }
}