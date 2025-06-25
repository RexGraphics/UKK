<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function showActivity(Request $request) {
        $perPage = $request->get('per_page', 10);

        $ghazwanPetugas = Petugas::All();

        $perPage = is_numeric($perPage) && $perPage > 0 ? (int)$perPage : 10;

        // Urutkan data berdasarkan created_at secara descending
        $ghazwanActivity = Activity::where('description','LIKE', '%' . $request->ghazwanSearch . '%')->orderBy('created_at', 'desc')->paginate($perPage);

        return view('admin.activity', compact('ghazwanActivity', 'perPage', 'ghazwanPetugas'));
    }

}
