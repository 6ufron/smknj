<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Download;

class DownloadController extends AdminController
{
    protected $title = 'Download';

    // Tabel data file unduhan
    protected function grid()
    {
        $grid = new Grid(new Download());

        $grid->column('id', __('No'))->sortable();
        $grid->column('title', __('Nama Dokumen'));
        $grid->column('description', __('Keterangan Singkat'))->limit(50);

        // Tombol unduh file
        $grid->column('file_path', __('Aksi'))->display(function ($filePath) {
            if ($filePath) {
                $url = asset('storage/' . $filePath);
                return "
                    <a href='{$url}' target='_blank' class='btn btn-success btn-sm'>
                        <i class='fa fa-download'></i> Download
                    </a>
                ";
            }
            return '—';
        });

        $grid->column('created_at', __('Diunggah Pada'));
        $grid->column('updated_at', __('Diperbarui Pada'))->hide();

        // Filter pencarian
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('title', 'Nama Dokumen');
            $filter->like('description', 'Keterangan');
            $filter->equal('file_type', 'Tipe Dokumen')->select([
                'pdf' => 'PDF',
                'doc' => 'DOC',
                'docx' => 'DOCX',
                'xls' => 'XLS',
                'xlsx' => 'XLSX',
                'zip' => 'ZIP',
            ]);
            $filter->between('created_at', 'Diunggah Pada')->date();
            $filter->between('updated_at', 'Diperbarui Pada')->date();
        });

        return $grid;
    }

    // Detail data file unduhan
    protected function detail($id)
    {
        $show = new Show(Download::findOrFail($id));

        $show->field('title', __('Nama Dokumen'));
        $show->field('description', __('Keterangan'));
        $show->field('file_path', __('Path File'));
        $show->field('created_at', __('Diunggah Pada'));
        $show->field('updated_at', __('Diperbarui Pada'));

        return $show;
    }

    // Form input data file
    protected function form()
    {
        $form = new Form(new Download());

        $form->text('title', __('Nama Dokumen'))->rules('required');
        $form->textarea('description', __('Keterangan'));
        $form->file('file_path', __('Pilih Dokumen'))
            ->rules('required|mimes:pdf,doc,docx,xls,xlsx,zip')
            ->removable()
            ->downloadable()
            ->disk('public');

        return $form;
    }
}
