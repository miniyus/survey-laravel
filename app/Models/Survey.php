<?php

namespace App\Models;

use App\Casts\JSON;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\survey
 * @property string $survey_name
 * @property mixed|null $survey_json
 * @method static \Illuminate\Database\Eloquent\Builder|Survey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Survey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Survey query()
 * @mixin \Eloquent
 */
class Survey extends Model
{
    use HasFactory;

    protected $table = 'survey';

    /**
     * @return HasMany
     */
    public function result(): HasMany
    {
        return $this->hasMany(SurveyResult::class, 'survey_id', 'id');
    }

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
        'survey_name',
        'survey_json'
    ];

    protected $casts = [
        'survey_json' => JSON::class
    ];
}
