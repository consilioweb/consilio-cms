<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Model\AnalyticsPublic;
use App\Model\AnalyticsRecordsDay;
use App\Model\AnalyticsRecordsWeek;
use App\Model\AnalyticsRecordsMonth;
use App\Model\AnalyticsRecordsYear;

use Carbon\Carbon;

class Analytics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Salva dados diários de analytics com Informações :day :week :month :year';

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
     * @return mixed
     */
    public function handle()
    {

        $hoje = date("Y-m-d");

        $day_total = AnalyticsPublic::where('date', $hoje)->count();

        $day = AnalyticsRecordsDay::where('reference', $hoje)->first();
        if(is_null($day)){
            AnalyticsRecordsDay::create([
                "reference" => $hoje,
                "total" => $day_total
            ]);
        }else{          
            $day->total += $day_total;
            $day->save();
        }

        $reference_week = Carbon::now()->startOfWeek()->format('Y-m-d');
        $week = AnalyticsRecordsWeek::where('reference', $reference_week)->first();
        if(is_null($week)){         
            AnalyticsRecordsWeek::create([
                "reference" => $reference_week,
                "total" => $day_total
            ]);
        }else{
            $week->total += $day_total;
            $week->save();
        }

        $month = AnalyticsRecordsMonth::where('reference', date('Y-m-01'))->first();
        if(is_null($month)){            
            AnalyticsRecordsMonth::create([
                "reference" => date('Y-m-01'),
                "total" => $day_total
            ]);
        }else{
            $month->total += $day_total;
            $month->save();
        }

        $year = AnalyticsRecordsYear::where('reference', date('Y-01-01'))->first();
        if(is_null($year)){         
            AnalyticsRecordsYear::create([
                "reference" => date('Y-01-01'),
                "total" => $day_total
            ]);
        }else{
            $year->total += $day_total;
            $year->save();
        }

        AnalyticsPublic::truncate();

    }
}
