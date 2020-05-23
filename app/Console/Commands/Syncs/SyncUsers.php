<?php


namespace App\Console\Commands\Syncs;


use App\Api\UsersRequest;
use App\User;

class SyncUsers extends Sync
{
    public function handle(UsersRequest $usersRequest)
    {
        foreach ($usersRequest->all()->take($this->limits['users']) as $apiUser) {
            $user = User::where('remote_id', $apiUser['id'])->first();

            if ($user) {
                $user->update($this->userData($apiUser));
            } else {
                User::create($this->userData($apiUser));
            }
        }
    }

    protected function userData($user)
    {
        return [
            'remote_id' => $user['id'],
            'name' => $user['name'],
            'username' => $user['username'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'website' => $user['website'],
        ];
    }
}
