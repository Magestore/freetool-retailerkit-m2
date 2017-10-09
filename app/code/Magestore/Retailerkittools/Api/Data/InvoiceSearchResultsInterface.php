<?php


namespace Magestore\Retailerkittools\Api\Data;

interface InvoiceSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Invoice list.
     * @return \Magestore\Retailerkittools\Api\Data\InvoiceInterface[]
     */
    public function getItems();

    /**
     * Set invoice_data list.
     * @param \Magestore\Retailerkittools\Api\Data\InvoiceInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
