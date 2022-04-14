<?php

namespace Mageplaza\MagentoComponent\Api\Data;

/**
 * Interface ComponentInterface
 * @package Mageplaza\MagentoComponent\Api\Data
 */
interface ComponentInterface
{
    /**
     * Constants defined for keys of array, makes typos less likely
     */
    const ID                    = 'id';
    const NAME                  = 'name';
    const STATUS                = 'status';
    const CREATED_AT            = 'created_at';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setId($value);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setName($value);

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setStatus($value);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setCreatedAt($value);
}
