<?php

namespace Mageplaza\MagentoComponent\Model\Indexer;

use Magento\Framework\Indexer\ActionInterface as IndexAction;
use Magento\Framework\Mview\ActionInterface;

class Test implements ActionInterface, IndexAction
{
    public $_cacheTypeList;

    public $_cacheFrontendPool;

    public function __construct(
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool     $cacheFrontendPool
    )
    {
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
    }

    /*
      * Used by mview, allows process indexer in the "Update on schedule" mode
      */
    public function execute($ids)
    {
        $types = array('config', 'layout', 'block_html', 'collections', 'reflection', 'db_ddl', 'eav', 'config_integration', 'config_integration_api', 'full_page', 'translate', 'config_webservice');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
    }

    /*
     * Will take all of the data and reindex
     * Will run when reindex via command line
     */
    public function executeFull()
    {
        //code here!
    }


    /*
     * Works with a set of entity changed (may be massaction)
     */
    public function executeList(array $ids)
    {
        //code here!
    }


    /*
     * Works in runtime for a single entity using plugins
     */
    public function executeRow($id)
    {
        //code here!
    }
}
