<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Employer
 *
 * @property int $id
 * @property string $fullname
 * @property string $cpf
 * @property string $rg
 * @property string $birthdata
 * @property string $email
 * @property string $address
 * @property string $address_cep
 * @property string $address_number
 * @property string $address_city
 * @property string $address_state
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @package App\Models
 */
class Employee extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $table = 'employees';

    protected $casts = [
        'id' => 'int',
        'status' => 'int',
        'birthdata' => 'datetime:d/m/Y',
        'created_at' => 'datetime:d/m/Y h:m',
        'updated_at' => 'datetime:d/m/Y h:m',
        'deleted_at' => 'datetime:d/m/Y h:m',
    ];

    protected $fillable = [
        'fullname',
        'cpf',
        'rg',
        'birthdata',
        'email',
        'address',
        'address_cep',
        'address_number',
        'address_city',
        'address_state'
    ];

    public function salary()
    {
        return $this->hasMany(EmployeeSalary::class, 'employee_id');
    }
}
