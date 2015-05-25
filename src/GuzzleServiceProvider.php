<?php

namespace anton44eg;

use GuzzleHttp\Client;
use GuzzleHttp\Event\Emitter;
use GuzzleHttp\Message\MessageFactory;
use GuzzleHttp\Utils;
use Silex\Application;
use Silex\ServiceProviderInterface;


class GuzzleServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register(Application $app)
    {
        if (!isset($app['guzzle.base_url'])) {
            $app['guzzle.base_url'] = '/';
        }

        if (!isset($app['guzzle.handler'])) {
            $app['guzzle.handler'] = Utils::getDefaultHandler();
        }

        if (!isset($app['guzzle.message_factory'])) {
            $app['guzzle.message_factory'] = new MessageFactory();
        }

        if (!isset($app['guzzle.defaults'])) {
            $app['guzzle.defaults'] = [];
        }

        if (!isset($app['guzzle.emitter'])) {
            $app['guzzle.emitter'] = new Emitter();
        }

        $app['guzzle.client'] = function ($app) {
            return new Client(array(
                'base_url' => $app['guzzle.base_url'],
                'message_factory' => $app['guzzle.message_factory'],
                'defaults' => $app['guzzle.defaults'],
                'emitter' => $app['guzzle.emitter'],
            ));
        };
    }

    /**
     * @inheritdoc
     */
    public function boot(Application $app)
    {
    }
}
