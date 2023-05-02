<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Family;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FamilyBoardController extends Controller
{
    /**
     * @author medilies
     */
    public function __invoke(Family $family): View|Factory
    {
        // ! optimise loading classroom & classType rels
        $family->load([
            'clients.user.primaryPhone',
            'students' => [
                'user',
                'latestRegistration' => [
                    'classroom' => [
                        'establishmentYear',
                        'classType',
                    ],
                    'exRegistration.classType',
                ],
            ],
        ]);

        return view('families.board')
            ->with('family_id', $family->id)
            ->with('father', $family->clients->where('family_title', 'father')->first())
            ->with('mother', $family->clients->where('family_title', 'mother')->first())
            ->with('students', $family->students);
    }
}
