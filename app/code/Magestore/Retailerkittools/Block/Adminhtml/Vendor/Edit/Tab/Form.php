<?php

/**
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Retailerkittools
 * @module     Retailerkittools
 * @author      Magestore Developer
 *
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 *
 */

/**
 * Retailerkittools Earning Edit Form Content Tab Block
 * 
 * @category    Magestore
 * @package     Magestore_Retailerkittools
 * @author      Magestore Developer
 */ 
namespace  Magestore\Retailerkittools\Block\Adminhtml\Vendor\Edit\Tab;

class Form extends \Magento\Backend\Block\Widget\Form\Generic {

     public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Directory\Model\Config\Source\Country $countryFactory,
        \Magento\Directory\Model\Country $country,
        array $data = array()
    ) {        
        $this->_countryFactory = $countryFactory;
        $this->_country = $country;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * prepare tab form's information
     *
     * @return Magestore_Retailerkittools_Block_Adminhtml_Vendor_Edit_Tab_Form
     */
    protected function _prepareForm() {
        $form = $this->_formFactory->create();


        if ($this->_backendSession->getFormData()) {
            $data = $this->_backendSession->getFormData();
            $this->_backendSession->setFormData(null);
        } elseif ($this->_coreRegistry->registry('vendor_data')) {
            $data = $this->_coreRegistry->registry('vendor_data');
        }
        $fieldset = $form->addFieldset('retailerkittools_form', array(
            'legend' => __('Vendor Information')
        ));
        if ($data->getVendorId()) {
            $fieldset->addField('vendor_id', 'hidden', ['name' => 'vendor_id']);
        }
        $fieldset->addField('vendor_name', 'text', array(
            'name' => 'vendor_name',
            'label' => __('Name'),
            'title' => __('Name'),
            'required' => true
        ));

        $fieldset->addField('vendor_email', 'text', array(
            'name' => 'vendor_email',
            'label' => __('Email'),
            'title' => __('Email'),
            'required' => true,
            'class' => 'validate-email'
        ));

        $fieldset->addField('vendor_phone', 'text', array(
            'name' => 'vendor_phone',
            'label' => __('Phone'),
            'title' => __('Phone'),
            'required' => true
        ));

        $fieldset->addField('vendor_address', 'text', array(
            'name' => 'vendor_address',
            'label' => __('Address'),
            'title' => __('Address'),
            'required' => true
        ));

        $fieldset->addField('vendor_city', 'text', array(
            'name' => 'vendor_city',
            'label' => __('City'),
            'title' => __('City'),
            'required' => true
        ));

        $country = $fieldset->addField('vendor_country', 'select', array(
            'name'  => 'vendor_country',
            'label'     => __('Country'),
            'values'    => $this->_countryFactory->toOptionArray(),
            'class' => 'required-entry',
            'required' => true,
            'onchange' => 'getstate(this)',
        ));

        /** Add Ajax to the Country select box html output **/  


        $fieldset->addField('vendor_state', 'text', array(
            'name'  => 'vendor_state',
            'required' => true,
            'label' => __('State'),
            'values' => '--Please Select Country--',
        ));

        $countrycode = $this->_coreRegistry->registry('vendor_data')->getData('vendor_country');
        $statearray = array();
        $states = array();
        if($countrycode){
            $statearray = $this->_country->setId($countrycode)->getLoadedRegionCollection()->toOptionArray();
            // \Zend_Debug::dump($statearray);
            foreach ($statearray as $_state) {
                    $states[$_state['value']] = array(
                        'label' => $_state['label'],
                        'value' => $_state['value']
                    );
                }
            $fieldset->addField('vendor_state_id', 'select', array(
                'name'  => 'vendor_state_id',
                'required' => true,
                'label' => __('State'),
                'values' => $states
            ));
        }else{
            $fieldset->addField('vendor_state_id', 'select', array(
                'name'  => 'vendor_state_id',
                'required' => true,
                'label' => __('State'),
                'values' => $states
            ));
        }

        $fieldset->addField('vendor_zipcode', 'text', array(
            'name' => 'vendor_zipcode',
            'label' => __('Zip/Postcode'),
            'title' => __('Zip/Postcode'),
            'required' => true
        ));
        // $stateid = Mage::registry('vendor_data')->getData('vendor_state_id');
        $country->setAfterElementHtml("<script type=\"text/javascript\">
            function getstate(selectElement){
                var reloadurl = '". $this->getUrl('retailerkittools/vendor/state') . "country/' + selectElement.value;
                new Ajax.Request(reloadurl, {
                    method: 'get',
                    onComplete: function(transport){
                        var response = transport.responseText;   
                        if(response == ''){
                            $('vendor_state').up('.field-vendor_state').show();
                            $('vendor_state').addClassName('required-entry');                            
                            $('vendor_state_id').up('.field-vendor_state_id').hide();
                            $('vendor_state_id').removeClassName('required-entry');
                        }else{
                            $('vendor_state_id').update(response);
                            $('vendor_state').up('.field-vendor_state').hide();
                            $('vendor_state').removeClassName('required-entry');
                            $('vendor_state_id').up('.field-vendor_state_id').show();
                            $('vendor_state_id').addClassName('required-entry');
                            $('vendor_state').value = '';
                        }   
                    }
                });
            }
            window.onload = function(){
                var statearray = '".json_encode($statearray) ."';
                if(statearray.length > 2){
                    $('vendor_state').up('.field-vendor_state').hide();
                    $('vendor_state').removeClassName('required-entry');
                    $('vendor_state_id').up('.field-vendor_state_id').show();
                    
                }else{
                    $('vendor_state').up('.field-vendor_state').show();
                    $('vendor_state_id').removeClassName('required-entry');
                    $('vendor_state_id').up('.field-vendor_state_id').hide();
                }
            }
        </script>");
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}
