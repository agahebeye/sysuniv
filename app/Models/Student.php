<?php

namespace App\Models;

use App\Enums\UserType;
use App\Enums\GenderType;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
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
        // static::addGlobalScope('forUniversities', function (Builder $builder) {
        //     $builder
        //         ->when(
        //             auth()->user()->role == UserType::UNIVERSITY,
        //             fn (Builder $query) => $query->whereRelation('universities', 'users.id', auth()->id())
        //         );
        // });
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
        return $this->belongsToMany(User::class, 'registrations', relatedPivotKey: 'university_id')
            ->withPivot('created_at');
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
    public function ScopeApplyFilters(Builder $query)
    {
        $query
            ->when(
                auth()->user()->role == UserType::UNIVERSITY,
                fn (Builder $query) => $query->whereRelation('universities', 'users.id', auth()->id())
            );

        $this->filterByUniversity($query);
        $this->filterByGender($query);
        $this->filterByCategory($query);
        $this->filterByFreshmen($query);
        $this->filterByBetweenDatesOfRegistration($query);
        $this->filterByLevel($query);
        $this->search($query);
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

    public function FilterByBetweenDatesOfRegistration($query)
    {
        $query->when(
            request()->has('filter') && array_key_exists('registrations.start_date', request('filter')) && array_key_exists('registrations.end_date', request('filter')),
            function (Builder $query) {
                $query->whereHas(
                    'registrations',
                    fn (Builder $query) => $query->whereYear('created_at', '>=', request('filter')['registrations.start_date'])
                        ->whereYear('created_at', '<=', request('filter')['registrations.end_date'])
                );
            }
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
            Request::has('filter') && array_key_exists('results.mention', Request::input('filter')),
            function (Builder $query) {
                if (request('filter')['results.mention'] == 'Abandonné') {
                    return  $query->whereRelation('registrations', 'has_abandoned', true);
                }

                return  $query->whereRelation('registrations.result', 'mention', request('filter')['results.mention']);
            }
        );
    }

    public function search($query)
    {
        $query->when(Request::input('search'), function ($query, $value) {
            $query->where('firstname', 'LIKE', "%{$value}%")
                ->orWhere('lastname', 'LIKE', "%{$value}%");
        });
    }
}
