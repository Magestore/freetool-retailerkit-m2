<?php


namespace Magestore\Retailerkittools\Api\Data;

interface LabelInterface
{

    const LABEL_DATA = 'label_data';
    const LABEL_ID = 'label_id';


    /**
     * Get label_id
     * @return string|null
     */
    public function getLabelId();

    /**
     * Set label_id
     * @param string $label_id
     * @return \Magestore\Retailerkittools\Api\Data\LabelInterface
     */
    public function setLabelId($labelId);

    /**
     * Get label_data
     * @return string|null
     */
    public function getLabelData();

    /**
     * Set label_data
     * @param string $label_data
     * @return \Magestore\Retailerkittools\Api\Data\LabelInterface
     */
    public function setLabelData($label_data);
}
