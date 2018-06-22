<?php

namespace Tests\AppBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProductTest extends WebTestCase
{

    public function setUp(){

    }

    /**
     * @group test
     */
    public function testProduct()
    {
        $client = static::createClient();
        $headers = ['HTTP_AUTHORIZATION' => "Bearer eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJqb2huZG9lIiwiaWF0IjoxNTI5NjczMTQ5LCJleHAiOjE1Mjk2NzY3NDl9.s29yz8fATbGTnGgRS31aa-50pcB7n_rTOBiinwtchnetOSLDSH-lcv8XK0jV9jn_FHDik2cjGSezXlhzOE6Ks5VVhNplKNgbhl8A8WmiaU1ZdMWsiPZvpAR7pcYKhrxK55QVfO4x7PSLZ7oSHQtdUOKAaa7AxOgCqRVvw_uGctIc_eJIqmTw71LoNHn_P623fZtj9W10GNc6mVhgdWk-kISJrIjeCpHzpQ3ZEARIWDE2uekCKUcg_9WcxE7dePz4k_RvbJ93CDD09nU968s2TU0qzeyUtduFx-NZGTWqN-DE_cH4Hwwnnm0Mg81P4rQM7ZNSbYJkTEMfRms4XBwl1c0chZvAhogLkbLwqKTLnVD4wuXI8FKAwUUByJXrYr8LHfmXWeQiGa2y_9pyvOymAeSTJ68LhvjY9dLgMCR6yKe7NEpcEOzvygjlmPxJ-5RPHtylQqToObbltiB8qBQiB_1GeyF0L6mPyyTT9E_YMJCLgDYdByIiX1on-_rR_ETxRRvdYgnNXUYFoVRAp514XavTOrv7Aa6BOb1SEJQ4Se6o0Dcsks1jdBuJwQHWwA9bhH2AJhLc4jJgWUQ8rI3LhCtFC__jbeSUVCyVLmKafgohqNM8JH536O6ZXCrq-E3lvQwn0uz0LEyGZI9o_13-efavmP8h82KsjpQ8fkfnBYI",
            'CONTENT_TYPE' => 'application/json'];
        $client->request('GET', '/api/products', [], [], $headers);

        static::assertEquals(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
    }
}