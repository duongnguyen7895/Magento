<?php
namespace Mageplaza\MagentoComponent\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;


class Component extends AbstractDb
{
    /**
     * @var DateTime
     */
    protected $date;

    /**
     * Log constructor.
     *
     * @param DateTime $date
     * @param Context $context
     */
    public function __construct(
        DateTime $date,
        Context $context
    ) {
        $this->date = $date;
        parent::__construct($context);
    }

    public function _construct()
    {
        $this->_init('magento_component_table', 'id');
    }

    protected function _beforeSave(AbstractModel $object)
    {
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->date->date());
        }

        return parent::_beforeSave($object);
    }
}


