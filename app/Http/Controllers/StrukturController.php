<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index()
    {
        // Pimpinan Puncak
        $pimpinanPuncak = [
            [
                'nama' => 'As Abrurrahman',
                'jabatan' => 'Penasihat',
                'icon' => '👑'
            ],
            [
                'nama' => 'Hidayat Saleh',
                'jabatan' => 'Mudirul \'Am',
                'icon' => '🎓'
            ]
        ];

        // Unsur Pembantu Pimpinan (Sekretariat)
        $sekretariat = [
            [
                'nama' => '[Nama Sekretaris]',
                'jabatan' => 'Sekretaris',
                'icon' => '📋'
            ],
            [
                'nama' => '[Nama Bendahara]',
                'jabatan' => 'Bendahara',
                'icon' => '💰'
            ]
        ];

        // Mudir Satuan (Unit Pendidikan)
        $mudirSatuan = [
            [
                'nama' => 'Nenden Marlina',
                'unit' => 'KOBER',
                'icon' => '👶'
            ],
            [
                'nama' => 'Lisnawati',
                'unit' => 'RA',
                'icon' => '🧒'
            ],
            [
                'nama' => 'Miftah Rahman',
                'unit' => 'SDIT',
                'icon' => '📚'
            ],
            [
                'nama' => 'Lia',
                'unit' => 'MDT',
                'icon' => '🕌'
            ],
            [
                'nama' => 'Dede Nasrulloh',
                'unit' => 'MTs',
                'icon' => '📖'
            ],
            [
                'nama' => 'Lutfi Abdurahman',
                'unit' => 'MA',
                'icon' => '🎓'
            ]
        ];

        // Bidang & Lembaga
        $bidang = [
            [
                'nama' => 'Tim QU',
                'deskripsi' => 'Quality Unit',
                'icon' => '✅'
            ],
            [
                'nama' => 'Tim Kominfo',
                'deskripsi' => 'Komputer & Informasi',
                'icon' => '💻'
            ],
            [
                'nama' => 'Tim Kopontren',
                'deskripsi' => 'Koperasi Pesantren',
                'icon' => '🏪'
            ],
            [
                'nama' => 'Bidang Pendidikan',
                'deskripsi' => 'Kurikulum & Pengajaran',
                'icon' => '📚'
            ],
            [
                'nama' => 'Bidang Dakwah',
                'deskripsi' => 'Syiar & Keislaman',
                'icon' => '📢'
            ],
            [
                'nama' => 'Bidang Sarana Prasarana',
                'deskripsi' => 'Fasilitas & Pemeliharaan',
                'icon' => '🏗️'
            ],
            [
                'nama' => 'Bidang Kemuslimahan',
                'deskripsi' => 'Kegiatan Keagamaan',
                'icon' => '🕌'
            ]
        ];

        return view('struktur', compact(
            'pimpinanPuncak',
            'sekretariat',
            'mudirSatuan',
            'bidang'
        ));
    }
}
