<?php
/**
 * Copyright © 2017 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magestore\Retailerkittools\Controller\Adminhtml\Dashboard;

/**
 * Class Index
 * @package Magestore\Giftvoucher\Controller\Adminhtml\GiftProduct
 */
class Index extends \Magestore\Retailerkittools\Controller\Adminhtml\Dashboard
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Magento_Sales::sales');
        $resultPage->getConfig()->getTitle()->prepend(__('Retailer Kit Tool Dashboard'));
        return $resultPage;
    }
}
