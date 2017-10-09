<?php


namespace Magestore\Retailerkittools\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface InvoiceRepositoryInterface
{


    /**
     * Save Invoice
     * @param \Magestore\Retailerkittools\Api\Data\InvoiceInterface $invoice
     * @return \Magestore\Retailerkittools\Api\Data\InvoiceInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Magestore\Retailerkittools\Api\Data\InvoiceInterface $invoice
    );

    /**
     * Retrieve Invoice
     * @param string $invoiceId
     * @return \Magestore\Retailerkittools\Api\Data\InvoiceInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($invoiceId);

    /**
     * Retrieve Invoice matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magestore\Retailerkittools\Api\Data\InvoiceSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Invoice
     * @param \Magestore\Retailerkittools\Api\Data\InvoiceInterface $invoice
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Magestore\Retailerkittools\Api\Data\InvoiceInterface $invoice
    );

    /**
     * Delete Invoice by ID
     * @param string $invoiceId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($invoiceId);
}
