<?php

namespace Mageplaza\MagentoComponent\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ComponentSearchResultInterface
 * @package Mageplaza\MagentoComponent\Api\Data
 */
interface ComponentSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Mageplaza\MagentoComponent\Api\Data\ComponentInterface[]
     */
    public function getItems();

    /**
     * @param \Mageplaza\MagentoComponent\Api\Data\ComponentInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items = null);
}
