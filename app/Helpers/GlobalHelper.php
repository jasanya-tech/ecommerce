<?php

namespace App\Helpers;

use App\Models\Position;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Request;
use LDAP\Result;

class GlobalHelper
{
    public static function getAccesses(): array
    {
        return [
            (object)[
                'name' => 'read'
            ],
            (object)[
                'name' => 'create'
            ],
            (object)[
                'name' => 'update'
            ],
            (object)[
                'name' => 'delete'
            ],
            (object)[
                'name' => 'restore'
            ],
        ];
    }

    public static function getFeatures($permissions)
    {
        $fitur = [];
        foreach ($permissions as $permission) {
            $route = explode('.', $permission->name);
            if (isset($fitur[$route[0]])) {
                array_push($fitur[$route[0]], $route[1]);
                continue;
            }
            $fitur[$route[0]] = [$route[1]];
        }

        return $fitur;
    }

    public static function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        } else {
            $phoneNumber = '62' . $phoneNumber;
        }

        return $phoneNumber;
    }

    public static function getColors(): array
    {
        return [
            (object)[
                'name' => 'success'
            ],
            (object)[
                'name' => 'warning'
            ],
            (object)[
                'name' => 'danger'
            ],
            (object)[
                'name' => 'info'
            ],
            (object)[
                'name' => 'primary'
            ],
            (object)[
                'name' => 'light'
            ],
            (object)[
                'name' => 'dark'
            ],
        ];
    }

    public static function filterSosmeds($sosmedsRequest): array
    {
        $sosmedFiltered = array_filter($sosmedsRequest, function ($value) {
            return $value !== null;
        });

        $sosmeds = [];
        foreach ($sosmedFiltered as $sosmedId => $url) {
            $sosmeds[$sosmedId] = ['url' => $url];
        }

        return $sosmeds;
    }

    public static function filterPositions($positionsRequest): array
    {
        $positionsName = [];
        foreach (json_decode($positionsRequest, true) as $positionName) {
            $positionsName[] = $positionName['value'];
        }

        $positions = Position::whereIn('name', $positionsName)->get();
        $positionsId = [];

        foreach ($positions as $position) {
            $positionsId[] = $position->id;
        }

        return $positionsId;
    }

    public static function isCurrentUrl($url, $string = 'active')
    {
        if (Request::is($url)) {
            return $string;
        }

        return '';
        // dd(Request::is($url) ? 'active' : '');
    }

    public static function formatRupiah($number): string
    {
        $format_rupiah = "Rp " . number_format($number, 0, ',', '.');
        return $format_rupiah;
    }
}
