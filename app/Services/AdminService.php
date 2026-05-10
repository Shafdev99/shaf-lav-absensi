<?php

namespace App\Services;

use App\Models\Semester;
use App\Http\Controllers\Controller;

class AdminService extends Controller
{
    public function updateSemester()
    {
        $semester = Semester::count();

        if ($semester == 0) {

            // Tambah data
            for ($i = 0; $i < request()->semester; $i++) {
                Semester::create([
                    'semester' => $i + 1
                ]);
            }
        } else {
            if ($semester != request()->semester) {
                // Hapus data
                Semester::truncate();

                // Tambah data
                for ($i = 0; $i < request()->semester; $i++) {
                    Semester::create([
                        'semester' => $i + 1
                    ]);
                }
            }
        }

        return true;
    }
}
