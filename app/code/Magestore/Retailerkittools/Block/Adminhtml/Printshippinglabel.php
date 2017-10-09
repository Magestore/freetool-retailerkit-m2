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
 * @copyright   Copyright (c) 2012 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/**
 * Retailerkittools Custom Link Form Block
 * 
 * @category    Magestore
 * @package     Magestore_Retailerkittools
 * @author      Magestore Developer
 */
namespace Magestore\Retailerkittools\Block\Adminhtml;

class Printshippinglabel extends \Magento\Directory\Block\Data
{
    protected $retailerkittoolHelper;

    protected $storeManager;

    protected $vendor;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Directory\Helper\Data $directoryHelper,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\App\Cache\Type\Config $configCacheType,
        \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollectionFactory,
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory,
        \Magestore\Retailerkittools\Helper\Data $retailerkittoolHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magestore\Retailerkittools\Model\VendorFactory $vendor,
        \Magento\Backend\Model\UrlInterface $backendUrl,
        array $data = []
    ) {
        $this->_retailerkittoolHelper = $retailerkittoolHelper;        
        $this->_storeManager = $storeManager;
        $this->_vendor = $vendor;
        $this->_urlBuilder = $backendUrl;
        parent::__construct(
            $context,
            $directoryHelper,
            $jsonEncoder,
            $configCacheType,
            $regionCollectionFactory,
            $countryCollectionFactory,
            $data
        );
    }

    /**
     * @param null|string $defValue
     * @param string $name
     * @param string $id
     * @param string $title
     * @return string
     */
    public function getCountryHtmlSelect($defValue=null, $name='sender[country]', $id='sender_country', $title='Country')
    {
        \Magento\Framework\Profiler::start('TEST: ' . __METHOD__, ['group' => 'TEST', 'method' => __METHOD__]);
        $defValue = $this->_retailerkittoolHelper->getRetailerKitToolsConfig('shipping_sender','country');
        if ($defValue === null) {
            $defValue = $this->getCountryId();
        }
        $cacheKey = 'DIRECTORY_COUNTRY_SELECT_STORE_' . $this->_storeManager->getStore()->getCode();
        $cache = $this->_configCacheType->load($cacheKey);
        if ($cache) {
            $options = unserialize($cache);
        } else {
            $options = $this->getCountryCollection()
                ->setForegroundCountries($this->getTopDestinations())
                ->toOptionArray();
            $this->_configCacheType->save(serialize($options), $cacheKey);
        }
        $html = $this->getLayout()->createBlock(
            'Magento\Framework\View\Element\Html\Select'
        )->setName(
            $name
        )->setId(
            $id
        )->setTitle(
            __($title)
        )->setValue(
            $defValue
        )->setOptions(
            $options
        )->setExtraParams(
            'data-validate="{\'validate-select\':true}"'
        )->setClass(
            'form-control'
        )->getHtml();

        \Magento\Framework\Profiler::stop('TEST: ' . __METHOD__);
        return $html;
    }

    public function getCountryHtmlSelectForReceiver($defValue=null, $name='receiver[country]', $id='receiver_country', $title='Country')
    {
        if ($defValue === null) {
            $defValue = $this->getCountryId();
        }
        $cacheKey = 'DIRECTORY_COUNTRY_SELECT_STORE_' . $this->_storeManager->getStore()->getCode();
        $cache = $this->_configCacheType->load($cacheKey);
        if ($cache) {
            $options = unserialize($cache);
        } else {
            $options = $this->getCountryCollection()
                ->setForegroundCountries($this->getTopDestinations())
                ->toOptionArray();
            $this->_configCacheType->save(serialize($options), $cacheKey);
        }
        $html = $this->getLayout()->createBlock(
            'Magento\Framework\View\Element\Html\Select'
        )->setName(
            $name
        )->setId(
            $id
        )->setTitle(
            __($title)
        )->setValue(
            $defValue
        )->setOptions(
            $options
        )->setExtraParams(
            'data-validate="{\'validate-select\':true}"'
        )->setClass(
            'form-control'
        )->getHtml();

        \Magento\Framework\Profiler::stop('TEST: ' . __METHOD__);
        return $html;
    }

    /**
     * Return the id of the region being edited.
     *
     * @return int region id
     */
    public function getRegionId()
    {
        $regionId = $this->_retailerkittoolHelper->getRetailerKitToolsConfig('shipping_sender','state_id');
        return $regionId === null ? 0 : $regionId;
    }

    /**
     * Get config value.
     *
     * @param string $path
     * @return string|null
     */
    public function getConfig($path)
    {
        return $this->_scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getStoreManager()
    {
        return $this->_storeManager;
    }

    public function getAdminUrl(){
        return $this->_urlBuilder;
    }
}