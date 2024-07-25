<?php

namespace App\Imports;

use App\Models\ProgramaInscripcion;
use App\Models\MapPersona;

use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Carbon\Carbon;





class ProgramaInscripcionImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading,WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   
    private $map_persona;
    public function __construct()
    {
        $this->map_persona = MapPersona::pluck('per_id', 'per_rda');
    }
    public function model(array $row)
    {


        ProgramaInscripcion::create(
            [
                'per_id' =>  $this->map_persona[$row['per_rda']],
                'pro_id' => $row['pro_id'],
                'pro_tur_id' => $row['pro_tur_id'],
                'sede_id' => $row['sede_id'],
                'pie_id' => 2,
            ]
        );
    }
    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1',
            'delimiter' => ';', // Delimitador
        ];
    }
    public function batchSize(): int{
        return 1000;
    }
    public function chunkSize(): int{
        return 1000;
    }
    public function rules(): array{
        return [
        ];
    }
}
