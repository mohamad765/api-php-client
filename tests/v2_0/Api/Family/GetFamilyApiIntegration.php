<?php

namespace Akeneo\Pim\ApiClient\tests\v2_0\Api\Family;

use Akeneo\Pim\ApiClient\tests\Common\Api\ApiTestCase;

class GetFamilyApiIntegration extends ApiTestCase
{
    public function testGet()
    {
        $api = $this->createClient()->getFamilyApi();
        $family = $api->get('boots');

        $expectedFamily = [
            'code'       => 'boots',
            'attributes' => [
                'color',
                'description',
                'manufacturer',
                'name',
                'price',
                'side_view',
                'size',
                'sku',
                'weather_conditions'
            ],
            'attribute_as_label'     => 'name',
            'attribute_requirements' => [
                'ecommerce' => [
                    'color',
                    'description',
                    'name',
                    'price',
                    'side_view',
                    'size',
                    'sku',
                ],
                'mobile' => [
                    'name',
                    'sku',
                ],
            ],
            'labels' => [
                'en_US' => 'Boots',
                'fr_FR' => 'Bottes',
            ],
        ];

        $this->assertSameContent($expectedFamily, $family);
    }
}
