<?php

namespace App\Models;

use App\Casts\JSON;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SurveyResult
 * @property int $survey_id
 * @property mixed|null $result
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SurveyResult query()
 * @mixin \Eloquent
 */
class SurveyResult extends Model
{
    use HasFactory;

    protected $table = 'survey_result';

    /**
     * @param DateTimeInterface $date
     * @return string
     */
    public function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'survey_id',
        'result'
    ];

    protected $casts = [
        'result' => JSON::class
    ];
}
