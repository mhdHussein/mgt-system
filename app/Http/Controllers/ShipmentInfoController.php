<?php

namespace App\Http\Controllers;

use App\Model\ShipmentInfo;
use Illuminate\Http\Request;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\ShipmentResouce;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use App\Http\Resources\SingleShipmentResource;
use App\Http\Resources\SingleCourierShipmentResource;
use App\Http\Resources\ProductivityResource;


class ShipmentInfoController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $from = Carbon::parse($request->from)->toDateTimeString();
        $to = Carbon::parse($request->to)->toDateTimeString();
 
       
  
         return ShipmentResouce::collection(
               ShipmentInfo::whereBetween('created_at' , [$from , $to])
             ->distinct()
             ->groupBy('courier_id')
             ->selectRaw('courier_id ,
             sum(sent_count) as recieved , 
             sum(sent_amount) as recieved_amount,
             sum(cash) as total_cash,
             sum(credit) as total_credit,
             sum(deposited_amount) as total_deposited,
             sum(returned_shipments) as returned,
             sum(delivared_shipments) as delivered,
             sum(fiscal_deficit) as deficit,
             sum(lost_shipments) as lost,
             sum(fuel) as fuel,
             count(courier_id) as total_attendance')->get()
         );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->role_id == 4){
            $shipmentInfo = auth()->user()->shipments()->create($request->all());
            return response($shipmentInfo , Response::HTTP_CREATED);
        }

        return response(['error' => 'Only Supervisors Can Create'] , Response::HTTP_NOT_ACCEPTABLE);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ShipmentInfo  $shipmentInfo
     * @return \Illuminate\Http\Response
     */
    public function show($shipmentInfo)
    {
        $info = ShipmentInfo::find($shipmentInfo);
       
        return response($info , Response::HTTP_ACCEPTED);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ShipmentInfo  $shipmentInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipmentInfo $shipmentInfo)
    {
        $shipmentInfo->update($request->all());

        return response($shipmentInfo, Response::HTTP_ACCEPTED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ShipmentInfo  $shipmentInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipmentInfo $shipmentInfo)
    {
        $shipmentInfo->delete();

        return response(null , Response::HTTP_ACCEPTED);
    }

    public function supervisor_packages(Request $request){

        $from = Carbon::parse($request->from)->toDateTimeString();
        $to = Carbon::parse($request->to)->toDateTimeString();
 
         return ShipmentResouce::collection(
               ShipmentInfo::whereBetween('created_at' , [$from , $to])
               ->where('supervisor_id' , $request->id)
             ->distinct()
             ->groupBy('courier_id')
             ->selectRaw('courier_id ,
             sum(sent_count) as recieved , 
             sum(sent_amount) as recieved_amount,
             sum(cash) as total_cash,
             sum(credit) as total_credit,
             sum(deposited_amount) as total_deposited,
             sum(returned_shipments) as returned,
             sum(delivared_shipments) as delivered,
             sum(fiscal_deficit) as deficit,
             sum(lost_shipments) as lost,
             sum(fuel) as fuel,
             count(courier_id) as total_attendance')->get()
         );
    }

    public function supervisor_productivity(Request $request){
        $from = Carbon::parse($request->from)->toDateTimeString();
        $to = Carbon::parse($request->to)->toDateTimeString();

        
            $couriers = ShipmentInfo::whereBetween('created_at' , [$from , $to])
            ->where('supervisor_id' , $request->id)
            ->distinct()
            ->count();

            $delivered =  ShipmentInfo::whereBetween('created_at' , [$from , $to])
            ->where('supervisor_id' , $request->id)
            ->sum('delivared_shipments');

         
            return [
                'couriers' => $couriers,
                'delivered' => $delivered,
                'productivity' => $delivered / $couriers
            ];
    }

    public function courier_packages(Request $request){
 
        $from = Carbon::parse($request->from)->toDateTimeString();
        $to = Carbon::parse($request->to)->toDateTimeString();
 
        
        // return ShipmentInfo::whereBetween('created_at' , [$from , $to])
        //     ->where('courier_id' , $request->id)->get();
        
        return SingleCourierShipmentResource::collection(
            ShipmentInfo::whereBetween('created_at' , [$from , $to])
            ->where('courier_id' , $request->id)->get()
        );
    }

    

}
