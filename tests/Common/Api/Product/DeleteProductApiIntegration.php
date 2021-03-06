<?php

namespace Akeneo\Pim\ApiClient\tests\Common\Api\Product;

class DeleteProductApiIntegration extends AbstractProductApiTestCase
{
    public function testDeleteSuccessful()
    {
        $api = $this->createClient()->getProductApi();
        $response = $api->delete('docks_white');

        $this->assertSame(204, $response);
    }

    /**
     * @expectedException \Akeneo\Pim\ApiClient\Exception\NotFoundHttpException
     */
    public function testDeleteOnAnUnknownProduct()
    {
        $api = $this->createClient()->getProductApi();
        $api->delete('unknown');
    }
}
