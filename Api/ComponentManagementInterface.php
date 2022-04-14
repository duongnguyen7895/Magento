<?php
namespace Mageplaza\MagentoComponent\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface RulesManagementInterface
 * @package Mageplaza\CallForPrice\Api
 */
interface ComponentManagementInterface
{
    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return \Mageplaza\MagentoComponent\Api\Data\ComponentSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * @param \Mageplaza\MagentoComponent\Api\Data\ComponentInterface $component
     *
     * @return \Mageplaza\MagentoComponent\Api\Data\ComponentInterface
     */
    public function save(\Mageplaza\MagentoComponent\Api\Data\ComponentInterface $component);

    /**
     * @param string $id
     *
     * @return bool
     */
    public function delete($id);
}
