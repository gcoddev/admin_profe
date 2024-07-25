<?php

namespace App\Imports;

use App\Models\Distrito;
use App\Models\Departamento;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class DistritoImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading,WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $departamento;
    public function __construct()
    {
        $this->departamento = Departamento::pluck('dep_id', 'dep_nombre');
    }
    public function model(array $row)
    {
        // Verificar si el 'dep_nombre' existe en el mapeo
        if (!isset($this->departamento[$row['dep_nombre']])) {
            // Manejar el caso donde 'dep_nombre' no se encuentra
            // Por ejemplo, lanzar una excepción o registrar un error
            throw new \Exception('Departamento no encontrado: ' . $row['dep_nombre']);
        }
        Distrito::updateOrCreate(
            [
                'dis_codigo' => $row['dis_codigo'],
            ],
            [
                'dis_nombre' => $row['dis_nombre'],
                'dep_id' =>  $this->departamento[$row['dep_nombre']],
            ]
        );
        return null;
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
