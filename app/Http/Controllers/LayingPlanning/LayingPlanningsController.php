<?php

namespace App\Http\Controllers\LayingPlanning;

use App\Http\Controllers\Controller;
use App\Models\Gl;
use App\Models\Color;
use App\Models\LayingPlanning;
use App\Models\LayingPlanningSize;
use App\Models\LayingPlanningDetail;
use App\Models\LayingPlanningDetailSize;
use App\Models\CuttingOrderRecord;
use App\Models\CuttingOrderRecordDetail;
use App\Models\FabricType;
use App\Models\FabricCons;
use App\Models\FabricRequisition;
use App\Models\GlCombine;
use App\Models\LayingPlanningSizeGlCombine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Yajra\Datatables\Datatables;

use Carbon\Carbon;

use PDF;

class LayingPlanningsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = LayingPlanning::with(['gl', 'style', 'buyer', 'color', 'fabricType'])->get();
        return view('page.layingPlanning.index', compact('data'));
    }

    public function dataLayingPlanning (){
        $query = LayingPlanning::with(['gl', 'style', 'buyer', 'color', 'fabricType'])
            ->whereHas('style', function($query) {
                $query->whereNull('deleted_at');
            })
            ->select('laying_plannings.id','laying_plannings.serial_number','laying_plannings.gl_id','laying_plannings.style_id','laying_plannings.buyer_id','laying_plannings.color_id','laying_plannings.fabric_type_id')->get();
            return Datatables::of($query)
            ->addIndexColumn()
            ->escapeColumns([])
            // ->addColumn('serial_number', function ($data){
            //     return '<a href="'.route('laying-planning.show',$data->id).'">'.$data->serial_number.'</a>';
            // })
            ->addColumn('gl_number', function ($data){
                return $data->gl->gl_number;
            })
            ->addColumn('style', function ($data){
                return $data->style->style;
            })
            ->addColumn('buyer', function ($data){
                return $data->buyer->name;
            })
            ->addColumn('color', function ($data){
                return $data->color->color;
            })
            ->addColumn('fabric_type', function ($data){
                return $data->fabricType->description;
            })
            ->addColumn('action', function($data){
                $action = '<a href="'.route('laying-planning.edit',$data->id).'" class="btn btn-primary btn-sm"">Edit</a>
                <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="delete_layingPlanning('.$data->id.')">Delete</a>
                <a href="'.route('laying-planning.show',$data->id).'" class="btn btn-info btn-sm mt-1">Detail</a>
                <a href="'.route('laying-planning.report',$data->id).'" target="_blank" class="btn btn-info btn-sm mt-1">Report</a>';
                return $action;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function layingCreate()
    {
        $gls = GL::with('GLCombine')->get();
        $styles = DB::table('styles')->get();
        $colors = DB::table('colors')->get();
        $fabricTypes = DB::table('fabric_types')->get();
        $fabricCons = DB::table('fabric_cons')->get();
        $sizes = DB::table('sizes')->get();
        $gl_combines = GlCombine::all();
        return view('page.layingPlanning.add', compact('gls', 'styles', 'colors', 'fabricTypes', 'fabricCons', 'sizes','gl_combines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'gl' => 'required',
            'buyer' => 'required',
            'style' => 'required',
            'color' => 'required',
            'fabric_type' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute field is duplicate.',
        ]);

        if ($validator->fails()) {
            return redirect('laying-planning-create')
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            $serial_number = $this->generate_serial_number($request->gl,$request->color, $request->fabric_type, $request->fabric_cons);
            $layingData = [
                'serial_number' => $serial_number,
                'gl_id' => $request->gl,
                'style_id' => $request->style,
                'buyer_id' => $request->buyer,
                'color_id' => $request->color,
                'order_qty' => $request->order_qty,
                'delivery_date' => Carbon::createFromFormat('d/m/Y', $request->delivery_date)->format('y-m-d'),
                'plan_date' => Carbon::createFromFormat('d/m/Y', $request->plan_date)->format('y-m-d'),
                'fabric_po' => $request->fabric_po,
                'fabric_cons_id' => $request->fabric_cons,
                'fabric_type_id' => $request->fabric_type,
                'fabric_cons_qty' => $request->fabric_cons_qty,
                'fabric_cons_desc' => $request->fabric_cons_desc,
            ];
            $insertLayingData = LayingPlanning::create($layingData);

            $selected_sizes = $request->laying_planning_size_id;
            $selected_sizes_qty = $request->laying_planning_size_qty;
            $gl_combine_id = $request->gl_combine_id;
            foreach ($selected_sizes as $key => $size_id) {
                $laying_planning_size = [
                    'size_id' => $size_id,
                    'quantity' => $selected_sizes_qty[$key],
                    'laying_planning_id' => $insertLayingData->id,
                ];
                $insertLayingSize = LayingPlanningSize::create($laying_planning_size);
                $id_laying_planning_size = $insertLayingSize->id;
                if (isset($gl_combine_id[$key])) {
                    $id_gl_combine = $gl_combine_id[$key];
                    $laying_planning_size_gl_combine = [
                        'id_laying_planning_size' => $id_laying_planning_size,
                        'id_gl_combine' => $id_gl_combine,
                    ];
                    $insertLayingSizeGlCombine = LayingPlanningSizeGlCombine::create($laying_planning_size_gl_combine);
                }
            }
            return redirect()->route('laying-planning.show',$insertLayingData->id)
                ->with('success', 'Data Laying Planning berhasil dibuat.');
        } catch (\Throwable $th) {
            return redirect('laying-planning-create')
                        ->withErrors($th->getMessage())
                        ->withInput();
        }
    }

    public function show($id)
    {
        $data = LayingPlanning::with(['gl', 'style', 'buyer', 'color', 'fabricType'])->find($id);
        $details = LayingPlanningDetail::with(['fabricRequisition'])->where('laying_planning_id', $id)->get();
        $fabric_requisition = FabricRequisition::with(['layingPlanningDetail'])->whereHas('layingPlanningDetail', function($query) use ($id) {
            $query->where('laying_planning_id', $id);
        })->get();
        $total_order_qty = LayingPlanning::where('gl_id', $data->gl_id)->sum('order_qty');
        $data->total_order_qty = $total_order_qty;
        $total_pcs_all_table = 0;
        $total_length_all_table = 0;
        
        $delivery_date = Carbon::createFromFormat('Y-m-d', $data->delivery_date)->format('d-m-Y');
        $data->delivery_date = $delivery_date;
        $plan_date = Carbon::createFromFormat('Y-m-d', $data->plan_date)->format('d-m-Y');
        $data->plan_date = $plan_date;

        foreach($details as $key => $value) {
            $details[$key]->cor_status = $value->cuttingOrderRecord ? 'disabled' : '';
            // faric requisition disable
            $details[$key]->fr_status = $value->fabricRequisition ? 'disabled' : '';
            // cuttingOrderRecord->layingPlanningDetail-layingPlanning
            $details[$key]->cor_id = $value->cuttingOrderRecord ? $value->cuttingOrderRecord->id : '';
            $cutting_order_record = CuttingOrderRecord::with(['layingPlanningDetail', 'cuttingOrderRecordDetail'])->whereHas('layingPlanningDetail', function($query) use ($id) {
                $query->where('laying_planning_id', $id);
            })->get();
            $details[$key]->cutting_order_record = $cutting_order_record;
            $total_pcs_all_table = $total_pcs_all_table + $value->total_all_size;
            $total_length_all_table = $total_length_all_table + $value->total_length;
        }

        $data->total_pcs_all_table = $total_pcs_all_table;
        $data->total_length_all_table = $total_length_all_table;

        // $gl_combine = GlCombine::with('layingPlanningSizeGlCombine')->whereHas('layingPlanningSizeGlCombine', function($query) use ($id) {
        //     $query->whereHas('layingPlanningSize', function($query) use ($id) {
        //         $query->where('laying_planning_id', $id);
        //     });
        // })->get();

        $get_size_list = $data->layingPlanningSize()->with('glCombine')->get();
        $size_list = [];
        foreach ($get_size_list as $key => $size) {
            $size_list[] = $size->size;
            $gl_combine_name = "";
            foreach ($size->glCombine as $key => $gl_combine) {
                $gl_combine_name = $gl_combine_name . $gl_combine->glCombine->name . " ";
            }
            $size->size->size = $size->size->size ."". $gl_combine_name;
        }
        return view('page.layingPlanning.detail', compact('data', 'details','size_list'));
    }

    public function layingPlanningReport($id)
    {
        $data = LayingPlanning::with(['gl', 'style', 'fabricCons', 'fabricType', 'color'])->where('id', $id)->first();
        $details = LayingPlanningDetail::with(['layingPlanning', 'layingPlanningDetailSize', 'layingPlanning.gl', 'layingPlanning.style', 'layingPlanning.buyer', 'layingPlanning.color', 'layingPlanning.fabricType', 'layingPlanning.layingPlanningSize.size'])->whereHas('layingPlanning', function($query) use ($id) {
            $query->where('id', $id);
        })->get();
        $details->load('cuttingOrderRecord', 'cuttingOrderRecord.cuttingOrderRecordDetail', 'cuttingOrderRecord.cuttingOrderRecordDetail.color');
        $cuttingOrderRecord = CuttingOrderRecord::with(['layingPlanningDetail', 'cuttingOrderRecordDetail'])->whereHas('layingPlanningDetail', function($query) use ($id) {
            $query->whereHas('layingPlanning', function($query) use ($id) {
                $query->where('id', $id);
            });
        })->get();
        // $cutting_order_record = CuttingOrderRecord::with(['layingPlanningDetail', 'cuttingOrderRecordDetail'])->whereHas('layingPlanningDetail', function($query) use ($serial_number) {
        //     $query->whereHas('layingPlanning', function($query) use ($serial_number) {
        //         $query->where('serial_number', $serial_number);
        //     });
        // })->get();
        $pdf = PDF::loadView('page.layingPlanning.report', compact('data', 'details', 'cuttingOrderRecord'))->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->stream('laying-planning-report.pdf');
    }

    public function layingQrcode($id)
    {
        $data = LayingPlanning::with(['layingPlanningSize','gl', 'style', 'buyer', 'color', 'fabricType'])->where('id', $id)->first();
        $qrCode = 'https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl='.$data->gl;
        return view('page.layingPlanning.qrcode', compact('data', 'qrCode'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LayingPlanning  $layingPlannings
     * @return \Illuminate\Http\Response
     */
    public function edit(LayingPlanning $layingPlannings, $id)
    {
        
        $layingPlanning = LayingPlanning::find($id);
        $gls = DB::table('gls')->get();
        $styles = DB::table('styles')->where('gl_id',$layingPlanning->gl_id)->get();
        $colors = DB::table('colors')->get();
        $fabricTypes = DB::table('fabric_types')->get();
        $fabricCons = DB::table('fabric_cons')->get();
        $sizes = DB::table('sizes')->get();

        // $layingPlanning->delivery_date = date('d/m/Y', strtotime($layingPlanning->delivery_date));
        $layingPlanning->plan_date = date('m/d/Y', strtotime($layingPlanning->plan_date));
        
        $layingPlanningSizes = LayingPlanningSize::where('laying_planning_id', $layingPlanning->id)->get();

        return view('page.layingPlanning.edit', compact('gls', 'styles', 'colors', 'fabricTypes', 'fabricCons', 'sizes','layingPlanning','layingPlanningSizes'));
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LayingPlanning  $layingPlannings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LayingPlanning $layingPlannings)
    {
        $rules = [
            'gl' => 'required',
            'buyer' => 'required',
            'style' => 'required',
            'color' => 'required',
            'fabric_type' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages = [
            'required' => 'The :attribute field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('laying-planning.edit', $request->laying_planning_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $layingPlanning = LayingPlanning::find($request->laying_planning_id);

        $layingPlanning->gl_id = $request->gl;
        $layingPlanning->style_id = $request->style;
        $layingPlanning->buyer_id = $request->buyer;
        $layingPlanning->color_id = $request->color;
        $layingPlanning->order_qty = $request->order_qty;
        $layingPlanning->delivery_date = Carbon::createFromFormat('d/m/Y', $request->delivery_date)->format('y-m-d');
        $layingPlanning->fabric_po = $request->fabric_po;
        $layingPlanning->fabric_cons_id = $request->fabric_cons;
        $layingPlanning->fabric_type_id = $request->fabric_type;
        $layingPlanning->fabric_cons_qty = $request->fabric_cons_qty;
        $layingPlanning->fabric_cons_desc = $request->fabric_cons_desc;

        $layingPlanning->save();

        LayingPlanningSize::where('laying_planning_id', $layingPlanning->id)->delete();

        $selected_sizes = $request->laying_planning_size_id;
        $selected_sizes_qty = $request->laying_planning_size_qty;
        foreach ($selected_sizes as $key => $size_id) {
            $laying_planning_size = [
                'size_id' => $size_id,
                'quantity' => $selected_sizes_qty[$key],
                'laying_planning_id' => $layingPlanning->id,
            ];
            $insertLayingSize = LayingPlanningSize::create($laying_planning_size);
        }
        
        return redirect('laying-planning')->with('success', 'Laying Planning '. $layingPlanning->serial_number . " successfully Updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LayingPlanning  $layingPlannings
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $layingPlanning = LayingPlanning::find($id);
            $layingPlanning->delete();
            $date_return = [
                'status' => 'success',
                'data'=> $layingPlanning,
                'message'=> 'Data Laying Planning berhasil di hapus',
            ];
            return response()->json($date_return, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function detail_create(Request $request) 
    {
        $layingPlanning = LayingPlanning::find($request->laying_planning_id);
        if(!$layingPlanning) {
            return redirect('laying-planning-create')
                        ->withInput();
        }
        $getLastDetail = LayingPlanningDetail::where('laying_planning_id', $layingPlanning->id)->orderBy('table_number','desc')->first();

        $layingDetailData = [
            'no_laying_sheet' => $this->generate_no_laying_sheet($layingPlanning),
            'table_number' => $next_table_number = $getLastDetail ? $getLastDetail->table_number + 1 : 1,
            'laying_planning_id' => $layingPlanning->id,
            'layer_qty' => $request->layer_qty,
            'marker_code' => $request->marker_code,
            'marker_yard' => $request->marker_yard,
            'marker_inch' => $request->marker_inch,
            'marker_length' => $request->marker_length,
            'total_length' => $request->marker_total_length,
            'total_all_size' => $request->qty_size_all,
        ];

        $insertLayingDetail = LayingPlanningDetail::create($layingDetailData);
        
        $ratio_size = $request->ratio_size;
        $qty_size = $request->qty_size;
        foreach ($ratio_size as $key => $size_value) {
            $laying_planning_detail_size = [
                'laying_planning_detail_id' => $insertLayingDetail->id,
                'size_id' => $key,
                'ratio_per_size' => $ratio_size[$key],
                'qty_per_size' => $qty_size[$key],
            ];
            $insertPlanningDetailSize = LayingPlanningDetailSize::create($laying_planning_detail_size);
        }

        return redirect()->route('laying-planning.show',$layingPlanning->id)
            ->with('success', 'Data Detail Laying Planning berhasil dibuat.');

    }

    public function detail_edit($id)
    {
        try {
            $layingPlanningDetail = LayingPlanningDetail::with('layingPlanningDetailSize')->find($id);
            $date_return = [
                'status' => 'success',
                'data'=> $layingPlanningDetail,
                'message'=> 'Data Detail Laying Planning berhasil diambil',
            ];
            return response()->json($date_return, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
    
    public function detail_update(Request $request, $id)
    {
        try {
            $layingPlanningDetail = LayingPlanningDetail::with('layingPlanningDetailSize')->find($id);
            
            $layingPlanningDetail->layer_qty = $request->layer_qty;
            $layingPlanningDetail->marker_code = $request->marker_code;
            $layingPlanningDetail->marker_yard = $request->marker_yard;
            $layingPlanningDetail->marker_inch = $request->marker_inch;
            $layingPlanningDetail->marker_length = $request->marker_length;
            $layingPlanningDetail->total_length = $request->marker_total_length;
            $layingPlanningDetail->total_all_size = $request->qty_size_all;
            $layingPlanningDetail->save();

            $deletePlanningDetailSize = LayingPlanningDetailSize::where('laying_planning_detail_id', $layingPlanningDetail->id)->delete();
            $ratio_size = $request->ratio_size;
            $qty_size = $request->qty_size;
            foreach ($ratio_size as $key => $size_value) {
                $laying_planning_detail_size = [
                    'laying_planning_detail_id' => $layingPlanningDetail->id,
                    'size_id' => $key,
                    'ratio_per_size' => $ratio_size[$key],
                    'qty_per_size' => $qty_size[$key],
                ];
                $insertPlanningDetailSize = LayingPlanningDetailSize::create($laying_planning_detail_size);
            }

            return redirect()->route('laying-planning.show',$request->laying_planning_id)
                ->with('success', 'Data Detail Laying Planning berhasil diubah.');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function detail_delete($id) 
    {
        try {
            $layingPlanningDetail = LayingPlanningDetail::find($id);
            $layingPlanningDetail->delete();
            $date_return = [
                'status' => 'success',
                'data'=> $layingPlanningDetail,
                'message'=> 'Data Detail Laying Planning berhasil dihapus',
            ];
            return response()->json($date_return, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function detail_duplicate(Request $request){

        $layingPlanningDetail = LayingPlanningDetail::find($request->laying_planning_detail_id);
        $duplicate_qty = $request->duplicate_qty;

        $layingPlanningDetailSize = $layingPlanningDetail->layingPlanningDetailSize;

        for ($i=0; $i < $duplicate_qty; $i++) { 
            
            $layingPlanning = $layingPlanningDetail->layingPlanning;
            $getLastDetail = LayingPlanningDetail::where('laying_planning_id', $layingPlanning->id)->orderBy('table_number','desc')->first();
            

            $layingDetailData = [
                'no_laying_sheet' => $this->generate_no_laying_sheet($layingPlanning),
                'table_number' => $getLastDetail ? $getLastDetail->table_number + 1 : 1,
                'laying_planning_id' => $layingPlanning->id,
                'layer_qty' => $layingPlanningDetail->layer_qty,
                'marker_code' => $layingPlanningDetail->marker_code,
                'marker_yard' => $layingPlanningDetail->marker_yard,
                'marker_inch' => $layingPlanningDetail->marker_inch,
                'marker_length' => $layingPlanningDetail->marker_length,
                'total_length' => $layingPlanningDetail->total_length,
                'total_all_size' => $layingPlanningDetail->total_all_size,
            ];

            $insertLayingDetail = LayingPlanningDetail::create($layingDetailData);
            
            $ratio_size = $request->ratio_size;
            $qty_size = $request->qty_size;
            foreach ($layingPlanningDetailSize as $key => $detailSize) {
                $laying_planning_detail_size = [
                    'laying_planning_detail_id' => $insertLayingDetail->id,
                    'size_id' => $detailSize->size_id,
                    'ratio_per_size' => $detailSize->ratio_per_size,
                    'qty_per_size' => $detailSize->qty_per_size,
                ];
                $insertPlanningDetailSize = LayingPlanningDetailSize::create($laying_planning_detail_size);
            }

        }

        return redirect()->route('laying-planning.show',$layingPlanning->id)
            ->with('success', 'Data Detail Laying Planning berhasil diduplicate sebanyak '. $duplicate_qty .' kali');

    }

    function generate_no_laying_sheet($layingPlanning) {
        $getLastDetail = LayingPlanningDetail::where('laying_planning_id', $layingPlanning->id)->orderBy('table_number','desc')->first();
        $gl_number = $layingPlanning->gl->gl_number;
        
        if(!$getLastDetail){
            $no_laying_sheet = $gl_number. "-" . Str::padLeft('1', 3, '0');
        } else {
            $next_table_number = $getLastDetail->table_number + 1;
            $no_laying_sheet = $gl_number. "-" . Str::padLeft($next_table_number, 3, '0');
        }
        return $no_laying_sheet;
    }

    function generate_serial_number($gl_id = null, $color_id = null, $fabric_type_id = null, $fabric_cons_id = null) {
        if (!$gl_id || !$color_id || !$fabric_type_id || !$fabric_cons_id) {
            return 0;
        }
        $gl = Gl::find($gl_id);
        $gl_number = $gl->gl_number;
        $color = Color::find($color_id);
        $fabric_type = FabricType::find($fabric_type_id);
        $fabric_type_serial = $fabric_type->name;
        $fabric_cons_serial = FabricCons::find($fabric_cons_id)->name;
        $fabric_cons_serial = Str::upper($fabric_cons_serial);
        $fabric_cons_serial = Str::random(2).$fabric_cons_serial;
        $fabric_cons_serial = substr($fabric_cons_serial, 0, 2).substr($fabric_cons_serial, 4, 2);
        $length_object = strlen($fabric_type_serial);
        $fabric_type_serial = substr($fabric_type_serial, 0, 2).substr($fabric_type_serial, $length_object-2, $length_object);
        $fabric_type_serial = Str::upper($fabric_type_serial);

        $getDuplicateSN = LayingPlanning::select('gl_id','color_id')
                            ->where('gl_id', $gl_id)
                            ->where('color_id', $color_id)
                            ->get();
        $count_duplicate = $getDuplicateSN->count();

        if ($count_duplicate <= 0) {
        $serial_number = "LP-{$gl_number}-{$color->color_code}{$fabric_type_serial}{$fabric_cons_serial}";
        } else {
        $serial_number = "LP-{$gl_number}-{$color->color_code}{$fabric_type_serial}-{$fabric_cons_serial}-".Str::padLeft($count_duplicate+1, 2, '0');
        }
        return $serial_number;
    }
}
