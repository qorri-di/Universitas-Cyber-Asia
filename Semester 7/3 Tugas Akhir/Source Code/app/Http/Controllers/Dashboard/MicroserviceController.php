<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MicroserviceController
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            // hanya huruf, angka, dash (-), slash (/)
            if (!preg_match('/^[A-Za-z0-9\/\-]+$/', $search)) {
                return redirect()->back();
            }
        }

        $query = DB::table('vw_microservice');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('microservice_name', 'like', "%{$search}%")
                    ->orWhere('microservice_path', 'like', "%{$search}%");
            });
        }

        $vms = $query->orderBy('microservice_path', 'asc')
            ->paginate(20)
            ->appends(['search' => $search]); // agar search tetap di URL saat pindah halaman

        return view('dashboard.index', [
            'content' => 'microservice.index',
            'vms' => $vms,
            'search' => $search,
        ]);
    }

    public function create(Request $request)
    {
        // Validasi input
        $msBy = $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'required|string|max:255',
            'target' => 'required|url|max:255',
            'method' => 'required|in:GET,POST,PUT,DELETE',
            'gateway' => 'required|in:ACTIVE,INACTIVE',
            'zta' => 'required|in:ACTIVE,INACTIVE',
            'edr' => 'required|in:ACTIVE,INACTIVE',
        ]);

        $msid = 'MSID' . now()->format('YmdHis') . rand(100000000, 999999999);

        $this->insertMicroservice($msid,$msBy['name'],$msBy['method'],$msBy['path'],$msBy['target'],$msBy['gateway']);
        $this->insertZta($msid,$msBy['zta']);
        $this->insertEdr($msid,$msBy['edr']);

        return view('dashboard.index', [
            'content' => 'microservice.index'
        ]);
    }

    private function insertMicroservice($msid,$name,$methode,$path,$target,$status){
        DB::table('microservices')->insert([
            'microservice_id' => $msid,
            'microservice_name' => $name,
            'microservice_methode' => $methode,
            'microservice_path' => $path,
            'microservice_target' => $target,
            'microservice_status' => $status,
            'created_by' => 'USRID20250707131759125640940',
            'created_at' => now(),
            'updated_by' => null,
            'updated_at' => null
        ]);
    }

    private function insertZta($msid,$status_zta){
        DB::table('ztas')->insert([
            'zta_id' => 'ZTAID' . now()->format('YmdHis') . rand(100000000, 999999999),
            'microservice_id' => $msid,
            'zta_status' => $status_zta,
            'created_by' => 'USRID20250707131759125640940',
            'created_at' => now(),
            'updated_by' => null,
            'updated_at' => null
        ]);
    }

    private function insertEdr($msid,$status_edr){
        DB::table('edrs')->insert([
            'zta_id' => 'ERID' . now()->format('YmdHis') . rand(100000000, 999999999),
            'microservice_id' => $msid,
            'zta_status' => $status_edr,
            'created_by' => 'USRID20250707131759125640940',
            'created_at' => now(),
            'updated_by' => null,
            'updated_at' => null
        ]);
    }

    public function log(Request $request)
    {

    }
}
