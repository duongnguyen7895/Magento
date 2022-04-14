<?php
namespace Mageplaza\MagentoComponent\Model\ResourceModel\Component;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mageplaza\MagentoComponent\Model\ResourceModel\Component;


class Collection extends AbstractCollection
{
    /**
     * @type string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Mageplaza\MagentoComponent\Model\Component::class, Component::class);
    }

}
