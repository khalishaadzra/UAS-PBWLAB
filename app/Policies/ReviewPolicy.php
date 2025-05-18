<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response; // Atau HandlesAuthorization

class ReviewPolicy
{
    // Jika Anda ingin menggunakan trait HandlesAuthorization (opsional, untuk respons yang lebih custom)
    // use Illuminate\Auth\Access\HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     * (Apakah user bisa melihat daftar review - biasanya true)
     */
    public function viewAny(User $user): bool
    {
        return true; // Atau sesuaikan dengan logika Anda
    }

    /**
     * Determine whether the user can view the model.
     * (Apakah user bisa melihat detail review tertentu - biasanya true)
     */
    public function view(User $user, Review $review): bool
    {
        return true; // Atau sesuaikan dengan logika Anda
    }

    /**
     * Determine whether the user can create models.
     * (Apakah user bisa membuat review baru)
     */
    public function create(User $user): bool
    {
        // Misalnya, semua user yang login bisa membuat review
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Review $review): bool
    {
        // Hanya user yang membuat review yang bisa mengupdatenya
        return $user->id === $review->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Review $review): bool
    {
        // Hanya user yang membuat review yang bisa menghapusnya
        return $user->id === $review->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     * (Jika Anda menggunakan soft deletes)
     */
    // public function restore(User $user, Review $review): bool
    // {
    //     return $user->id === $review->user_id;
    // }

    /**
     * Determine whether the user can permanently delete the model.
     * (Jika Anda menggunakan soft deletes)
     */
    // public function forceDelete(User $user, Review $review): bool
    // {
    //     return $user->id === $review->user_id;
    // }
}