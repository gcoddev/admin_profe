<!DOCTYPE html>
<html>

<head>
    <title>MINEDU - PROFE</title>
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 50px 30px 30px 30px;
        }

        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            background-image: url('data:image/jpeg;base64,{{ $fondo }}');
            background-position: left;
            background-repeat: no-repeat;
            background-position: 5px 630px;
        }

        header {
            position: fixed;
            left: 0;
            top: -110px;
            right: 0;
            height: 260px;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 80px;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            font-size: 10px;
        }

        .container {
            margin: 20px auto;
            padding: 0 20px;
            text-align: center;
        }

        /* Estilos para la tabla principal */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 9px; /* Tamaño de fuente reducido */
            table-layout: fixed; /* Fija el ancho de las columnas */
            background-color: #ffffff; /* Fondo blanco para la tabla */
        }

        .main-table th, .main-table td {
            padding: 8px; /* Espaciado reducido */
            border: 1px solid #ddd;
            text-align: left;
        }

        .main-table th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        .main-table tr:nth-child(even) {
            background-color: #f9f9f9; /* Gris claro para filas pares */
        }

        .total {
            font-weight: bold;
            color: #333;
        }

        .estado-completado {
            color: #4CAF50; /* Green */
        }

        .estado-incompleto {
            color: #FF5722; /* Orange */
        }

        .estado-desconocido {
            color: #FFC107; /* Yellow */
        }

        /* Limitar el borde inferior */
        .main-table td:last-child {
            border-bottom: 2px solid #ddd; /* Ajusta el grosor del borde inferior */
        }
    </style>
</head>

<body>

    <header>
    </header>

    <main style="text-align: left; padding-top: 0px; padding-left: 12px; padding-right: 12px; padding-bottom: 25px;">
        <table width="100%">
            <tr>
                <td width="50%" style="text-align:left;">
                    <img src="data:image/jpeg;base64,{{ $logo1 }}" alt="" width="150px">
                </td>
                <td width="50%" style="text-align:left;">
                    <strong> REPORTE DE INSCRITOS Y PAGOS</strong>
                </td>
                <td width="50%" style="text-align:right;">
                    <img src="data:image/jpeg;base64,{{ $logo2 }}" alt="" width="80px">
                </td>
            </tr>
        </table>
        <br>
        <div><strong>Programa: </strong>{{ $inscripciones[0]->pro_nombre }}</div>
        <div><strong>Sede: </strong>{{ $inscripciones[0]->sede_nombre }}</div>
        <table class="main-table">
            <tr>
                <th>Nro</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>CI</th>
                <th>Celular</th>
                <th>Total Pagado</th>
                <th>Restante</th>
                <th>Turno</th>
                <th>Observaciones</th>
            </tr>
            @foreach ($inscripciones as $index => $inscripcion)
            <tr>
                <td width="5%">{{ $index + 1 }}</td>
                <td>{{ $inscripcion->per_nombre1 }} {{ $inscripcion->per_nombre2 }}</td>
                <td>{{ $inscripcion->per_apellido1 }} {{ $inscripcion->per_apellido2 }}</td>
                <td width="10%">{{ $inscripcion->per_ci}} {{ $inscripcion->per_complemento}}</td>
                <td>{{ $inscripcion->per_celular }}</td>
                <td class="total">{{ $inscripcion->total_pagado }} Bs.</td>
                <td class="total">{{ $inscripcion->restante }} Bs.</td>
                
                <td width="10%">{{ $inscripcion->pro_tur_nombre }}</td>
                <td></td>
            </tr>
            @endforeach
        </table>
        <br><br><br>
        <br><br><br>
        <table width="100%">
            <tr>
                @if ($responsable_nombre !== "No encontrado" && $responsable_apellidos !== "No encontrado" && $responsable_cargo !== "No encontrado")
                <td width="" style="text-align:center;">
                    <div>{{ $responsable_nombre }} {{ $responsable_apellidos }}</div>
                    <div><strong>{{ $responsable_cargo }}</strong></div>
                </td>
                @endif
        
                @if ($facilitador_nombre !== "No encontrado" && $facilitador_apellidos !== "No encontrado" && $facilitador_cargo !== "No encontrado")
                <td width="" style="text-align:center;">
                    <div>{{ $facilitador_nombre }} {{ $facilitador_apellidos }}</div>
                    <div><strong>{{ $facilitador_cargo }}</strong></div>
                </td>
                @endif
            </tr>
        </table>
        
    </main>

    <footer>
        <!-- Puedes agregar contenido al pie de página aquí -->
    </footer>

    <script>
        // Funcion JavaScript para la conversión a mayúsculas
        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }

        function minusculas(e) {
            e.value = e.value.toLowerCase();
        }
    </script>

</body>

</html>
