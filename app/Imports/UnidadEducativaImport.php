<?php

namespace App\Imports;

use App\Models\UnidadEducativa;
use App\Models\Distrito;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class UnidadEducativaImport implements ToModel, WithHeadingRow,WithBatchInserts, WithChunkReading,WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $distrito;
    public function __construct()
    {
        $this->distrito = Distrito::pluck('dis_id', 'dis_codigo');
    }
    public function model(array $row)
    {
        UnidadEducativa::updateOrCreate(
            [
                'uni_edu_codigo' => $row['uni_edu_codigo'],
            ],[
                'uni_edu_nombre' => $row['uni_edu_nombre'],
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
