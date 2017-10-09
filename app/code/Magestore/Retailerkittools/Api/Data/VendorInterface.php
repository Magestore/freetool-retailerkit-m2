<?php


namespace Magestore\Retailerkittools\Api\Data;

interface VendorInterface
{

    const VENDOR_EMAIL = 'vendor_email';
    const VENDOR_STATE = 'vendor_state';
    const VENDOR_ID = 'vendor_id';
    const VENDOR_CITY = 'vendor_city';
    const VENDOR_PHONE = 'vendor_phone';
    const VENDOR_COUNTRY = 'vendor_country';
    const VENDOR_ADDRESS = 'vendor_address';
    const VENDOR_STATE_ID = 'vendor_state_id';
    const VENDOR_ZIPCODE = 'vendor_zipcode';
    const VENDOR_NAME = 'vendor_name';


    /**
     * Get vendor_id
     * @return string|null
     */
    public function getVendorId();

    /**
     * Set vendor_id
     * @param string $vendor_id
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorId($vendorId);

    /**
     * Get vendor_name
     * @return string|null
     */
    public function getVendorName();

    /**
     * Set vendor_name
     * @param string $vendor_name
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorName($vendor_name);

    /**
     * Get vendor_email
     * @return string|null
     */
    public function getVendorEmail();

    /**
     * Set vendor_email
     * @param string $vendor_email
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorEmail($vendor_email);

    /**
     * Get vendor_phone
     * @return string|null
     */
    public function getVendorPhone();

    /**
     * Set vendor_phone
     * @param string $vendor_phone
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorPhone($vendor_phone);

    /**
     * Get vendor_address
     * @return string|null
     */
    public function getVendorAddress();

    /**
     * Set vendor_address
     * @param string $vendor_address
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorAddress($vendor_address);

    /**
     * Get vendor_city
     * @return string|null
     */
    public function getVendorCity();

    /**
     * Set vendor_city
     * @param string $vendor_city
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorCity($vendor_city);

    /**
     * Get vendor_country
     * @return string|null
     */
    public function getVendorCountry();

    /**
     * Set vendor_country
     * @param string $vendor_country
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorCountry($vendor_country);

    /**
     * Get vendor_zipcode
     * @return string|null
     */
    public function getVendorZipcode();

    /**
     * Set vendor_zipcode
     * @param string $vendor_zipcode
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorZipcode($vendor_zipcode);

    /**
     * Get vendor_state
     * @return string|null
     */
    public function getVendorState();

    /**
     * Set vendor_state
     * @param string $vendor_state
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorState($vendor_state);

    /**
     * Get vendor_state_id
     * @return string|null
     */
    public function getVendorStateId();

    /**
     * Set vendor_state_id
     * @param string $vendor_state_id
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     */
    public function setVendorStateId($vendor_state_id);
}
