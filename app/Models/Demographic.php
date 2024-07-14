<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demographic extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'demographic';

    // Specify the primary key (if not 'id')
    protected $primaryKey = 'demo_id';

    // Indicate if the IDs are auto-incrementing
    public $incrementing = true;

    // Specify the data type of the primary key
    protected $keyType = 'int';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'sex', 
        'age', 
        'birthday', 
        'civilStatus', 
        'youthclassification', 
        'schoolattainment', 
        'pdw', 
        'specialneeds'
    ];
}
