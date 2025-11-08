<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use OpenAdmin\Admin\Admin;
use OpenAdmin\Admin\Controllers\Dashboard;
use OpenAdmin\Admin\Layout\Column;
use OpenAdmin\Admin\Layout\Content;
use OpenAdmin\Admin\Layout\Row;

// Import semua model
use App\Models\{
    Alumni,
    Berita,
    Download,
    Ekstrakurikuler,
    EkstraKategori,
    Fasilitas,
    Gafoto,
    Gavideo,
    IdentiSekolah,
    Jurusan,
    KataAlumni,
    Kepsek,
    Layanan,
    Pengumuman,
    Prestasi,
    ProfilSekolah,
    User,
};

class HomeController extends Controller
{
    public function index(Content $content)
    {
        // === Ambil semua statistik model ===
        $stats = [
            'totalAlumni'         => Alumni::count(),
            'totalBerita'         => Berita::count(),
            'totalDownload'       => Download::count(),
            'totalEkstraKategori' => EkstraKategori::count(),
            'totalEkstrakurikuler'=> Ekstrakurikuler::count(),
            'totalFasilitas'      => Fasilitas::count(),
            'totalGafoto'         => Gafoto::count(),
            'totalGavideo'        => Gavideo::count(),
            'totalIdentitas'      => IdentiSekolah::count(),
            'totalJurusan'        => Jurusan::count(),
            'totalKataAlumni'     => KataAlumni::count(),
            'totalKepsek'         => Kepsek::count(),
            'totalLayanan'        => Layanan::count(),
            'totalPengumuman'     => Pengumuman::count(),
            'totalPrestasi'       => Prestasi::count(),
            'totalProfilSekolah'  => ProfilSekolah::count(),
            // 'totalUser'           => User::count(),
        ];

        return $content
            ->css_file(Admin::asset("open-admin/css/pages/dashboard.css"))
            ->title('Dashboard Admin')
            ->description('Monitoring Data & Sistem Informasi SMK Nurul Jadid')
            ->row(Dashboard::title())
            
            // === Statistik Dashboard ===
            ->row(function (Row $row) use ($stats) {
                $row->column(12, function (Column $column) use ($stats) {
                    $column->append(view('admin.widgets.statistics', $stats));
                });
            })

            // === Environment, Extensions, Dependencies tetap ditampilkan ===
            ->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });
    }
}
