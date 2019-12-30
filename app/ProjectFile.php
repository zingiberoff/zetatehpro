<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * App\ProjectFiles
 *
 * @property int $id
 * @property string $name
 * @property int $project_id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Project $project
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectFile whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectFile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProjectFile extends Model
{
    //
    protected $table = 'project_files';
    protected $fillable = ['name', 'path'];

    public function __construct(array $attributes = [], UploadedFile $uploadedFile = null)
    {
        if ($uploadedFile instanceof UploadedFile) {
            $attributes['name'] = $uploadedFile->getClientOriginalName();

            $hash = md5_file($uploadedFile->path());
            $filename = $hash . '.' . $uploadedFile->extension();
            $dir = substr($hash, 0, 3);
            $attributes['path'] = $uploadedFile->storeAs('project_files/' . $dir, $filename);
        }

        parent::__construct($attributes);


    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
