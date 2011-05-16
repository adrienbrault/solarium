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
 */

/**
 * Base class for plugins
 *
 * @package Solarium
 * @subpackage Plugin
 */
abstract class Solarium_Plugin_Abstract extends Solarium_Configurable
{

    /**
     * Client instance
     *
     * @var Solarium_Client
     */
    protected $_client;

    /**
     * Initialize
     *
     * This method is called when the plugin is registered to a client instance
     *
     * @param Solarium_Client $client
     * @param array $options
     */
    public function init($client, $options)
    {
        $this->_client = $client;
        parent::__construct($options);

        $this->_init();
    }

    /**
     * Secondary init function
     *
     * This is an extension point for plugin implemenations
     *
     * @return void
     */
    public function _init()
    {

    }

    /**
     *
     * @param Solarium_Query $query
     * @return void|Solarium_Client_Request
     */
    public function preCreateRequest($query)
    {
    }

    /**
     * @param Solarium_Query $query
     * @param Solarium_Client_Request $request
     * @return void
     */
    public function postCreateRequest($query, $request)
    {
    }

    /**
     * @param Solarium_Client_Request $request
     * @return void|Solarium_Client_Response
     */
    public function preExecuteRequest($request)
    {
    }

    /**
     * @param Solarium_Client_Request $request
     * @param Solarium_Client_Response $response
     * @return void
     */
    public function postExecuteRequest($request, $response)
    {
    }

    /**
     * @param Solarium_Query $query
     * @param Solarium_Client_Response $response
     * @return void|Solarium_Result
     */
    public function preCreateResult($query, $response)
    {
    }

    /**
     * @param Solarium_Query $query
     * @param Solarium_Client_Response $response
     * @param Solarium_Result $result
     * @return void
     */
    public function postCreateResult($query, $response, $result)
    {
    }

    /**
     * @param Solarium_Query $query
     * @return void|Solarium_Result
     */
    public function preExecute($query)
    {
    }

    /**
     * @param Solarium_Query $query
     * @param Solarium_Result $result
     * @return void
     */
    public function postExecute($query, $result)
    {
    }
    
    /**
     * @param string $query
     * @param mixed $options
     * @return void|Solarium_Query
     */
    public function preCreateQuery($type, $options)
    {
    }

    /**
     * @param string $query
     * @param mixed $options
     * @param Solarium_Query
     * @return void
     */
    public function postCreateQuery($type, $options, $query)
    {
    }

}