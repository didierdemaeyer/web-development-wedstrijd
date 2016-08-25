<?php

namespace App\Console\Commands;

use App\Classes\ContestService;
use App\ContestPeriod;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SelectContestWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'select-contest-winner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Select a contest winner at the end of a period.';

    /**
     * @var ContestService
     */
    private $contestService;

    /**
     * Create a new command instance.
     *
     * @param ContestService $contestService
     */
    public function __construct(ContestService $contestService)
    {
        parent::__construct();

        $this->contestService = $contestService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $previousPeriod = ContestPeriod::getPreviousPeriod();
        
        if (($previousPeriod->enddate < Carbon::now()) && ($previousPeriod->enddate > Carbon::now()->subMinutes(10))) {
            $this->contestService->selectWinnerForPeriod($previousPeriod);
            \Log::alert('Contest winner selected for period: ' . $previousPeriod->startdate->format('d/m/Y') . ' - ' . $previousPeriod->enddate->format('d/m/Y'));
        } else {
            \Log::alert('No period ended');
        }
    }
}
