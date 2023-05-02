<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
use App\Models\Client;
use App\Models\Family;
use Illuminate\Support\Facades\DB;

class ClientController extends \App\Http\Controllers\Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function index()
    {
        return view('clients.index');
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function store(StoreClientRequest $request)
    {
        $family = Family::findOrFail($request->family_id);

        DB::transaction(function () use ($request, $family) {
            $client = $family->clients()->create(
                $request->safe(['phone', 'cni', 'address', 'profession', 'family_title'])
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

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function show(Client $client)
    {
        $client->load('user.primaryPhone');

        return view('clients.show')
            ->with('client', $client);
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function edit(Client $client)
    {
        $client->load('user.primaryPhone');

        return view('clients.edit')
            ->with('client', $client);
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->load('user.primaryPhone');

        // TODO check if change is needed
        DB::transaction(function () use ($request, $client) {
            $client->update($request->safe(['cni', 'address', 'profession']));
            $client->user->update($request->safe(['fname', 'lname', 'email']));
            $client->user->primaryPhone->update($request->safe(['number']));
        });

        return to_route('clients.show', ['client' => $client->id]);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return to_route('clients.index');
    }
}
