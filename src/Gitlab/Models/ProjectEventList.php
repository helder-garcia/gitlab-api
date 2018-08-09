<?php

namespace Gitlab\Models;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;

class ProjectEventList implements ResponseClassInterface, \ArrayAccess, \Iterator
{
    protected $storage = array();

    protected $pointer = 0;

    protected $headers = array();

    public static function fromCommand(OperationCommand $command)
    {
        $response = $command->getResponse();
        $items = $response->json();
        $headersString = $response->getRawHeaders();
        $matches = []; $headers = [];
        preg_match_all('/(X.*:\s\d+)/', $headersString, $matches);
        foreach ($matches[0] as $match) {
            $pieces = explode(": ", $match);
            $key = $pieces[0];
            $headers[$pieces[0]] = $pieces[1];
        }

        return new self($items, $headers);
    }

    public function __construct(array $items, array $headers)
    {
        $this->headers = $headers;
        foreach ($items as $item) {
            $issue = new ProjectEvent($item);
            $this->storage[] = $issue;
        }
    }
    
    public function getHeaderPage()
    {
        return $this->headers['X-Page'];
    }

    public function getHeaderNextPage()
    {
        return $this->headers['X-Next-Page'];
    }

    public function getHeaderPerPage()
    {
        return $this->headers['X-Per-Page'];
    }

    public function getHeaderTotal()
    {
        return $this->headers['X-Total'];
    }

    public function getHeaderTotalPages()
    {
        return $this->headers['X-Total-Pages'];
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->storage);
    }

    public function offsetGet($offset)
    {
        return $this->storage[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->storage[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->storage[$offset]);
    }


    public function current()
    {
        return $this->storage[$this->pointer];
    }

    public function next()
    {
        return $this->storage[$this->pointer++];
    }

    public function key()
    {
        return $this->pointer;
    }

    public function valid()
    {
        return isset($this->storage[$this -> pointer]);
    }

    public function rewind()
    {
        $this->pointer = 0;
    }

    public function count()
    {
        return count($this->storage);
    }
}
