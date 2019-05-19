<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Main_table;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Admin";
        return view('home');
    }

    public function ajax(Request $request){
        $terminal = $request->terminal;
        $kode = $request->kode;
        if($kode==''){
            if($terminal==''){
                $data = Main_table::all();
            } else{
                $data = Main_table::where('terminal',$terminal)->get();
            }
        } else{
            $data = Main_table::where('airline',$kode);
            if($terminal==''){
                $data->get();
            } else{
                $data = $data->where('terminal',$terminal)->get();
            }
        }
        return DataTables::of($data)->make(true);
    }

    public function getdata()
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
        //return true;
    }
}
