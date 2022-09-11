<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EmployeeSalary
 *
 * @property int $id
 * @property int $employee_id
 * @property int $salary
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class EmployeeSalary extends Model
{
    use HasFactory;

    protected $table = 'employee_salaries';

    protected $casts = [
        'id' => 'int',
        'employee_id' => 'int',
        'salary' => 'float',
        'created_at' => 'datetime:d/m/Y h:m',
        'updated_at' => 'datetime:d/m/Y h:m'
    ];

    protected $fillable = [
        'employee_id',
        'salary'
    ];

    protected $guarded = ['id','updated_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
