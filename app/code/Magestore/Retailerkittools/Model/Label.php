<?php


namespace Magestore\Retailerkittools\Model;

use Magestore\Retailerkittools\Api\Data\LabelInterface;

class Label extends \Magento\Framework\Model\AbstractModel implements LabelInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magestore\Retailerkittools\Model\ResourceModel\Label');
    }

    /**
     * Get label_id
     * @return string
     */
    public function getLabelId()
    {
        return $this->getData(self::LABEL_ID);
    }

    /**
     * Set label_id
     * @param string $labelId
     * @return \Magestore\Retailerkittools\Api\Data\LabelInterface
     */
    public function setLabelId($labelId)
    {
        return $this->setData(self::LABEL_ID, $labelId);
    }

    /**
     * Get label_data
     * @return string
     */
    public function getLabelData()
    {
        return $this->getData(self::LABEL_DATA);
    }

    /**
     * Set label_data
     * @param string $label_data
     * @return \Magestore\Retailerkittools\Api\Data\LabelInterface
     */
    public function setLabelData($label_data)
    {
        return $this->setData(self::LABEL_DATA, $label_data);
    }
}
