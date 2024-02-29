<?php

namespace avpet\Dreamkas\tests;

use avpet\Dreamkas\Api;
use avpet\Dreamkas\CustomerAttributes;
use avpet\Dreamkas\exceptions\ValidationException;
use avpet\Dreamkas\Payment;
use avpet\Dreamkas\Position;
use avpet\Dreamkas\Receipt;
use avpet\Dreamkas\TaxMode;
use GuzzleHttp\Exception\ClientException;


/**
 * Class ApiTest
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{

    public function testJson()
    {
        $api = new Api('FAKE', 123, Api::MODE_MOCK);
        $result = $api->json('GET', 'products');

        $this->assertSame([[]], $result);
    }

    public function testPostReceipt()
    {

        $api = new Api('FAKE', 123, Api::MODE_MOCK);

        $receipt = new Receipt();
        $receipt->taxMode = TaxMode::MODE_SIMPLE;
        $receipt->positions[] = new Position([
            'name' => 'Билет - тест',
            'quantity' => 2,
            'price' => 210000,
        ]);
        $receipt->payments[] = new Payment([
            'sum' => 420000,
        ]);
        $receipt->attributes = new CustomerAttributes([
            'email' => 'info@devgroup.ru',
        ]);

        $receipt->calculateSum();


        $response = [];
        try {
            $response = $api->postReceipt($receipt);
        } catch (ValidationException $e) {
            $this->assertFalse(true, 'Validation exception: ' . $e->getMessage());
        } catch (ClientException $e) {
            echo $e->getResponse()->getBody();
            $this->assertFalse(true, 'Client exception');
        }
        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('createdAt', $response);

//
        $receipt->type = Receipt::TYPE_REFUND;
        $response = [];
        try {
            $response = $api->postReceipt($receipt);
        } catch (ValidationException $e) {
            $this->assertFalse(true, 'Validation exception: ' . $e->getMessage());
        } catch (ClientException $e) {
            echo $e->getResponse()->getBody();
            $this->assertFalse(true, 'Client exception');
        }
        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('id', $response);
        $this->assertArrayHasKey('createdAt', $response);

    }


}
