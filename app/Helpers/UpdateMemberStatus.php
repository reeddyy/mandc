<?php

namespace App\Helpers;

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
                $valid_members = array();
                foreach ($members as $member) {
                    if ($member->membership_validity < Carbon::now()->format('Y-m-d')) {
                        array_push($expired_members, $member->id);
                    } else {
                        array_push($valid_members, $member->id);
                    }
                }
                Membership::whereIn('id', $expired_members)
                    ->update(['member_status' => "Expired"]);

                Membership::whereIn('id', $valid_members)
                    ->update(['member_status' => "Valid"]);
            });
    }
}
