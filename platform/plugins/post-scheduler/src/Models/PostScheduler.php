<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostScheduler extends Model
{
    protected $fillable = [
        'publish_date',
        'publish_time',
        'status'
    ];
}
?>
