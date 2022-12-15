<?php

namespace App\Console\Commands;

use App\Models\Vacancy;
use Illuminate\Console\Command;

class VipVacanciesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'VipVacancies:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $vacancies = Vacancy::where("status", 1)->where('sortOrder', 1)->whereNotNull('PremiumEndDate')->get();
        foreach ($vacancies as $vacancy) {
            if ($vacancy->PremiumEndDate <=  date("Y-m-d H:i:s")) {
                $vacancy->sortOrder = 0;
                $vacancy->PremiumEndDate = null;
                $vacancy->save();
            }
        }
        $date = date("Y-m-d");
        $vacancies = Vacancy::where('EndDate', "<=", $date)->get();
        foreach ($vacancies as $vacancy) {
            $vacancy->status = 0;
            $vacancy->save();
        }
    }
}
