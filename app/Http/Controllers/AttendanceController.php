<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use Illuminate\Http\Request;
use App\Http\Resources\AttendanceResource;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use App\Model\Courier;

class AttendanceController extends Controller
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

        return AttendanceResource::collection(
            Attendance::whereBetween('created_at' , [$from , $to])
            ->latest()->get()
        );
       
    }



    public function supervisor_attandance(Request $request){
        
        $from = Carbon::parse($request->from)->toDateTimeString();
        $to = Carbon::parse($request->to)->toDateTimeString();
        return AttendanceResource::collection(
            Attendance::whereBetween('created_at' , [$from , $to])
            ->where('supervisor_id' , $request->id)
            ->get()
        );
    }

    
    public function courier_attandance(Request $request){

        $from = Carbon::parse($request->from)->toDateTimeString();
        $to = Carbon::parse($request->to)->toDateTimeString();
        
        return AttendanceResource::collection(
            Attendance::whereBetween('created_at' , [$from , $to])
            ->where('courier_id' , $request->id)
            ->get()
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
        $courier_id = $request['courier_id'];
        $supervisor_id = Courier::findOrFail($courier_id)->supervisor_id;

        $request['supervisor_id'] = $supervisor_id;

        
        $attendance = Attendance::create($request->all());

        return response(new AttendanceResource($attendance) , Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return new AttendanceResource($attendance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $attendance->update($request->all());

        return response(new AttendanceResource($attendance) , Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return response(null , Response::HTTP_ACCEPTED);
    }
}
