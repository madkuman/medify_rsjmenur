<?php

namespace App\Console\Commands\Dev;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use DB;
use Config;

class SqlFileGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:sql-file-generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate File Sql, kolom id harus di urutan pertama';

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
    public function handle(){
        echo "==== PREQUISITES ====\n";
        echo "1. tabel master harus diberi comment 'master_table' di kolom pertama\n";
        echo "=====================\n\n";
        try
        {
            $target_folder = 'database/init/' . date('y_m_d');
            if(!file_exists($target_folder))
                File::makeDirectory($target_folder, 0777, true, true);

            $file_name = 'init_all_files.sql';
            $file_handle = fopen($target_folder.'/'.$file_name, 'a+');

            $connections = Config::get('database')['connections'];
            foreach ($connections as $key => $connection){

                echo "===start database " . $connection['database'] . " ===\n";
                $tables = DB::connection($key)->getDoctrineSchemaManager()->listTableNames();
                $mysqlHostName      = $connection['host'];
                $mysqlUserName      = $connection['username'];
                $mysqlPassword      = $connection['password'];
                $DbName             = $connection['database'];
                $backup_name        = "mybackup.sql";

                $connect = new \PDO("mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8", "$mysqlUserName", "$mysqlPassword",array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                $get_all_table_query = "SHOW TABLES";
                $statement = $connect->prepare($get_all_table_query);
                $statement->execute();
                $result = $statement->fetchAll();


                $output = '';
                //itterate tables
                foreach($tables as $table){
                    echo "start table " . $table . "\n";
                    $show_table_query = "SHOW CREATE TABLE " . $table . "";
                    $statement = $connect->prepare($show_table_query);
                    $statement->execute();
                    $show_table_result = $statement->fetchAll();
                    foreach($show_table_result as $show_table_row){
                        $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
                    }
                    fwrite($file_handle, $output);
                    $output = "";

                    $show_comment_query = "SHOW FULL COLUMNS FROM " . $table . "";

                    $comment = $connect->prepare($show_comment_query);
                    $comment->execute();
                    $show_comment_result = $comment->fetchAll();
                    if($show_comment_result[0]['Comment'] != 'master_table')
                        continue;


                    $output = "";
                    $select_query = "SELECT * FROM " . $table . "";
                    $statement = $connect->prepare($select_query);
                    $statement->execute();
                    $total_row = $statement->rowCount();

                    for($count=0; $count<$total_row; $count++){
                        $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                        $table_column_array = array_keys($single_result);
                        $table_value_array = array_values($single_result);
                        $output .= "\nINSERT INTO $table (";
                        $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
                        $output .= "'" . implode("','", $table_value_array) . "');\n";
                    }
                    fwrite($file_handle, $output);
                    $output = "";
                }

                echo "===done database " . $connection['database'] . " ===\n";
            }
          
            
            echo 'DONE, file in "database/init/' . date('y_m_d') . '" folder' ."\n";
            fclose($file_handle);
        }
        catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

    }
}
