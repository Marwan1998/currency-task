<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Currencies;

class CurrenciesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_currencies()
    {
        $currencies = Currencies::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/currencies', $currencies
        );

        $this->assertApiResponse($currencies);
    }

    /**
     * @test
     */
    public function test_read_currencies()
    {
        $currencies = Currencies::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/currencies/'.$currencies->id
        );

        $this->assertApiResponse($currencies->toArray());
    }

    /**
     * @test
     */
    public function test_update_currencies()
    {
        $currencies = Currencies::factory()->create();
        $editedCurrencies = Currencies::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/currencies/'.$currencies->id,
            $editedCurrencies
        );

        $this->assertApiResponse($editedCurrencies);
    }

    /**
     * @test
     */
    public function test_delete_currencies()
    {
        $currencies = Currencies::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/currencies/'.$currencies->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/currencies/'.$currencies->id
        );

        $this->response->assertStatus(404);
    }
}
