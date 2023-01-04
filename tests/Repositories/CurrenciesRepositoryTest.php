<?php namespace Tests\Repositories;

use App\Models\Currencies;
use App\Repositories\CurrenciesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CurrenciesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CurrenciesRepository
     */
    protected $currenciesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->currenciesRepo = \App::make(CurrenciesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_currencies()
    {
        $currencies = Currencies::factory()->make()->toArray();

        $createdCurrencies = $this->currenciesRepo->create($currencies);

        $createdCurrencies = $createdCurrencies->toArray();
        $this->assertArrayHasKey('id', $createdCurrencies);
        $this->assertNotNull($createdCurrencies['id'], 'Created Currencies must have id specified');
        $this->assertNotNull(Currencies::find($createdCurrencies['id']), 'Currencies with given id must be in DB');
        $this->assertModelData($currencies, $createdCurrencies);
    }

    /**
     * @test read
     */
    public function test_read_currencies()
    {
        $currencies = Currencies::factory()->create();

        $dbCurrencies = $this->currenciesRepo->find($currencies->id);

        $dbCurrencies = $dbCurrencies->toArray();
        $this->assertModelData($currencies->toArray(), $dbCurrencies);
    }

    /**
     * @test update
     */
    public function test_update_currencies()
    {
        $currencies = Currencies::factory()->create();
        $fakeCurrencies = Currencies::factory()->make()->toArray();

        $updatedCurrencies = $this->currenciesRepo->update($fakeCurrencies, $currencies->id);

        $this->assertModelData($fakeCurrencies, $updatedCurrencies->toArray());
        $dbCurrencies = $this->currenciesRepo->find($currencies->id);
        $this->assertModelData($fakeCurrencies, $dbCurrencies->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_currencies()
    {
        $currencies = Currencies::factory()->create();

        $resp = $this->currenciesRepo->delete($currencies->id);

        $this->assertTrue($resp);
        $this->assertNull(Currencies::find($currencies->id), 'Currencies should not exist in DB');
    }
}
