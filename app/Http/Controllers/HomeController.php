<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $assets = DB::table('assets')
            ->join('vendors', 'assets.vendor_id', '=', 'vendors.id')
            ->join('projects', 'assets.project_id', '=', 'projects.id')
            ->join('asset_types', 'assets.asset_type_id', '=', 'asset_types.id')
            ->join('proses', 'assets.proses_id', '=', 'proses.id')
            ->join('pemiliks', 'assets.pemiliks_id', '=', 'pemiliks.id')
            ->join('photos', 'assets.photo_id', '=', 'photos.id')
            ->join('parts', 'assets.idPart', '=', 'parts.idPart')
            ->join('customers', 'projects.customer_id', '=', 'customers.id')
            ->select(
                'assets.no_assets',
                'vendors.name_vendor as vendor_name',
                'customers.name as customer_name',
                'projects.name_project as project_name',
                'asset_types.name_type as asset_type_name',
                'proses.proses_name as process_name',
                'pemiliks.name_pemilik as owner_name',
                'photos.path as photo_url',
                'parts.part_name',
                'parts.idPart',
                'parts.spek_material',
                'assets.jumlah',
                'parts.spek_mesin'
            )
            ->paginate(10); // Adjust the number as needed

        // Calculate statistics
        $totalAssets = DB::table('assets')->count();
        $totalVendors = DB::table('assets')
            ->join('vendors', 'assets.vendor_id', '=', 'vendors.id')
            ->distinct('assets.vendor_id')
            ->count('assets.vendor_id');
        $totalProjects = DB::table('assets')
            ->join('projects', 'assets.project_id', '=', 'projects.id')
            ->distinct('assets.project_id')
            ->count('assets.project_id');

        return view('home', compact('assets', 'totalAssets', 'totalVendors', 'totalProjects'));
    }
}