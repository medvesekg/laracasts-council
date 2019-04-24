<?php

namespace App;


use function foo\func;

trait Favoritable
{

    protected static function bootFavoritable()
    {
        static::deleting(function($model) {
            $model->favorites()->get()->each->delete();
        });
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $userId = auth()->id();
        return $this->favorites()->firstOrCreate([
            'user_id' => $userId
        ]);
    }

    public function unfavorite()
    {
        $userId = auth()->id();
        $this->favorites()->where('user_id', $userId)->get()->each->delete();
    }

    public function isFavorited()
    {
        return (bool)$this->favorites->where('user_id', auth()->id())->count();
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}