<?php

namespace App\Policies;

use App\Reviewer;
use App\Advertiser;
use App\Community;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any communities.
     *
     * @param  \App\Reviewer  $user
     * @return mixed
     */
    public function viewAny(Reviewer $user)
    {
        //
    }

    /**
     * Determine whether the user can view the community.
     *
     * @param  \App\Reviewer  $user
     * @param  \App\Community  $community
     * @return mixed
     */
    public function view(Reviewer $user, Community $community)
    {
        //
    }

    /**
     * Determine whether the user can create communities.
     *
     * @param  \App\Reviewer  $user
     * @return mixed
     */
    public function create(Reviewer $user)
    {
        
        
    }

    /**
     * Determine whether the user can update the community.
     *
     * @param  \App\Reviewer  $user
     * @param  \App\Community  $community
     * @return mixed
     */
//    public function update(Reviewer $user, Community $community, Advertiser $advertiser)
//    {
//        if(Auth::guard('advertiser')->check()){
//            return $advertiser->id === $community->advertiser_id;
//        }
//        return $user->id === $community->reviewer_id;
//    }

    /**
     * Determine whether the user can delete the community.
     *
     * @param  \App\Reviewer  $user
     * @param  \App\Community  $community
     * @return mixed
     */
//    public function delete(Reviewer $user, Advertiser $advertiser, Community $community)
//    {
//        if(Auth::guard('advertiser')->check()){
//            return $advertiser->id === $community->advertiser_id;
//        }
//        return $user->id === $community->reviewer_id;
//    }

    /**
     * Determine whether the user can restore the community.
     *
     * @param  \App\Reviewer  $user
     * @param  \App\Community  $community
     * @return mixed
     */
    public function restore(Reviewer $user, Community $community)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the community.
     *
     * @param  \App\Reviewer  $user
     * @param  \App\Community  $community
     * @return mixed
     */
    public function forceDelete(Reviewer $user, Community $community)
    {
        //
    }
}
