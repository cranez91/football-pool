<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserMatch;
use App\Models\UserMatchday;
use App\Models\Distribuitor;
use App\Models\Matchday;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ExcelImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        if (!is_null($row['folio'])) {
            if ($participante = UserMatchday::where('uuid', $row['folio'])->first()) {
                $participante->paid = strtolower($row['pagado']) == 'si' ? 1 : 0;
                $participante->update();
            }
            return;
        }
        $usuario = User::firstOrCreate( ['email' => Str::slug($row["participante"], '-') . "@invited.com"],
            [
                'name' => $row["participante"],
                'password' => Hash::make('12345678'),
                'type' => 'G'
            ]
        );
        $distribuidor = Distribuitor::where("name", $row["distribuidor"])->first();
        $jornada = Matchday::where("name", $row["jornada"])->first();
        Log::info([
            'distribuidor' => $distribuidor,
            'jornada' => $jornada,
            'usuario' => $usuario,
        ]);
        if (!$distribuidor || !$jornada || !$usuario) return;

        $participante = UserMatchday::create([
            'uuid' => Str::upper( Str::random(10) ),
            'user_id' => $usuario->id,
            'matchday_id' => $jornada->id,
            'distribuitor_id' => $distribuidor->id,
            'paid' => strtolower($row['pagado']) == 'si' ? 1 : 0,
            'winner' => 0,
        ]);

        $matches = [];
        foreach ($jornada->matches()->orderBy('game_id', 'asc')->get() as $index => $match) {
            $matches[] = [
                'uuid' => (string) Str::uuid(),
                'prediction' => $row[$index + 1],
                'success' => 'N',
                'match_id' => $match->id,
            ];
        }
        
        $participante->userMatches()->createMany($matches);
        return;
    }

    public function rules(): array
    {
        return [
            "distribuidor" => 'required|exists:distribuitors,name',
            "jornada" => 'required|exists:matchdays,name',
            "pagado" => 'required|min:2|max:2|string',
            "participante" => 'nullable|string|min:1|max:120',
            "folio" => 'nullable|string|min:10|max:10',
            "1" => 'nullable|string|min:1|max:1',
            "2" => 'nullable|string|min:1|max:1',
            "3" => 'nullable|string|min:1|max:1',
            "4" => 'nullable|string|min:1|max:1',
            "5" => 'nullable|string|min:1|max:1',
            "6" => 'nullable|string|min:1|max:1',
            "7" => 'nullable|string|min:1|max:1',
            "8" => 'nullable|string|min:1|max:1',
            "9" => 'nullable|string|min:1|max:1',
        ];
    }
}
