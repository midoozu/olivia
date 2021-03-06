<?php

/*
 * This file is part of the PHPFlasher package.
 * (c) Younes KHOUBZA <younes.khoubza@gmail.com>
 */

namespace Flasher\Prime\Http;

use Flasher\Prime\FlasherInterface;

final class RequestExtension
{
    /**
     * @var FlasherInterface
     */
    private $flasher;

    /**
     * @var array<string, string>
     */
    private $mapping;

    /**
     * @var ResponseExtension|null
     */
    private $responseExtension;

    /**
     * @param array<string, string[]> $mapping
     */
    public function __construct(
        FlasherInterface $flasher,
        array $mapping = array(),
        ResponseExtension $responseExtension = null
    ) {
        $this->flasher = $flasher;
        $this->mapping = $this->flatMapping($mapping);
        $this->responseExtension = $responseExtension;
    }

    /**
     * @return ResponseInterface
     */
    public function flash(RequestInterface $request, ResponseInterface $response)
    {
        if (!$request->hasSession()) {
            return $response;
        }

        foreach ($this->mapping as $alias => $type) {
            if (false === $request->hasType($alias)) {
                continue;
            }

            $messages = (array) $request->getType($alias);

            foreach ($messages as $message) {
                $this->flasher->addFlash($type, $message);
            }

            $request->forgetType($alias);
        }

        if (null === $this->responseExtension) {
            return $response;
        }

        return $this->responseExtension->render($request, $response);
    }

    /**
     * @param array<string, string[]> $mapping
     *
     * @return array<string, string>
     */
    private function flatMapping(array $mapping)
    {
        $flatMapping = array();

        foreach ($mapping as $type => $aliases) {
            foreach ($aliases as $alias) {
                $flatMapping[$alias] = $type;
            }
        }

        return $flatMapping;
    }
}
