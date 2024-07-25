<?php

namespace App\Imports;

use App\Models\MapPersona;
use App\Models\MapSubsistema;
use App\Models\MapNivel;
use App\Models\Genero;
use App\Models\MapEspecialidad;
use App\Models\MapCargo;
use App\Models\MapCategoria;
use App\Models\UnidadEducativa;
use App\Models\AreaTrabajo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Carbon\Carbon;

class MapPersonaImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading,WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $subsistema;
    private $nivel;
    private $especialidad;
    private $categoria;
    private $cargo;
    private $unidad_educativa;
    private $area_trabajo;
    public function __construct()
    {
        $this->subsistema = MapSubsistema::pluck('sub_id', 'sub_nombre');
        $this->nivel = MapNivel::pluck('niv_id', 'niv_nombre');
        $this->especialidad = MapEspecialidad::pluck('esp_id', 'esp_nombre');
        $this->categoria = MapCategoria::pluck('cat_id', 'cat_nombre');
        $this->cargo = MapCargo::pluck('car_id', 'car_nombre');
        $this->unidad_educativa = UnidadEducativa::pluck('uni_edu_id', 'uni_edu_codigo');
        $this->area_trabajo = AreaTrabajo::pluck('area_id', 'area_nombre');
    }
    public function model(array $row)
    {

        // Eliminar cualquier carácter no numérico del CI
        $per_ci = preg_replace('/[^0-9]/', '', $row['per_ci']);
        // Eliminar cualquier carácter no numérico del CI
        $per_rda = preg_replace('/[^0-9]/', '', $row['per_rda']);
        // Limpiar espacios adicionales en los nombres y apellidos

        // $per_nombre1 = $this->cleanString($row['per_nombre1']);
        // $per_nombre2 = $this->cleanString($row['per_nombre2']);
        // $per_apellido1 = $this->cleanString($row['per_apellido1']);
        // $per_apellido2 = $this->cleanString($row['per_apellido2']);

        // Convertir fecha al formato adecuado
        $per_fecha_nacimiento = Carbon::createFromFormat('Y-m-d', $row['per_fecha_nacimiento'])->format('Y-m-d');
        //$date = DateTime::createFromFormat('d/m/Y', $row['per_fecha_nacimiento']);
        //$per_fecha_nacimiento = $date->format('Y-m-d');

        // Convertir SI/NO a booleano
        $per_en_funcion = ($row['per_en_funcion'] == 'SI') ? true : false;
        $per_libreta_militar = ($row['per_libreta_militar'] == 'SI') ? true : false;

        MapPersona::updateOrCreate(
            [
                'per_ci' => $per_ci,
                'per_complemento' => $row['per_complemento'??" "],
                'per_fecha_nacimiento' => $per_fecha_nacimiento,
            ],
            [
            'per_rda' => $per_rda,
            'per_nombre1' => $row['per_nombre1'],
            'per_nombre2' => $row['per_nombre2'],
            'per_apellido1' => $row['per_apellido1'],
            'per_apellido2' => $row['per_apellido2'],
            'per_en_funcion' => $per_en_funcion,
            'per_libreta_militar' => $per_libreta_militar,
            'gen_id' => $row['gen_id'],
            'esp_id' => $this->especialidad[$row['esp_nombre']],
            'cat_id' => $this->categoria[$row['cat_nombre']]??" ",
            'car_id' => $this->cargo[$row['car_nombre']],
            'sub_id' => $this->subsistema[$row['sub_nombre']??" "],
            'niv_id' =>  $this->nivel[$row['niv_nombre']],
            'uni_edu_id' =>  $this->unidad_educativa[$row['uni_edu_codigo']],
            'area_id' =>  $this->area_trabajo[$row['area_nombre']??" "],
            ]
        );
        return null; // No devolver un nuevo modelo, ya que estamos usando updateOrCreate

    }
    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1',
            'delimiter' => ';', // Delimitador
        ];
    }
    // private function cleanString($string)
    // {
         // Quitar espacios adicionales y dejar solo un espacio entre palabras
    //     return preg_replace('/\s+/', ' ', trim($string));
    // }
    public function batchSize(): int{
        return 1000;
    }
    public function chunkSize(): int{
        return 1000;
    }
    public function rules(): array{
        return [
            '*.per_nombre1' => [
                'required',
                'string',
            ],
            '*.per_nombre2' => [
                'required',
                'string',
            ],
            '*.per_complemento' => [
                'required',
                'string',
            ],
            '*.per_apellido1' => [
                'required',
                'string',
            ],
            '*.per_apellido2' => [
                'required',
                'string',
            ],
            '*.per_ci' => [
                'required',
                'numeric',
            ],
            '*.per_rda' => [
                'required',
                'numeric',
            ],
        ];
    }
}
