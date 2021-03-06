<?php

namespace Akeneo\Pim\ApiClient\tests\v2_0\Api\Channel;

use Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException;
use Akeneo\Pim\ApiClient\tests\Common\Api\ApiTestCase;

class CreateChannelApiIntegration extends ApiTestCase
{
    public function testCreate()
    {
        $api = $this->createClient()->getChannelApi();
        $response = $api->create('paper', [
            'currencies'    => [
                'USD',
                'EUR',
            ],
            'locales'       => [
                'en_US',
                'fr_FR',
            ],
            'category_tree' => '2014_collection',
        ]);

        $this->assertSame(201, $response);

        $channel = $api->get('paper');
        $this->assertSameContent(
            [
                'code'          => 'paper',
                'currencies'    => [
                    'USD',
                    'EUR',
                ],
                'locales'       => [
                    'en_US',
                    'fr_FR',
                ],
                'category_tree' => '2014_collection',
            ],
            $channel
        );
    }

    public function testCreateAnExistingChannel()
    {
        $api = $this->createClient()->getChannelApi();

        try {
            $api->create('ecommerce', [
                'currencies'    => [
                    'USD',
                    'EUR',
                ],
                'locales'       => [
                    'en_US',
                    'fr_FR',
                ],
                'category_tree' => '2014_collection',
            ]);
        } catch (UnprocessableEntityHttpException $exception) {
            $this->assertSame(
                [
                    [
                        'property' => 'code',
                        'message'  => 'This value is already used.',
                    ],
                ],
                $exception->getResponseErrors()
            );
        }

    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\UnprocessableEntityHttpException
     */
    public function testCreateAnInvalidChannel()
    {
        $api = $this->createClient()->getChannelApi();
        $api->create(
            'fail',
            [
                'category_tree' => 'unknown_tree',
            ]
        );
    }
}
