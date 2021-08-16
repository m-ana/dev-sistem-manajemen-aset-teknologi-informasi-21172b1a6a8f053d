<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Data Terakhir',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\DataPerangkatKera',
            'group_by_field'        => 'tahun_berakhir_garansi',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'col-md-6',
            'entries_number'        => '5',
            'fields'                => [
                'nomor_rak'   => 'nomor',
                'nama_merk'   => 'nama',
                'nama_jenis'  => 'nama',
                'tipe'        => '',
                'nama_status' => 'nama',
            ],
            'translation_key' => 'dataPerangkatKera',
        ];

        $settings1['data'] = [];
        if (class_exists($settings1['model'])) {
            $settings1['data'] = $settings1['model']::latest()
                ->take($settings1['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings1)) {
            $settings1['fields'] = [];
        }

        $settings2 = [
            'chart_title'           => 'ATS',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\DataPerangkatKera',
            'group_by_field'        => 'tahun_berakhir_garansi',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_period'         => 'year',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'col-md-12',
            'entries_number'        => '10',
            'fields'                => [
                'nomor_rak'              => 'nomor',
                'nama_merk'              => 'nama',
                'nama_jenis'             => 'nama',
                'tipe'                   => '',
                'tahun_berakhir_garansi' => '',
                'nama_lokasi'            => 'nama',
            ],
            'translation_key' => 'dataPerangkatKera',
        ];

        $settings2['data'] = [];
        if (class_exists($settings2['model'])) {
            $settings2['data'] = $settings2['model']::latest()
                ->take($settings2['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings2)) {
            $settings2['fields'] = [];
        }

        return view('home', compact('settings1', 'settings2'));
    }
}
