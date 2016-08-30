<?php

namespace App\Console\Commands;

use App\Classes\ExportService;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendDailyEntriesExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-daily-entries-export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an Excel file with all participants of the previous day to admin';

    /**
     * @var ExportService
     */
    private $exportService;

    /**
     * Create a new command instance.
     *
     * @param ExportService $exportService
     */
    public function __construct(ExportService $exportService)
    {
        parent::__construct();
        $this->exportService = $exportService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $day = Carbon::yesterday()->toDateString();
        $photos = Photo::getEntriesFromDayForExport($day);

        $excelFile = $this->exportService->createEntriesExcelExport($photos, 'Entries from ' . $day . ' - TNF wedstrijd')->store('xls', false, true);

        \Mail::send('emails.daily-entries-export', ['day' => $day], function ($m) use ($day, $excelFile) {
            $m->from('noreply@wedstrijd-tnf.dev', 'TNF Wedstrijd');

            $m->to('didierdemaeyer@gmail.com', 'Didier')->subject('Entries from ' . $day);

            $m->attach($excelFile['full']);
        });

        \File::delete($excelFile['full']);
    }
}
