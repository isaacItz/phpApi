<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PawnReactivationRule extends Model
{
    use SoftDeletes;

    protected $table = 'pawn_reactivation_rules';

    public $timestamps = false;

    protected $fillable = [
        'store_id',
        'merchandise_type',
        'loan_amount_min',
        'loan_amount_max',
        'auction_date_expired_min',
        'auction_date_expired_max',
        'user_request_auth',
        'user_response_auth',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}

?>