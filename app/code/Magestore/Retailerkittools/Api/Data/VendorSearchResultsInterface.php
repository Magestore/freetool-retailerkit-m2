<?php


namespace Magestore\Retailerkittools\Api\Data;

interface VendorSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Vendor list.
     * @return \Magestore\Retailerkittools\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * Set vendor_name list.
     * @param \Magestore\Retailerkittools\Api\Data\VendorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
