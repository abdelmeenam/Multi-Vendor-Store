<?php

namespace App\Models;

use App\Models\RoleAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function abilities()
    {
        return $this->hasMany(RoleAbility::class);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public static function createWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->post('name'),
            ]);

            foreach ($request->post('abilities') as $abilityCode => $value) {
                RoleAbility::create([
                    'role_id' => $role->id,
                    'ability' => $abilityCode,
                    'type' => $value,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $role;
    }

    /**
     * @param Request $request
     * @return $this
     * @throws \Exception
     * update a given object
     */
    public function updateWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->update([
                'name' => $request->post('name'),
            ]);

            foreach ($request->post('abilities') as $abilityCode => $value) {
                RoleAbility::updateOrCreate([
                    //check if these exist in our table then you will update, else insert
                    'role_id' => $this->id,
                    'ability' => $abilityCode,
                ], [
                    'type' => $value,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this;
    }
}
