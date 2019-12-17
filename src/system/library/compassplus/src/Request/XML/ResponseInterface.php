<?php


namespace Compassplus\Sdk\Request\XML;

/**
 * Interface ResponseInterface
 *
 * @package Compassplus\DataProvider\XML
 */
interface ResponseInterface
{
    /**
     * @param $fieldName
     * @return mixed
     */
    public function get($fieldName);
}
