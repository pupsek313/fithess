<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use App\Models\Trainer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    private const SORTS = [
        'name'       => 'По имени',
        'experience' => 'По стажу (сначала опытные)',
        'price'      => 'По цене (сначала дешёвые)',
        'new'        => 'Сначала новые',
    ];

    // общий запрос для каталога и PDF: поиск + фильтр + сортировка
    private function catalogQuery(Request $request): Builder
    {
        $sort = $this->sortKey($request);

        $query = Trainer::with('specialization')
            ->search($request->string('q')->trim()->toString())
            ->when($request->integer('specialization'), fn ($q, $id) => $q->where('specialization_id', $id));

        return match ($sort) {
            'experience' => $query->orderByDesc('experience'),
            'price'      => $query->orderBy('price'),
            'new'        => $query->latest()->orderByDesc('id'),
            default      => $query->orderBy('name'),
        };
    }

    // белый список: чужое значение из адреса заменяется на 'name'
    private function sortKey(Request $request): string
    {
        $sort = $request->query('sort');

        return in_array($sort, array_keys(self::SORTS), true) ? $sort : 'name';
    }

    public function index(Request $request)
    {
        $trainers = $this->catalogQuery($request)->paginate(9)->withQueryString();

        $specializations = Specialization::withCount('trainers')
            ->orderBy('name')
            ->get();

        $sorts = self::SORTS;
        $sort = $this->sortKey($request);

        return view('trainers.index', compact('trainers', 'specializations', 'sorts', 'sort'));
    }

    public function pdf(Request $request)
    {
        $trainers = $this->catalogQuery($request)->get();

        return Pdf::loadView('pdf.catalog', compact('trainers'))
            ->setPaper('a4')
            ->download('trainers-' . now()->format('Y-m-d') . '.pdf');
    }

    public function show(Trainer $trainer)
    {
        $trainer->load('specialization');

        $others = $trainer->specialization->trainers()
            ->where('id', '!=', $trainer->id)
            ->take(3)
            ->get();

        return view('trainers.show', compact('trainer', 'others'));
    }

    public function attachment(Trainer $trainer)
    {
        abort_if(! $trainer->attachment || ! Storage::exists($trainer->attachment), 404);

        return Storage::download($trainer->attachment, 'Программа-тренировок.pdf');
    }
}