<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'total_lessons',
        'icon',
        'color',
        'port'
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function userProgress($userId = null)
    {
        $query = $this->hasManyThrough(
            UserProgress::class,
            Lesson::class,
            'course_id',
            'lesson_id'
        );

        if ($userId) {
            $query->where('user_progress.user_id', $userId);
        }

        return $query;
    }

    public function getProgressPercentage($userId)
    {
        $totalLessons = $this->lessons()->count();
        if ($totalLessons === 0) return 0;

        $completedLessons = $this->userProgress($userId)
            ->where('is_completed', true)
            ->count();

        return round(($completedLessons / $totalLessons) * 100, 2);
    }
}
