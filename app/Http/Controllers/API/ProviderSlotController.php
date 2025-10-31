<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderSlotMapping;

class ProviderSlotController extends Controller
{
    public function getProviderSlot(Request $request){
        $admin = \App\Models\AppSetting::first();
        date_default_timezone_set( $admin->time_zone ?? 'UTC');

        $current_time = \Carbon\Carbon::now();
        $time = $current_time->toTimeString();

        $current_day = strtolower(date('D'));

        $provider_id  = !empty($request->provider_id) ? $request->provider_id : auth()->user()->id;

        $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

        $slotsArray = [];
        foreach ($days as $value) {
            // Get all slots for the day instead of just first one
            $slots = ProviderSlotMapping::select('start_at')
                ->where('provider_id', $provider_id)
                ->where('days', $value)
                ->orderBy('start_at', 'asc')
                ->get()
                ->pluck('start_at')
                ->toArray();

            if ($current_day == $value) {
                // Filter out past slots for current day
                $slots = array_filter($slots, function($slot) use ($time) {
                    return $slot > $time;
                });
            }
            $obj = [
                "day"=>$value,
                "day" => $value,
                "slot" => $slots
            ];
            array_push($slotsArray, $obj);
        }
        return comman_custom_response($slotsArray);
    }
}