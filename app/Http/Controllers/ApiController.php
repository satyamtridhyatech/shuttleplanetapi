<?php

namespace App\Http\Controllers;

use App\Ride;
use App\RideAdditionalInfo;
use Illuminate\Http\Request;
use Validator;
class ApiController extends Controller
{
    public function getRideById(){
        $data = request()->all();
        $query = new Ride();
        $query = $query->where(['id'=>$data['id']])->with(['additional_info', 'users']);
        if ($query->count() > 0) {
            $rides = $query->get();
            for($i=0;$i< $rides->count();$i++){
                $rides[$i]['is_third_party_ride'] = 1;
            }

            return response()->json(['status' => true, 'ride' => $rides]);
        } else {
            return response()->json(['status' => false, 'message' => "No ride found"]);
        }
    }
    public function getScheduleRide(){
        $data = request()->all();
        $query = new Ride();
        $query = $query->where(['from'=> $data['from'],'to'=>$data['to']])->where('seats_available','>=',$data['seats']);
        $journey_date= Date('Y-m-d',strtotime($data['journey_date']));
        $query = $query->whereDate('journey_date','=', $journey_date)->with(['users', 'additional_info', 'providers']);
        if($query->count() > 0){
            $rides = $query->get();
            for($i=0;$i< $query->count();$i++){
                $rides[$i]['is_third_party_ride'] = 1;
            }
            return response()->json(['status' => true, 'rides' => $rides]);
        }else{
            return response()->json(['status' => false, 'message' => "No ride found"]);
        }

    }

    public function storeRide(){
        $data = request()->all();
        $endpoint = 'live';
        $access_key = env('CURRENCY_API_ID');

        // Initialize CURL:
        $ch = curl_init('http://apilayer.net/api/' . $endpoint . '?access_key=' . $access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);
        if ($data["currency_symbol"] == 'GBP') {
            $price_in_gbp = $data["price"];
        } elseif ($data["currency_symbol"] == 'USD') {
            $price_in_usd = $data["price"];
            $exchange_value = $exchangeRates['quotes']['USDGBP'];
            $price_in_gbp = round($price_in_usd * $exchange_value, 2);
        } else {
            $price_in_eur = $data["price"];
            $exchange_value = $exchangeRates['quotes']['USDEUR'];
            $exchange_value_gbp = $exchangeRates['quotes']['USDGBP'];
            $price_in_usd = round($price_in_eur / $exchange_value, 2);
            $price_in_gbp = round($price_in_usd * $exchange_value_gbp, 2);
        }
        $days_available = date('N');
        $ride = new Ride();
        $ride->provider_id = $data["provider_id"];
        $ride->from = $data["from"];
        $ride->to = $data["to"];
        $ride->journey_date = date('Y-m-d G:i:s', strtotime($data["journey_date"]));
        $ride->return_date = date('Y-m-d G:i:s', strtotime($data["return_date"]));
        $ride->ride_type = "One-Time";
        $ride->parent_ride_id = 1;
        $ride->days_available = $days_available;
        $ride->seats_available = $data["seats_available"];
        $ride->vehicle_type = $data["vehicle_type"];
        $ride->price = $data["price"];
        $ride->price_in_gbp = $price_in_gbp;
        $ride->currency_symbol = $data["currency_symbol"];
      //  $ride->batch_id = $data["batch_id"];
        $ride->save();
        $ride_id = $ride->id;
        $additional_info = new RideAdditionalInfo();
        $additional_info->ride_id = $ride->id;
        $additional_info->wifi = $data["wifi"];
        $additional_info->charge_plug_socket = $data["charge_plug_socket"];
        $additional_info->wheelchair_lift = $data["wheelchair_lift"];
        $additional_info->infant_seats = $data["infant_seats"];
        $additional_info->child_seats = $data["child_seats"];
        $additional_info->booster_seats = $data["booster_seats"];
        $additional_info->pets = $data["pets"];
        $additional_info->wheelchair = $data["wheelchair"];
        $additional_info->wheelchair_foldable = $data["wheelchair_foldable"];
        $additional_info->save();

        if($data["is_return"] == 1){
            $ride1 = new Ride();
        $ride1->provider_id = $data["provider_id"];
        $ride1->from = $data["to"];
        $ride1->to = $data["from"];
        $ride1->journey_date = date('Y-m-d G:i:s', strtotime($data["return_journey_date"]));
        $ride1->return_date = date('Y-m-d G:i:s', strtotime($data["return_return_date"]));
        $ride1->ride_type = "One-Time";
        $ride1->parent_ride_id = 1;
        $ride1->days_available = $days_available;
        $ride1->seats_available = $data["seats_available"];
        $ride1->vehicle_type = $data["vehicle_type"];
        $ride1->price = $data["price"];
        $ride1->price_in_gbp = $price_in_gbp;
        $ride1->currency_symbol = $data["currency_symbol"];
      //  $ride->batch_id = $data["batch_id"];
        $ride1->save();
        $ride_id1 = $ride1->id;
        $additional_info1 = new RideAdditionalInfo();
        $additional_info1->ride_id = $ride1->id;
        $additional_info1->wifi = $data["wifi"];
        $additional_info1->charge_plug_socket = $data["charge_plug_socket"];
        $additional_info1->wheelchair_lift = $data["wheelchair_lift"];
        $additional_info1->infant_seats = $data["infant_seats"];
        $additional_info1->child_seats = $data["child_seats"];
        $additional_info1->booster_seats = $data["booster_seats"];
        $additional_info1->pets = $data["pets"];
        $additional_info1->wheelchair = $data["wheelchair"];
        $additional_info1->wheelchair_foldable = $data["wheelchair_foldable"];
        $additional_info1->save();
        }
        return response()->json(['status' => true, 'message' => "Ride Added success fully"]);

    }

     public function getReturnRideById(){
        $data = request()->all();
        $query = new Ride();
        $query = $query->where(['id'=>$data['id']])->with(['providers', 'users']);
        if ($query->count() > 0) {
            $rides = $query->get();
            for($i=0;$i< $rides->count();$i++){
                $rides[$i]['is_third_party_ride'] = 1;
            }

            return response()->json(['status' => true, 'ride' => $rides]);
        } else {
            return response()->json(['status' => false, 'message' => "No ride found"]);
        }
    }

    public function addRideSeats(){
        $data = request()->all();
        $ride = Ride::where('id',$data['id'])->first();
                $ride->seats_available = ($ride->seats_available + $data['seat_booked']);
                $ride->save();
            return response()->json(['status' => true]);
    }

    public function subtractRideSeats(){
        $data = request()->all();
        $ride = Ride::where('id',$data['id'])->first();
                $ride->seats_available = ($ride->seats_available - $data['seat_booked']);
                $ride->save();
            return response()->json(['status' => true]);
    }
}
