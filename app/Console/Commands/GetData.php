<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Main_table;

class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Getting data from server';

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
        $page = 0;
        $URL='http://10.2.19.12/api/operational?format=json&new_time_gte=2019-01-01T00:00:01&new_time_lte=2019-05-31T23:59:59&page=';
        //$URL='localhost/jsonviewer/public/dummydata?page=';
        $next = 'ada';
        while(!is_null($next)){
            $page++;
            $username='admin';
            $password='inalixOK';
             // $data = array("account" => "1234", "dob" => "30051987", "site" => "mytestsite.com");
            $url = $URL.$page;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

            $result=curl_exec ($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
            curl_close ($ch);

            $jsonresult = json_decode($result);
            $arrayresult = $jsonresult->results;
            foreach ($arrayresult as $item) {
                //echo json_encode($item);
                $content = json_decode(json_encode($item), true);
                $content['sid'] = $content['id'];
                unset($content['id']);
                foreach ($content as $key => $tmp) {
                    if(is_array($tmp)){
                        $content[$key] = implode('', $tmp);
                    } elseif (is_null($tmp)) {
                        $content[$key] = "";
                    }
                }
                $fromdb = Main_table::where('sid', $content['sid'])->get();
                if(sizeof($fromdb) == 0){
                    $record = new  Main_table($content);
                    $record->save();
                }
            }
            $next = $jsonresult->next;
        }
    }
}
