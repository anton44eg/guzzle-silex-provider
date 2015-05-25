<?php

namespace anton44eg\Tests;

use anton44eg\GuzzleServiceProvider;
use Silex\Application;


class GuzzleServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        $app = new Application();
        $app->register(new GuzzleServiceProvider());
        $this->assertInstanceOf('GuzzleHttp\Client', $app['guzzle.client']);

        // Test guzzle.base_url
        $app = new Application();
        $app['guzzle.base_url'] = '/test_base_url';
        $app->register(new GuzzleServiceProvider());
        /* @var $client \GuzzleHttp\Client */
        $client = $app['guzzle.client'];
        $this->assertEquals($client->getBaseUrl(), '/test_base_url');
    }
}