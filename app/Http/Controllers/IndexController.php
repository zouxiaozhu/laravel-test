<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $pro = new Product();
        SendMail::dispatch($pro);
        echo 111;
        die;

        return response()->json(['a' => 1]);
    }

    public function test()
    {
        $dataArray = collect($this->array);

        $a = collect($dataArray)->sortBy('start_time')->map(function ($item) {
            $end_date = date('Y-m-d', $item['end_time']);
            $item['start_time'] = date('Y-m-d H:i:s', $item['start_time']);
            $item['end_time'] = date('Y-m-d H:i:s', $item['end_time']);
            if ($end_date != $item['dates']) {
                $this->special[Carbon::parse($item['dates'])->addDay(1)->format('Y-m-d')] =
                    $item;
            }


            return $item;
        })->values()->groupBy('dates')->map(function ($items) {
            $date = $items[0]['dates'] ?? '';
            if ($date && isset($this->special[$date])) {
                $items = collect($items)->map(function ($item) use ($date) {
                    if ($item['start_time'] < $this->special[$date]['end_time']) {
                        $item['file_starttime'] = strtotime($this->special[$date]['end_time']) - strtotime($item['start_time']);
                        $item['start_time'] = $this->special[$date]['end_time'];
                    }
                    return $item;
                });

            }
            return $items;
        });

        var_export($a->toArray());
        die;

    }

    protected $special = [];
    protected $array = array(
        0 =>
            array(
                'channel_id' => 49,
                'chop_id' => 282718,
                'chop_name' => '新闻联播',
                'chop_type' => 2,
                'url' => 'http://vod.dev.hoge.cn/video/2019/01/14/1a269653ca5db899d29165fc9cd8fce2.mp4',
                'start_time' => 1548172800,
                'end_time' => 1548184439,
                'toff' => 11639,
                'dates' => '2019-01-23',
                'start_time_shift' => 0,
                'file_starttime' => 0,
                'create_user_id' => 1,
                'create_user_name' => '我最大',
            ),
        1 =>
            array(
                'channel_id' => 49,
                'chop_id' => 282718,
                'chop_name' => '新闻联播',
                'chop_type' => 2,
                'url' => 'http://vod.dev.hoge.cn/video/2019/01/14/1a269653ca5db899d29165fc9cd8fce2.mp4',
                'start_time' => 1548184439,
                'end_time' => 1548206878,
                'toff' => 22439,
                'dates' => '2019-01-23',
                'start_time_shift' => 0,
                'file_starttime' => 0,
                'create_user_id' => 1,
                'create_user_name' => '我最大',
            ),
    );
}
