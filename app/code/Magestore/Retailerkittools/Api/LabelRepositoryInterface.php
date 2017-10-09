<?php


namespace Magestore\Retailerkittools\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface LabelRepositoryInterface
{


    /**
     * Save Label
     * @param \Magestore\Retailerkittools\Api\Data\LabelInterface $label
     * @return \Magestore\Retailerkittools\Api\Data\LabelInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Magestore\Retailerkittools\Api\Data\LabelInterface $label
    );

    /**
     * Retrieve Label
     * @param string $labelId
     * @return \Magestore\Retailerkittools\Api\Data\LabelInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($labelId);

    /**
     * Retrieve Label matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magestore\Retailerkittools\Api\Data\LabelSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Label
     * @param \Magestore\Retailerkittools\Api\Data\LabelInterface $label
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Magestore\Retailerkittools\Api\Data\LabelInterface $label
    );

    /**
     * Delete Label by ID
     * @param string $labelId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($labelId);
}
