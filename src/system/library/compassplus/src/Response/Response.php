<?php


namespace Compassplus\Sdk\Response;

/**
 * Class Response
 *
 * @package Compassplus\Response
 */
class Response
{
    /** @var  ResponseStrategy */
    private $response;

    /**
     * Response constructor.
     *
     * @param $data
     * @throws \Exception
     */
    public function __construct($data)
    {
        $this->response = new ResponseStrategy($data);
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->getString('Status');
    }

    /**
     * @param string $fieldName
     * @return string
     */
    protected function getString($fieldName)
    {
        return $this->response->get($fieldName);
    }

    /**
     * @return string
     */
    public function getOperation()
    {
        return $this->getString('Operation');
    }

    /**
     * @param $parentNode
     * @param $fieldName
     * @param $attributeValue
     * @return string
     */
    public function getAttributeName($parentNode, $fieldName, $attributeValue)
    {
        return (string)$this->response->getAttributeName($parentNode, $fieldName, $attributeValue);
    }

    /**
     * @param $fieldName
     * @return int
     */
    protected function getInteger($fieldName)
    {
        return $this->response->get($fieldName);
    }
}
