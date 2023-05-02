<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstablishmentYearRequest;
use App\Models\ClassType;
use App\Models\Establishment;
use App\Models\EstablishmentYear;
use App\Models\Year;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EstablishmentYearController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function index()
    {
        $establishment_years_by_year = EstablishmentYear::with('year')->get()->groupBy('year_id')->sortDesc();

        // NEEDS MORE WORK withCount(active classrooms)
        return view('establishment_years.index')
            ->with('establishment_years_by_year', $establishment_years_by_year);
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function create()
    {
        return view('establishment_years.create')
            // TODO do not propose already created establishment years combinations
            ->with('establishments', Establishment::all())
            ->with('years', Year::whereIn('state', ['current', 'upcoming'])->get());
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function store(StoreEstablishmentYearRequest $request)
    {
        extract($request->safe()->only(['year_id', 'establishment_id']));

        // Check and fetch
        Establishment::findOrFail($establishment_id);
        $year = Year::findOrFail($year_id);

        $class_types = ClassType::all();

        // TODO make rule
        $validator = Validator::make(['year_state' => $year->state], [
            'year_state' => [Rule::notIn(['archived'])],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::transaction(function () use ($year, $class_types, $establishment_id) {
            $establishment_year = $year->establishmentYears()->create(['establishment_id' => $establishment_id]);

            foreach ($class_types as $class_type) {
                $establishment_year->classrooms()->create(['class_type_id' => $class_type->id]);
            }

            // TODO copy rooms from previous year
        });

        return to_route('establishment-years.index');
    }

    /**
     * @return \Illuminate\Http\Response
     *
     * @author medilies
     */
    public function show(EstablishmentYear $establishment_year)
    {
        return view('establishment_years.show')
            ->with('establishment_year', $establishment_year);
    }
}
