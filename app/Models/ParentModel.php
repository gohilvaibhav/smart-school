<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentModel extends Model
{
    use SoftDeletes;

    protected $table = 'parents'; // Since class name is not "Parent"

    protected $fillable = ['name', 'email', 'student_id','mobile'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
