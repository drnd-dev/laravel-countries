<?php

namespace Lwwcas\LaravelCountries\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Lwwcas\LaravelCountries\Database\Factories\CountryRegionTranslationFactory;

/**
 * @property int $id
 * @property int $lc_region_id
 * @property string $name
 * @property string $slug
 * @property string $locale
 *
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static CountryRegionTranslationFactory factory(...$parameters)
 *
 * @mixin Model
 */
class CountryRegionTranslation extends Model
{
    /** @use HasFactory<CountryRegionTranslationFactory> */
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lc_region_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'slug',
        'name',
    ];

    /**
     * Create a new factory instance for the model.
     */
    public static function newFactory(): CountryRegionTranslationFactory
    {
        return CountryRegionTranslationFactory::new();
    }

    public static function booted(): void
    {
        self::creating(function (CountryRegionTranslation $model) {
            $model->slug = Str::slug($model->name);
        });
    }
}
