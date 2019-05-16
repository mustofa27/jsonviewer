<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Main_table;

class DataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataDummy(){
        $tmp = '{"count":3,"next":"http://10.2.19.12/api/operational?format=json&page=2","previous":null,"results":[{"id":50220,"ad":"A","direction":"A","opr":"AWQ","airline":"AWQ","callsign":"AWQ8298","regno":"ZZZZZ","time":"2014-02-01T22:20:00+07:00","new_time":"2014-02-01T22:20:00+07:00","est":null,"airport":"WMKK","nbd":null,"act":null,"bay":null,"block":null,"bridge":0,"status":"SCH","scope":"I","datehour":"2014020115","via":null,"aircraft":[],"arr":null,"dep":null,"desks":[],"gate":null,"belt":null,"closed":true,"delay_reason":"","scheduled":true,"opr_time":"2014-02-01T22:20:00+07:00","desk_open":"2014-02-01T19:40:00+07:00","desk_close":"2014-02-01T21:50:00+07:00","desks_custom":[],"ap":"WARR","complete":false,"codeshare":"","noopr":false,"terminal":"T2","key":null,"runway":null,"modified":"2014-05-24T10:52:36.845941Z","airport_name":"Kuala Lumpur","closed_opr":true,"fstat":"NML","bag_first":null,"bag_last":null,"gate_close":null,"callsign2":"QZ-8298","note":"","ftype":"","delay":0,"delay_level":"","status_label":"Scheduled","diverted":null,"first_block":null,"airports3":"KUL","bridge_dock":null,"bridge_undock":null,"ok":false,"via1":"KUL","via2":null,"via3":null,"key_v2":"A2014020115QZ8298","desks_range":""},{"id":52057,"ad":"A","direction":"A","opr":"AWQ","airline":"AWQ","callsign":"AWQ8298","regno":"ZZZZZ","time":"2014-02-04T22:20:00+07:00","new_time":"2014-02-04T22:20:00+07:00","est":null,"airport":"WMKK","nbd":null,"act":null,"bay":null,"block":null,"bridge":0,"status":"SCH","scope":"I","datehour":"2014020415","via":null,"aircraft":[],"arr":null,"dep":null,"desks":[],"gate":null,"belt":null,"closed":true,"delay_reason":"","scheduled":true,"opr_time":"2014-02-04T22:20:00+07:00","desk_open":"2014-02-04T19:40:00+07:00","desk_close":"2014-02-04T21:50:00+07:00","desks_custom":[],"ap":"WARR","complete":false,"codeshare":"","noopr":false,"terminal":"T2","key":null,"runway":null,"modified":"2014-05-24T10:52:38.673036Z","airport_name":"Kuala Lumpur","closed_opr":true,"fstat":"NML","bag_first":null,"bag_last":null,"gate_close":null,"callsign2":"QZ-8298","note":"","ftype":"","delay":0,"delay_level":"","status_label":"Scheduled","diverted":null,"first_block":null,"airports3":"KUL","bridge_dock":null,"bridge_undock":null,"ok":false,"via1":"KUL","via2":null,"via3":null,"key_v2":"A2014020415QZ8298","desks_range":""},{"id":38077,"ad":"A","direction":"A","opr":"AWQ","airline":"AWQ","callsign":"AWQ8296","regno":"PKAXG","time":"2014-02-14T00:12:00+07:00","new_time":"2014-02-14T00:05:00+07:00","est":"2014-02-14T00:11:00+07:00","airport":"WMKK","nbd":null,"act":"2014-02-14T00:16:00+07:00","bay":"15A","block":null,"bridge":0,"status":"NOP","scope":"I","datehour":"2014021317","via":null,"aircraft":[],"arr":null,"dep":null,"desks":[],"gate":null,"belt":"3","closed":true,"delay_reason":"","scheduled":true,"opr_time":"2014-02-14T00:11:00+07:00","desk_open":"2014-02-13T21:05:00+07:00","desk_close":"2014-02-13T23:20:00+07:00","desks_custom":[],"ap":"WARR","complete":true,"codeshare":"","noopr":true,"terminal":"T2","key":null,"runway":"10","modified":"2014-05-24T10:54:50.621431Z","airport_name":"Kuala Lumpur","closed_opr":true,"fstat":"NOP","bag_first":null,"bag_last":null,"gate_close":null,"callsign2":"QZ-8296","note":"","ftype":"S","delay":0,"delay_level":"","status_label":"No Operate","diverted":null,"first_block":null,"airports3":"KUL","bridge_dock":null,"bridge_undock":null,"ok":false,"via1":"KUL","via2":null,"via3":null,"key_v2":"A2014021317QZ8296","desks_range":""}]}';
        return json_encode(json_decode($tmp));
    }
}
