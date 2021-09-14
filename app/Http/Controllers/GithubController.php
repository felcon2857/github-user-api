<?php

namespace App\Http\Controllers;

use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class GithubController extends Controller
{
    public function index(Request $request)
    {
        $names = [];
        $all_name = $request->input("names");
        foreach ($all_name as $name) {
        }
        $array1 = [
            "name" => "hello",
            "address" => "I don't know"
        ];
        $array2 = [
            "name" => "Bret",
            "address" => "wtf"
        ];
        $results = array_merge(array($array1, $array2));
        $map = collect($results)->map(function ($data) {
            $res = collect($data);
            return $res;
        })->sortBy("name");
        return response()->json([
            "message" => "success",
            "data" => $map
        ]);
    }
    public function github_user(Request $request)
    {
        $usernames = [];
        $all_users = $request->input("usernames");
        if (count($all_users) > 10) {
            return response()->json([
                "User Request" => "Maximum user request is only 10 users"
            ]);
        } elseif (count($all_users) < 1) {
            return response()->json([
                "User Request" => "Manimum user must not less than 1"
            ]);
        } else {
            foreach ($all_users as $users) {
                $usernames = $users;
                // $response = Http::get("https://api.github.com/users/{$usernames}");
                // $data[] = $response->json();
                // $mapping = collect($data)->map(function ($users) {
                //     $userinfo = collect($users);
                //     $res = [
                //         "Name" => $userinfo["name"],
                //         "Login" => $userinfo["login"],
                //         "Company" => $userinfo["company"],
                //         "Followers" => $userinfo["followers"],
                //         "Public Repositories" => $userinfo["public_repos"],
                //         "Followers per Public Repositories" => $userinfo["public_repos"] == 0 ? 0 : round($userinfo["followers"] / $userinfo["public_repos"])
                //     ];
                // $array_users =  $userinfo["login"];
                $redis = Redis::connection();
                // $redis->set($array_users, json_encode($res));
                $keys = $redis->keys("*$usernames*");
                foreach ($keys as $key) {
                    $cached = $redis->get($key);
                    $cached = json_decode($cached, true);
                    $gitinfo[] = $cached;
                }
                // return $gitinfo;
                // })->sortBy("Name");
            }
            return $gitinfo;
        }
    }
}
