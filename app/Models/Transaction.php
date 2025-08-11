<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'trans_no',
        'member_card_no',
        'trans_date',
        'trans_total_transaction',
        'trans_poin_pas',
        'card_member_id'
    ];

    public function member() {
        return $this->belongsTo(CardMember::class, 'card_member_id', 'id');
    }
}
