<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JllJob
 * @package App\Models
 */
class JllJob extends Model
{
    /**
     * @var string
     */
    protected $table = 'jll_jobs';

    /**
     * @var array
     */
    protected $fillable = ['name', 'category', 'site', 'job_desc', 'status', 'sort'];
}
