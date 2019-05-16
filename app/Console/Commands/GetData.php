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
        $username='ict.sub';
        $password='P@ssw0rdIT';
        //$URL='http://10.2.19.22/api/operational?new_time_gte=2019-01-20T06:00:00&new_time_lte=2019-01-20T06:59:59';
        $URL='localhost/json_viewer/public/dummydata';
         // $data = array("account" => "1234", "dob" => "30051987", "site" => "mytestsite.com");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$URL);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

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

    }
}
