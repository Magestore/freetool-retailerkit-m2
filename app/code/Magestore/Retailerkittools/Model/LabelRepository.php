<?php


namespace Magestore\Retailerkittools\Model;

use Magestore\Retailerkittools\Api\LabelRepositoryInterface;
use Magestore\Retailerkittools\Api\Data\LabelSearchResultsInterfaceFactory;
use Magestore\Retailerkittools\Api\Data\LabelInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magestore\Retailerkittools\Model\ResourceModel\Label as ResourceLabel;
use Magestore\Retailerkittools\Model\ResourceModel\Label\CollectionFactory as LabelCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class LabelRepository implements labelRepositoryInterface
{

    protected $resource;

    protected $labelFactory;

    protected $labelCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataLabelFactory;

    private $storeManager;


    /**
     * @param ResourceLabel $resource
     * @param LabelFactory $labelFactory
     * @param LabelInterfaceFactory $dataLabelFactory
     * @param LabelCollectionFactory $labelCollectionFactory
     * @param LabelSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceLabel $resource,
        LabelFactory $labelFactory,
        LabelInterfaceFactory $dataLabelFactory,
        LabelCollectionFactory $labelCollectionFactory,
        LabelSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->labelFactory = $labelFactory;
        $this->labelCollectionFactory = $labelCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataLabelFactory = $dataLabelFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Magestore\Retailerkittools\Api\Data\LabelInterface $label
    ) {
        /* if (empty($label->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $label->setStoreId($storeId);
        } */
        try {
            $label->getResource()->save($label);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the label: %1',
                $exception->getMessage()
            ));
        }
        return $label;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($labelId)
    {
        $label = $this->labelFactory->create();
        $label->getResource()->load($label, $labelId);
        if (!$label->getId()) {
            throw new NoSuchEntityException(__('Label with id "%1" does not exist.', $labelId));
        }
        return $label;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->labelCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Magestore\Retailerkittools\Api\Data\LabelInterface $label
    ) {
        try {
            $label->getResource()->delete($label);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Label: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($labelId)
    {
        return $this->delete($this->getById($labelId));
    }
}
