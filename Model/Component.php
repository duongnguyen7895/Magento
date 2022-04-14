<?php
namespace Mageplaza\MagentoComponent\Model;

use Magento\Framework\Model\AbstractModel;
use Mageplaza\MagentoComponent\Api\Data\ComponentInterface;

class Component extends AbstractModel implements ComponentInterface
{
    protected $_eventPrefix = 'magento_component_table';

    protected $_idFieldName = 'id';

    protected $_cacheTag = 'magento_component_table';

    const CACHE_TAG = 'magento_component_table';

    public function _construct()
    {
        $this->_init(ResourceModel\Component::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }


    public function getId()
    {
        return $this->getData(self::ID);
    }

    public function setId($value)
    {
        return $this->setData(self::ID, $value);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt($value)
    {
        return $this->setData(self::CREATED_AT, $value);
    }

    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    public function setStatus($value)
    {
        return $this->setData(self::STATUS, $value);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($value)
    {
        return $this->setData(self::NAME, $value);
    }
}


