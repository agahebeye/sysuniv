<?php

namespace App\Models;

use App\Enums\UserType;
use App\Enums\GenderType;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'serial_number',
        'firstname',
        'lastname',
        'gender',
        'birth_date',
        'address'
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'gender' => GenderType::class,
    ];

    protected static function booted()
    {
        static::creating(fn ($student) => $student->registration_number = strtoupper(Str::random(20)));
        static::addGlobalScope('forUniversities', function (Builder $builder) {
            $builder
                ->when(
                    auth()->user()->role == UserType::UNIVERSITY,
                    fn (Builder $query) => $query->whereRelation('universities', 'users.id', auth()->id())
                );
        });
    }

    public function getRouteKey()
    {
        return  \Hashids::connection(get_called_class())->encode($this->getKey());
    }

    /**
     * Relationships
     */
    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function latestRegistration()
    {
        return $this->hasOne(Registration::class)->latestOfMany();
    }

    public function registrationResult()
    {
        return $this->hasOneThrough(Result::class, Registration::class);
    }

    public function universities()
    {
        return $this->belongsToMany(User::class, 'registrations', relatedPivotKey: 'university_id');
    }

    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'registrations')->wherePivotNotNull('faculty_id');
    }

    public function institutes()
    {
        return $this->belongsToMany(Institute::class, 'registrations')->wherePivotNotNull('institute_id');
    }

    /**
     * Fqueries
     */
    public function ScopeApplyFilters($query)
    {
        $this->filterByGender($query);
        $this->filterByCategory($query);
        $this->filterByFreshmen($query);
        $this->filterByStartDateOfRegistration($query);
        $this->filterByEndDateOfRegistration($query);
        $this->filterByBetweenDatesOfRegistration($query);
        $this->filterByLevel($query);
        $this->filterByUniversity($query);
    }

    public function filterByUniversity($query)
    {
        $query->when(
            request()->has('filter') && array_key_exists('universities.name', request('filter')),
            fn (Builder $query) => $query->whereRelation('universities', 'users.name', request('filter')['universities.name'])
        );
    }

    public function filterByGender($query)
    {
        $query->when(
            request()->has('filter') && array_key_exists('gender', request('filter')),
            fn ($query) => $query->whereGender(request('filter')['gender'])
        );
    }

    public function filterByLevel($query)
    {
        $query->when(
            request()->has('filter') && array_key_exists('registrations.level', request('filter')),
            fn (Builder $query) => $query->whereRelation('registrations', 'level', request('filter')['registrations.level'])
        );
    }
    public function FilterByStartDateOfRegistration($query)
    {
        $query->when(
            request()->has('filter') && array_key_exists('registrations.start_date', request('filter')),
            fn (Builder $query) => fn (Builder $query) => $query->whereHas('registrations', fn (Builder $query) => $query->whereYear('created_at', '>=', date('Y')))

        );
    }
    public function FilterByEndDateOfRegistration($query)
    {
        $query->when(
            request()->has('filter') && array_key_exists('registrations.end_date', request('filter')),
            fn (Builder $query) => fn (Builder $query) => $query->whereHas('registrations', fn (Builder $query) => $query->whereYear('created_at', '<=', date('Y')))
        );
    }
    public function FilterByBetweenDatesOfRegistration($query)
    {
        $query->when(
            request()->has('filter') && array_key_exists('registrations.start_date', request('filter')) && array_key_exists('registrations.end_date', request('filter')),
            fn (Builder $query) => fn (Builder $query) => $query->whereHas('registrations', fn (Builder $query) => $query->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ]))
        );
    }

    public function FilterByFreshmen($query)
    {
        $query->when(
            request()->has('filter') && array_key_exists('freshmen', request('filter')),
            fn (Builder $query) => $query->whereHas('registrations', fn (Builder $query) => $query->whereYear('created_at', date('Y')))
        );
    }

    public function FilterByCategory($query)
    {
        $query->when(
            request()->has('filter') && array_key_exists('results.mention', request('filter')),
            function (Builder $query) {
                $query->whereRelation('registrations.result', 'mention', request('filter')['results.mention']);
            }
        );
    }
}
