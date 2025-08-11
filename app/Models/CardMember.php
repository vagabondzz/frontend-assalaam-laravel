<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CardMember extends Model {
    use HasFactory;
    protected $table = "card_members";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'nama',
        'no_member',
        'tempat_lahir',
        'tanggal_lahir',
        'no_identitas',
        'jenis_kelamin',
        'alamat',
        'rt_rw',
        'kelurahan',
        'kecamatan',
        'kota',
        'kode_pos',
        'no_hp',
        'status',
        'jumlah_tanggungan',
        'pendapatan',
        'npwp',
        'kewarganegaraan',
        'agama',
        'validation',
        'member_profile',
        'active_start',
        'active_end',
        'is_active',
        'user_id'
    ];

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    public function getIsActiveAttribute($value) {
        if ($this->active_end < Carbon::today() && $value) {
            $this->is_active = false;
            $this->save();
        }

        return $this->attributes['is_active'];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
