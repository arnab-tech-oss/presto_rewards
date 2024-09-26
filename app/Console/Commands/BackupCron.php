<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class BackupCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database data with column';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tables = DB::select('SHOW TABLES');


        foreach ($tables as $table) {
            $table = array_values((array)$table)[0];
            self::queryGenerator($table);
        }

        system('php artisan migrate:fresh ');
        self::importQuery();

        return Command::SUCCESS;
    }

    public function queryGenerator($table)
    {
        $query = '';
        $final_data = array();
        $tableDatas = DB::table($table)->get();

        if ($tableDatas->count() > 0) {
            $implode_column = '`' . implode('`,`', array_keys((array)$tableDatas[0])) . '`';
            $query .= "INSERT INTO `" . $table . "` (" . $implode_column . ") VALUES \n";

            foreach ($tableDatas as $index =>  $td) {

                $main_coma = ';';
                if (count($tableDatas) > $index + 1) {
                    $main_coma = ',';
                }

                $implode_data = '';
                $td_values = array_values((array)$td);
                foreach ($td_values as $index => $by_data) {
                    $coma = '';
                    if (count($td_values) > $index + 1) {
                        $coma = ',';
                    }
                    if (is_numeric($by_data)) {
                        $implode_data .= $by_data . $coma;
                    } else if (empty($by_data)) {
                        $implode_data .= 'NULL' . $coma;
                    } else {
                        $implode_data .= '"' . $by_data . '"' . $coma;
                    }
                }

                $query .= "(" . $implode_data . ")" . $main_coma . "\n";
            }

            $file = Storage::put('table/' . $table . '.sql', $query);
        }
    }


    function getLatestTable()
    {
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $table = array_values((array)$table)[0];
            $this->importQuery($table);
        }
    }

    function importQuery()
    {
        $count = 0;
        while (true) {
            $sqlfile =  Storage::files('table');

            if (count($sqlfile) > 1) {
                foreach ($sqlfile as $file) {
                    try {
                        $data = Storage::get($file);
                        DB::insert($data);
                        Storage::delete($file);
                    } catch (QueryException $e) {
                    }
                }
            } else {
                break;
            }

            if ($count > 1000) {
                break;
                echo   "\e[31m ------------------------------------------ Some Table is not migrated please 'storage/app/table/' -------------------------------------------- \n\n\n\n";
            }
        }
        echo   "\e[32m #################################### Migration and Backup  Done ######################################## \n\n\n\n";
    }
}
