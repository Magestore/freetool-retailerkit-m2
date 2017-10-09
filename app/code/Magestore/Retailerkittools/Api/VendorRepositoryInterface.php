<?php


namespace Magestore\Retailerkittools\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface VendorRepositoryInterface
{


    /**
     * Save Vendor
     * @param \Magestore\Retailerkittools\Api\Data\VendorInterface $vendor
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Magestore\Retailerkittools\Api\Data\VendorInterface $vendor
    );

    /**
     * Retrieve Vendor
     * @param string $vendorId
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($vendorId);

    /**
     * Retrieve Vendor matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magestore\Retailerkittools\Api\Data\VendorSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Vendor
     * @param \Magestore\Retailerkittools\Api\Data\VendorInterface $vendor
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Magestore\Retailerkittools\Api\Data\VendorInterface $vendor
    );

    /**
     * Delete Vendor by ID
     * @param string $vendorId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($vendorId);
}
