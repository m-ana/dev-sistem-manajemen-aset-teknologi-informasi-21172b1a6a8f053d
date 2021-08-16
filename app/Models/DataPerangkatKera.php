<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DataPerangkatKera extends Model implements HasMedia
{
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'data_perangkat_keras';

    protected $appends = [
        'foto',
    ];

    protected $dates = [
        'tahun_berakhir_garansi',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nomor_rak_id',
        'nama_merk_id',
        'nama_jenis_id',
        'tipe',
        'serial_number',
        'tahun_beli',
        'nomor_u',
        'keterangan',
        'ip',
        'tahun_berakhir_garansi',
        'nomor_u_kosong',
        'kontak_pic',
        'nama_status_id',
        'nama_lokasi_id',
        'ruang_panel',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function nomor_rak()
    {
        return $this->belongsTo(Rak::class, 'nomor_rak_id');
    }

    public function nama_merk()
    {
        return $this->belongsTo(Merk::class, 'nama_merk_id');
    }

    public function nama_jenis()
    {
        return $this->belongsTo(Jeni::class, 'nama_jenis_id');
    }

    public function getTahunBerakhirGaransiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTahunBerakhirGaransiAttribute($value)
    {
        $this->attributes['tahun_berakhir_garansi'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFotoAttribute()
    {
        $files = $this->getMedia('foto');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function nama_status()
    {
        return $this->belongsTo(Status::class, 'nama_status_id');
    }

    public function nama_lokasi()
    {
        return $this->belongsTo(DataCenter::class, 'nama_lokasi_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
