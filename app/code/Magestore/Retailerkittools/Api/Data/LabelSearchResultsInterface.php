<?php


namespace Magestore\Retailerkittools\Api\Data;

interface LabelSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Label list.
     * @return \Magestore\Retailerkittools\Api\Data\LabelInterface[]
     */
    public function getItems();

    /**
     * Set label_data list.
     * @param \Magestore\Retailerkittools\Api\Data\LabelInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
