<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Exam Model
 */
class Exam extends Model
{
    use HasFactory;

    protected $table = "exams";
    public $timestamps = true;

    protected $fillable = [
		'question', 'category','option1','option2', 'option3', 'option4'
	];
}
