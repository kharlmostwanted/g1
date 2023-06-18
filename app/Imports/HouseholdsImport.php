<?php

namespace App\Imports;

use App\Models\Household;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;
use App\Models\User;
use Illuminate\Support\Str;

class HouseholdsImport implements ToModel, WithHeadingRow, SkipsOnError
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            $name = $row["lname"] . ', ' . $row["fname"] . ' ' . $row["mi"];
            $email = $row["fname"]. '_' . $row["lname"] . '@mail.com';

            $owner = User::updateOrCreate([
                'email' => str($email)->lower(),
            ], [
                'name' => $name,
                'first_name' => $row["fname"],
                'middle_initial' => $row["mi"],
                'last_name' => $row["lname"],
                'password' => bcrypt(Str::random(10)),
            ]);

            return Household::updateOrCreate([
                'title' => str('B' . $row["block"] . 'L' . $row["lot"]),
                'block' => $row["block"],
                'lot' => $row["lot"],
                'street' => $row["street"],
                'owner_id' => $owner->id,
            ]);
        } catch (Throwable $e) {
            return null;
        }
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
