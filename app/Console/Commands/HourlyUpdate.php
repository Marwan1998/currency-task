<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Currencies;
use App\Models\currencies_info;


class HourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hourly:deleteUpdates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete repetitive currencies updates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currencyIDs = Currencies::all(['id']); // will loop through.
        $currencyValues = Currencies::with('currencies')->get();

        foreach ($currencyIDs as $i => $idObj) {
            $id = $idObj->id;
            $idOfLastValue = $currencyValues[$i]->currencies->id;
            try {
                currencies_info::where('currency_id', $id)->where('id', '!=', $idOfLastValue)->delete();
            } catch (\Throwable $th) {
                return [
                    'Error' => $this->line("<fg=red>An error occurred while trying to execute the query: </>"),
                    'Message' => $this->line('<fg=red>'.$th->getMessage().'<\>')
                ];
            }
            // var_dump("for this currency:$id'.' | '.'delete all excpt:$idOfLastValue");
        }

        return $this->line('<fg=green>Query executed successfully</>');
    }
}
