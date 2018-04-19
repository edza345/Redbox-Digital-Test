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
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeId     = $setup->getEntityTypeId('customer');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
$quote_table_name = $installer->getTable('sales/quote');

$setup->addAttribute("customer", "linkedin_profile",  array(
    'type'     => 'varchar',
    'backend'  => '',
    'maxlength' => 250,
    'label'    => 'Linkedin Profile',
    'input'    => 'text',
    'source'   => '',
    'visible'  => true,
    'required' => false,
    'default' => '',
    'frontend' => '',
    'unique'     => true,
    'used_in_forms' => array(
        'adminhtml_customer',
        'customer_account_create',
        'customer_account_edit',
        'checkout_register'
    ),
    'note'       => 'Linkedin Profile Url'

));

$attribute   = Mage::getSingleton('eav/config')->getAttribute('customer', 'linkedin_profile');


$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'linkedin_profile',
    '999'  //sort_order
);

$attribute->setData('used_in_forms', array('customer_account_edit','customer_account_create','adminhtml_customer','checkout_register'))
    ->setData('is_used_for_customer_segment', true)
    ->setData('is_system', 0)
    ->setData('is_user_defined', 1)
    ->setData('is_visible', 1)
    ->setData('sort_order', 100);
$attribute->save();
/**
 * Adding collumn for sale/quote in order to sve custom attributes from checkout
 */
$installer->run("ALTER TABLE $quoteTableName ADD `linkedin_profile` varchar(250) NOT NULL");

$installer->endSetup();