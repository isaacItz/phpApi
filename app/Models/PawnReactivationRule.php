<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PawnReactivationRule extends Model
{
    use SoftDeletes;

    protected $table = 'pawn_reactivation_rules';

    protected $dates = ['deleted_at'];
}