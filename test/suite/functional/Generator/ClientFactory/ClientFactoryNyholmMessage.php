<?php declare(strict_types=1);

/*
 * This file was generated by docler-labs/api-client-generator.
 *
 * Do not edit it manually.
 */

namespace Test;

use GuzzleHttp\Client;
use InvalidArgumentException;
use Pimple\Container;
use Psr\Container\ContainerInterface;
use Psr\Container\ContainerInterface as Psr11Container;
use Psr\Http\Client\ClientInterface;
use Test\Request\Mapper\NyholmRequestMapper;
use Test\Request\Mapper\RequestMapperInterface;
use Test\Response\Handler\ResponseHandler;
use Test\Serializer\BodySerializer;

class SwaggerPetstoreClientFactory
{
    /**
     * @param string $baseUri
     * @param array  $options
     *
     * @return SwaggerPetstoreClient
     */
    public function create(string $baseUri, array $options = []): SwaggerPetstoreClient
    {
        return new SwaggerPetstoreClient($this->initBaseClient($baseUri, $options), $this->initRequestMapper(), new ResponseHandler(), $this->initContainer());
    }

    private function initBaseClient(string $baseUri, array $options): ClientInterface
    {
        if (\substr($baseUri, -1) !== '/') {
            throw new InvalidArgumentException('Base URI should end with the `/` symbol.');
        }
        $default = ['base_uri' => $baseUri, 'timeout' => 3, 'http_errors' => false];
        $config  = \array_replace_recursive($default, $options);

        return new Client($config);
    }

    private function initRequestMapper(): RequestMapperInterface
    {
        return new NyholmRequestMapper(new BodySerializer());
    }

    private function initContainer(): ContainerInterface
    {
        $pimpleContainer = new Container();
        $container       = new Psr11Container($pimpleContainer);
        $serviceProvider = new ServiceProvider();
        $serviceProvider->register($pimpleContainer);

        return $container;
    }
}
