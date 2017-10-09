<?php


namespace Magestore\Retailerkittools\Api\Data;

interface OrderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Order list.
     * @return \Magestore\Retailerkittools\Api\Data\OrderInterface[]
     */
    public function getItems();

    /**
     * Set order_data list.
     * @param \Magestore\Retailerkittools\Api\Data\OrderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
