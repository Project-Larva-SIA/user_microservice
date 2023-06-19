<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model{

protected $table = 'users';
protected $primaryKey = 'id'; 
public $timestamps = false;
// column sa table
protected $fillable = [
  'name', 'email', 'password', 'created_at', 'updated_at'
];
}