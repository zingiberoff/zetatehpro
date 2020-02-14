<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{
    //
    protected $fillable = ['name', 'description', 'code', 'confirmation'];
    protected $casts = [
        'next_statuses' => 'array',
    ];

    public function permissibleChangeStatuses(User $user = null)
    {
        if (!$user) {
            $user = \Auth::user();
        }
        $result = [];
        /** @var Role $role */

        foreach ($user->roles as $role) {

            if (array_key_exists($role->name, $this->next_statuses)) {
                foreach ($this->next_statuses[$role->name] as $statusCode) {

                    $result[] = self::where('code', $statusCode)->first();
                }
            }
        }
        return collect($result);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'status_id');
    }
}

