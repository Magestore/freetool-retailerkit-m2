<?php


namespace Magestore\Retailerkittools\Model;

use Magestore\Retailerkittools\Api\Data\VendorInterface;

class Vendor extends \Magento\Framework\Model\AbstractModel implements VendorInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magestore\Retailerkittools\Model\ResourceModel\Vendor');
    }

    /**
     * Get vendor_id
     * @return string
     */
    public function getVendorId()
    {
        return $this->getData(self::VENDOR_ID);
    }

    /**
     * Set vendor_id
     * @param string $vendorId
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorId($vendorId)
    {
        return $this->setData(self::VENDOR_ID, $vendorId);
    }

    /**
     * Get vendor_name
     * @return string
     */
    public function getVendorName()
    {
        return $this->getData(self::VENDOR_NAME);
    }

    /**
     * Set vendor_name
     * @param string $vendor_name
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorName($vendor_name)
    {
        return $this->setData(self::VENDOR_NAME, $vendor_name);
    }

    /**
     * Get vendor_email
     * @return string
     */
    public function getVendorEmail()
    {
        return $this->getData(self::VENDOR_EMAIL);
    }

    /**
     * Set vendor_email
     * @param string $vendor_email
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorEmail($vendor_email)
    {
        return $this->setData(self::VENDOR_EMAIL, $vendor_email);
    }

    /**
     * Get vendor_phone
     * @return string
     */
    public function getVendorPhone()
    {
        return $this->getData(self::VENDOR_PHONE);
    }

    /**
     * Set vendor_phone
     * @param string $vendor_phone
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorPhone($vendor_phone)
    {
        return $this->setData(self::VENDOR_PHONE, $vendor_phone);
    }

    /**
     * Get vendor_address
     * @return string
     */
    public function getVendorAddress()
    {
        return $this->getData(self::VENDOR_ADDRESS);
    }

    /**
     * Set vendor_address
     * @param string $vendor_address
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorAddress($vendor_address)
    {
        return $this->setData(self::VENDOR_ADDRESS, $vendor_address);
    }

    /**
     * Get vendor_city
     * @return string
     */
    public function getVendorCity()
    {
        return $this->getData(self::VENDOR_CITY);
    }

    /**
     * Set vendor_city
     * @param string $vendor_city
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorCity($vendor_city)
    {
        return $this->setData(self::VENDOR_CITY, $vendor_city);
    }

    /**
     * Get vendor_country
     * @return string
     */
    public function getVendorCountry()
    {
        return $this->getData(self::VENDOR_COUNTRY);
    }

    /**
     * Set vendor_country
     * @param string $vendor_country
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorCountry($vendor_country)
    {
        return $this->setData(self::VENDOR_COUNTRY, $vendor_country);
    }

    /**
     * Get vendor_zipcode
     * @return string
     */
    public function getVendorZipcode()
    {
        return $this->getData(self::VENDOR_ZIPCODE);
    }

    /**
     * Set vendor_zipcode
     * @param string $vendor_zipcode
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorZipcode($vendor_zipcode)
    {
        return $this->setData(self::VENDOR_ZIPCODE, $vendor_zipcode);
    }

    /**
     * Get vendor_state
     * @return string
     */
    public function getVendorState()
    {
        return $this->getData(self::VENDOR_STATE);
    }

    /**
     * Set vendor_state
     * @param string $vendor_state
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorState($vendor_state)
    {
        return $this->setData(self::VENDOR_STATE, $vendor_state);
    }

    /**
     * Get vendor_state_id
     * @return string
     */
    public function getVendorStateId()
    {
        return $this->getData(self::VENDOR_STATE_ID);
    }

    /**
     * Set vendor_state_id
     * @param string $vendor_state_id
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorStateId($vendor_state_id)
    {
        return $this->setData(self::VENDOR_STATE_ID, $vendor_state_id);
    }
}
