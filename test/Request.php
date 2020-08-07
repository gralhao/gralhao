<?php

declare(strict_types=1);

namespace GralhaoTest;

class Request extends \Phalcon\Http\Request
{

    /**
     * @var array
     */
    private array $headers = [];

    /**
     * @var string
     */
    private string $body = '';

    /**
     * Set request http method
     *
     * @param string $method
     * @return self
     */
    public function setMethod(string $method): self
    {
        $_SERVER['REQUEST_METHOD'] = $method;
        return $this;
    }

    /**
     * Set request path
     *
     * @param string $path
     * @return self
     */
    public function setPath(string $path): self
    {
        $_SERVER['REQUEST_URI'] = $path;
        $_GET['_url'] = $path;
        return $this;
    }

    /**
     * Set request header
     *
     * @param string $key
     * @param string $value
     * @return self
     */
    public function setHeader(string $key, string $value): self
    {
        $this->headers[$key] = $value;
        return $this;
    }

    /**
     * Set request body
     *
     * @param string $body
     * @return self
     */
    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get request body
     *
     * @return string
     */
    public function getRawBody(): string
    {
        return $this->body;
    }

    /**
     * Get request headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}
