<?php


namespace App\Api;


use Illuminate\Support\Collection;

class UsersRequest extends ApiRequest
{
    /**
     * Fetch all users from the api.
     *
     * @return Collection
     */
    public function all()
    {
        $results = $this->http->get('users')->json();

        return collect($results)->map(function ($user) {
            return [
                'id' => $user['id'],
                'name' => $user['name'],
                'username' => $user['username'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'website' => $user['website']
            ];
        });
    }
}
