<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\Clients\StoreClientRequest;
use App\Models\Family;
use Illuminate\Support\Facades\DB;

class FamilyController extends \App\Http\Controllers\Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function index()
    {
        return view('families.index');
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function create()
    {
        return view('families.create');
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function store(StoreClientRequest $request)
    {
        $family = Family::create();

        DB::transaction(function () use ($request, $family) {
            $client = $family->clients()->create(
                $request->safe(['phone', 'cni', 'address', 'profession', 'family_title','home_num', 'whatsapp'])
            );

            $user = $client->user()->create(
                $request->safe(['fname', 'lname', 'email'])
            );

            if (! empty($request->safe(['number'])['number'])) {
                $user->primaryPhone()->create(
                    $request->safe(['number']) +
                        ['primary' => true]
                );
            }
        });

        return to_route('families.board', ['family' => $family->id]);
    }
}
