<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $companies = Company::all();
        return view('admin.home', compact('companies'));
    }

    public function getCompany()
    {
        $total                          = Company::get()->count();
        $length                         = intval($_REQUEST['length']);
        $length                         = $length < 0 ? $total : $length;
        $start                          = intval($_REQUEST['start']);
        $draw                           = intval($_REQUEST['draw']);
        $search                         = $_REQUEST['search']["value"];
        $output                         = array();
        $output['data']                 = array();

        $end                            = $start + $length;
        $end                            = $end > $total ? $total : $end;

        if ($search != '') {
            $query                         = Company::where(function ($filter) use ($search) {
                $filter->orWhere('name', 'like', '%' . $search . '%');
                $filter->orWhere('email', 'like', '%' . $search . '%');
            })
                ->take($length)
                ->skip($start)
                ->get();
            $no = $start + 1;
            foreach ($query as $val) {
                $output['data'][] = [
                    $no,
                    $val->name,
                    $val->address,
                    $val->email,
                    '<a href="' . route('companies.edit', $val->id) . '" class="btn btn-warning">Edit</a>' .
                        '<form action="' . route('companies.destroy', $val->id) . '" method="POST" class="d-inline">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                    </form>',
                ];
                $no++;
            }
            $rows                         = Company::where(function ($filter) use ($search) {
                $filter->orWhere('name', 'like', '%' . $search . '%');
                $filter->orWhere('email', 'like', '%' . $search . '%');
            })
                ->get();
            $output['draw']                 = $draw;
            $output['recordsTotal']         = $output['recordsFiltered']      = $rows->count();
        } else {
            $query                         = Company::take($length)
                ->skip($start)
                ->get();
            $no = $start + 1;
            foreach ($query as $val) {
                $output['data'][] = [
                    $no,
                    $val->name,
                    $val->address,
                    $val->email,
                    '<a href="' . route('companies.edit', $val->id) . '" class="btn btn-warning">Edit</a>' .
                        '<form action="' . route('companies.destroy', $val->id) . '" method="POST" class="d-inline">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                    </form>',
                ];
                $no++;
            }
            $output['draw']             = $draw;
            $output['recordsTotal']     = $total;
            $output['recordsFiltered']  = $total;
        }

        return response()->json($output);
    }

    public function getCompanyApi()
    {
        $companies = Company::all();
        return response()->json($companies, 200);
    }
}
