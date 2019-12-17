<?php


namespace Compassplus\Sdk\Response;

/**
 * Interface ResponseInterface
 *
 * @package Compassplus\Response
 */
interface ResponseInterface
{
    /**
     * @param $fieldName
     * @return mixed
     */
    public function get($fieldName);
}
