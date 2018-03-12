<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Collection;

class CollectionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new CollectionPolicy instance.
     * Inject dependencies.
     *
     * @param  \Illuminate\Support\Facades\Auth $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Determine whether the user can view the collection.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Collection  $collection
     * @return mixed
     */
    public function view(User $user, Collection $collection)
    {
        return true;
    }

    /**
     * Determine whether the user can create collections.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->auth::check();
    }

    /**
     * Determine whether the user can update the collection.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Collection  $collection
     * @return mixed
     */
    public function update(User $user, Collection $collection)
    {
        return $user->id === $collection->user_id;
    }

    /**
     * Determine whether the user can delete the collection.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Collection  $collection
     * @return mixed
     */
    public function delete(User $user, Collection $collection)
    {
        return $user->id === $collection->user_id;
    }
}
