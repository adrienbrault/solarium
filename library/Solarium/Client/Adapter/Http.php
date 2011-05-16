<?php
/**
 * Copyright 2011 Bas de Nooijer. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this listof conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * The views and conclusions contained in the software and documentation are
 * those of the authors and should not be interpreted as representing official
 * policies, either expressed or implied, of the copyright holder.
 *
 * @copyright Copyright 2011 Bas de Nooijer <solarium@raspberry.nl>
 * @license http://github.com/basdenooijer/solarium/raw/master/COPYING
 *
 * @package Solarium
 * @subpackage Client
 */

/**
 * Basic HTTP adapter using a stream
 *
 * @package Solarium
 * @subpackage Client
 */
class Solarium_Client_Adapter_Http extends Solarium_Client_Adapter
{

    /**
     * Handle Solr communication
     *
     * @throws Solarium_Exception
     * @param Solarium_Client_Request
     * @return Solarium_Client_Response
     */
    public function execute($request)
    {
        $method = $request->getMethod();
        $context = stream_context_create(
            array('http' => array(
                'method' => $method,
                'timeout' => $this->getTimeout()
            ))
        );

        if ($method == Solarium_Client_Request::METHOD_POST) {
            $data = $request->getRawData();
            if (null !== $data) {
                stream_context_set_option(
                    $context,
                    'http',
                    'content',
                    $data
                );
                //TODO header via request->setRawData!!
                stream_context_set_option(
                    $context,
                    'http',
                    'header',
                    'Content-Type: text/xml; charset=UTF-8'
                );
            }
        }

        $uri = $this->getBaseUri() . $request->getUri();
        $data = $this->_getData($uri, $context);
        
        // if there is no data and there are no headers it's a total failure,
        // a connection to the host was impossible. 
        if (false === $data && !isset($http_response_header)) {
            throw new Solarium_Client_HttpException("HTTP request failed");
        }

        return new Solarium_Client_Response($data, $http_response_header);
    }

    /**
     * Execute request
     *
     * @param string $uri
     * @param resource $context
     * @return string
     */
    protected function _getData($uri, $context)
    {
        return @file_get_contents($uri, false, $context);
    }

}