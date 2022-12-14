<?php

namespace App\Helpers;

use App\Models\Ada;
use App\Models\Membership;
use Carbon\Carbon;

class UpdateMemberStatus
{
    public function __construct()
    {
        # code...
    }

    public function updateStatus()
    {
        Membership::select('id', 'member_status', 'membership_validity')
            ->chunk(50, function ($members) {
                $expired_members = array();
                $active_members = array();
                foreach ($members as $member) {
                    if ($member->membership_validity < Carbon::now()->format('Y-m-d')) {
                        if ($member->member_status != "Expired") {
                            array_push($expired_members, $member->id);
                        }
                    } else {
                        if ($member->member_status != "Active") {
                            array_push($active_members, $member->id);
                        }
                    }
                }
                Membership::whereIn('id', $expired_members)
                    ->update(['member_status' => "Expired"]);

                Membership::whereIn('id', $active_members)
                    ->update(['member_status' => "Active"]);
            });

        Ada::select('id', 'award_status', 'award_validity')
            ->chunk(50, function ($awards) {
                $expired_awards = array();
                $active_awards = array();
                foreach ($awards as $award) {
                    if ($award->award_validity < Carbon::now()->format('Y-m-d')) {
                        if ($award->award_status != "Expired") {
                            array_push($expired_awards, $award->id);
                        }
                    } else {
                        if ($award->award_status != "Active") {
                            array_push($active_awards, $award->id);
                        }
                    }
                }
                Ada::whereIn('id', $expired_awards)
                    ->update(['award_status' => "Expired"]);

                Ada::whereIn('id', $active_awards)
                    ->update(['award_status' => "Active"]);
            });
    }
}
