<?php

namespace Mageplaza\MagentoComponent\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 * @package Mageplaza\Smtp\Model\Source
 */
class Status implements OptionSourceInterface
{
    const STATUS_SUCCESS = 1;
    const STATUS_ERROR   = 0;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::STATUS_SUCCESS, 'label' => __('Reading')],
            ['value' => self::STATUS_ERROR, 'label' => __('Waiting')],
        ];
    }
}
