<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Vendor\VendorRequest;
use App\Models\Quarter;
use App\Models\Vendor__Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Facades\Route;

class VendorController extends Controller
{
    public function index(Request $request,$locale)
    {
        if ($request->ajax()) {
            $vendors = Vendor::with('created_by')
                               ->select(
                                    'id',
                                    'created_by_id',
                                    'company_name',
                                    'brand_name',
                                    'logo',
                                    'status',
                                    'activation_status',
                                    'rating',
                                    'created_at'
                                );
            if ($request->search_btn_value == 'pressed') {

                if (! is_null($request->name)) {
                    $vendors = $vendors->where('name',$request->name);
                }
            }

            return Datatables::of($vendors)
                    ->addColumn('created_by', function (Vendor $vendor) {
                        if($vendor->created_by != null)
                        {
                            $array_data = [
                                            'name' => $vendor->created_by->name ,
                                            'url'=>'',
                                            'created_at' => $vendor->created_at->translatedFormat('d F Y h:i:s A')
                                          ];
                            return $array_data ;
                        }
                        else
                        {
                            return null;
                        }
                    })
                    ->addColumn('logo', function (Vendor $vendor) {
                        return $vendor->logo ;
                    })
                    ->addColumn('company_name', function (Vendor $vendor) {
                        return $vendor->company_name ;
                    })
                    ->addColumn('brand_name', function (Vendor $vendor) {
                        return $vendor->brand_name ;
                    })
                    ->addColumn('status', function (Vendor $vendor) {
                        return $vendor->status ;
                    })
                    ->addColumn('activation_status', function (Vendor $vendor) {
                        return $vendor->activation_status ;
                    })
                    ->addColumn('rating', function (Vendor $vendor) {
                        return $vendor->rating ;
                    })

                    ->addColumn('action', function (Vendor $vendor) {
                        return $vendor->id ;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Dashboard.Vendor.All_Items.index');
    }
    public function archived(Request $request)
    {
        if ($request->ajax()) {
            $vendors = Vendor::with('created_by','deleted_by')
                               ->select(
                                'id',
                                'created_by_id',
                                'deleted_by_id',
                                'name',
                                'created_at',
                                'deleted_at');
            if ($request->search_btn_value == 'pressed') {
                if (! is_null($request->name)) {
                    $vendors = $vendors->where('name',$request->name);
                }
            }
            return Datatables::of($vendors->onlyTrashed())
                    ->addColumn('created_by', function (Vendor $vendor) {
                        if($vendor->created_by != null)
                        {
                            $array_data = [
                                            'id' => $vendor->created_by->id,
                                            'name' => $vendor->created_by->first_name,
                                            'created_at' => $vendor->created_at->translatedFormat('d F Y h:i:s A')
                                        ];
                            return $array_data ;
                        }
                        else
                        {
                            return null;
                        }
                    })
                    ->addColumn('deleted_by', function (Vendor $vendor) {
                        if($vendor->deleted_by != null)
                        {
                            $array_data = [
                                            'id' => $vendor->deleted_by->id,
                                            'name' => $vendor->deleted_by->first_name,
                                            'created_at' => $vendor->deleted_at->translatedFormat('d F Y h:i:s A')
                                          ];
                            return $array_data ;
                        }
                        else
                        {
                            return null;
                        }
                    })
                    ->addColumn('name', function (Vendor $vendor) {
                        return $vendor->name ;
                    })
                    ->addColumn('deleteing_days', function (Vendor $vendor) {
                        $deleted_date = $vendor->deleted_at;
                        $deleted_date_after_30_days = ($vendor->deleted_at)->addDays(30);
                        $current_date = Carbon::now();
                        $interval = $deleted_date_after_30_days->diffInDays($current_date);
                        return $interval;
                    })
                    ->addColumn('action', function (Vendor $vendor) {
                        return $vendor->id ;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('Dashboard.Vendor.All_Items.index');
    }
    public function create($locale,Request $request)
    {
        $locale = app()->getLocale();
        return $this->edit($locale, new Vendor(),$request);
    }
    public function store($locale,VendorRequest $request)
    {
        $locale = app()->getLocale();
        $new_vendor = new Vendor();
        $new_vendor->setAttribute('created_by_id', Auth::user()->id);
        return $this->update($locale,$request, $new_vendor);
    }
    public function show($locale,Vendor $vendor,Request $request)
    {
        $name = $vendor->company_name ?? '';
        $words = explode(' ', trim($name));

        if(count($words) > 1){
            $initials = strtoupper(substr($words[0],0,1) . substr($words[1],0,1));
        } else {
            $initials = strtoupper(substr($name,0,2));
        }
        //get avarage review
        $avarage_reviews = round($vendor->reviews->avg('rating'));

        return view('Dashboard.Vendor.Single_Item.index',compact('vendor','initials','avarage_reviews'));
    }
    public function edit($locale ,Vendor $vendor,Request $request)
    {
        $all_vendors = Vendor::all();
        $strategic_goals = $vendor->strategic_goals;
        //charts
        $chart_options = [
            'chart_title' => 'task Details',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\TaskDetail',
            'group_by_field' => 'completion_status',
            'chart_type' => 'pie',
        ];
        $chart1 = new LaravelChart($chart_options);
        return view('Dashboard.Vendor.Form.index', compact('vendor','all_vendors','strategic_goals','chart1'));
    }
    public function update($locale,VendorRequest $request, Vendor $vendor)
    {
        if (Route::currentRouteName() == 'dashboard.vendor.update') {
            $vendor->setAttribute('updated_by_id', Auth::user()->id);
            $request->insert_update($request,$vendor);
        }
        else
        {
            $request->insert_update($request,$vendor);
        }

        $success_msg_status = '';
        if (str_contains(url()->current(), 'store')) {
            $success_msg_status = trans('Dashboard.Has_Been_Created_By');
        } else {
            $success_msg_status = trans('Dashboard.Has_Been_Updated_By');
        }

        return Redirect::route('dashboard.vendor.edit', ['locale' => app()->getLocale(),'vendor'=>$vendor])
              ->with('success_msg', trans('Dashboard.Vendor').' '.$success_msg_status.' '.Auth::user()->first_name.' '.Auth::user()->last_name);
    }
    public function destroy($locale,$vendor)
    {
        if ($vendor = Vendor::findOrFail($vendor)) {
            $vendor->deleted_by_id = Auth::user()->id;
            $vendor->save();
            $vendor->delete();

            return Redirect::route('dashboard.vendor.index', ['locale' => app()->getLocale()]);
        }

        return redirect::route('dashboard.error_pages.not_found', ['locale' => app()->getLocale()]);
    }
    public function restore($locale, $vendor)
    {
        if ($vendor = Vendor::withTrashed()->findOrFail($vendor)) {
            $vendor->deleted_by_id = null;
            $vendor->save();
            $vendor->restore();
            return Redirect::route('dashboard.vendor.index', ['locale' => app()->getLocale()]);
        }
        return redirect::route('dashboard.error_pages.not_found', ['locale' => app()->getLocale()]);
    }
    public function destroyPermanently($locale, $vendor)
    {
        if ($vendor = Vendor::withTrashed()->findOrFail($vendor)) {
            $vendor->forceDelete();
            return Redirect::route('dashboard.vendor.index', ['locale' => app()->getLocale()]);
        }

        return redirect::route('dashboard.error_pages.not_found', ['locale' => app()->getLocale()]);
    }
}
