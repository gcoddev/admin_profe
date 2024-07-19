<!DOCTYPE html>
<html>

<head>
    <title>MINEDU - PROFE</title>
</head>
<style>
    @page {
        margin: 50px 30px 30px 30px;
    }

    header {
        position: fixed;
        left: 0px;
        top: -110px;
        right: 0px;
        height: 260px;
        text-align: center;
    }

    footer {
        position: fixed;
        bottom: 80px;
        left: 0px;
        right: 0px;
        height: 50px;
        text-align: center;
        font-size: 10px
    }

    .completed-payment {
        display: none;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        color: green;
        margin-top: 30px;
    }
    .show-completed-payment {
        display: block; /* Muestra el mensaje cuando la condición se cumple */
        color: green; /* Ajusta el color según sea necesario */
        font-weight: bold;
    }
    
</style>

<body style="text-align: center; background-image: url('data:image/jpeg;base64,{{ $fondo }}'); background-position: left; background-repeat: no-repeat; background-position: 5px 630px;">
    <header>
    </header>

    <main style="text-align: left; padding-top: 0px; padding-left: 50px; padding-right: 50px; font-size:12px; font-family: Helvetica;">
        <table width="100%">
            <tr>
                <td width="50%" style="text-align:left; "><img src="data:image/jpeg;base64,{{ $logo1 }}" alt="" width="250px"></td>
                <td width="50%" style="text-align:right; "><img src="data:image/jpeg;base64,{{ $logo2 }}" alt="" width="180px"></td>
            </tr>
        </table>

        <h2 style="margin-top:10px; text-align:center; ">REPORTE DE PAGOS</h2>

        <table width="100%" style="margin-top: -10px">
            <tr>
                <td width="100%" style="background-color: #ddd; padding: 5px; ">
                    <b>DATOS PERSONALES</b>
                </td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Nombres(s)</td>
                <td width="35%" style="padding: 5px; ">{{ $programaInscripcion->per_nombre1 }} {{ $programaInscripcion->per_nombre2 }}</td>
                <td width="15%" style="background-color: #ddd; padding: 5px; ">Apellido(s)</td>
                <td width="30%" style="padding: 5px; ">
                    {{ $programaInscripcion->per_apellido1 . ' ' . $programaInscripcion->per_apellido2 }}
                </td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Cédula de identidad</td>
                <td width="35%" style="padding: 5px; ">
                    {{ $programaInscripcion->per_ci . '  ' . $programaInscripcion->per_complemento }}
                </td>
                <td width="15%" style="background-color: #ddd; padding: 5px; ">RDA</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->per_rda }}</td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Correo electrónico</td>
                <td width="35%" style="padding: 5px; ">{{ $programaInscripcion->per_correo }}</td>
                <td width="15%" style="background-color: #ddd; padding: 5px; ">Celular</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->per_celular }}</td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td width="100%" style="background-color: #ddd; padding: 5px; ">
                    <b>DATOS DE INSCRIPCIÓN</b>
                </td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">
                    {{ $programaInscripcion->pro_tip_nombre }}</td>
                <td width="80%" style="padding: 5px; ">{{ $programaInscripcion->pro_nombre }}</td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Costo</td>
                <td width="30%" style="padding: 5px; ">Bs {{ $programaInscripcion->pro_costo }}</td>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Carga horaria</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->pro_carga_horaria }} hrs.</td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Departamento</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->dep_nombre }}</td>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Sede</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->sede_nombre }}</td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Turno</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->pro_tur_nombre }}</td>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Modalidad</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->pm_nombre }}</td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Versión</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->pv_nombre }}</td>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Gestión</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->pv_gestion }}</td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Fecha de inicio</td>
                <td width="30%" style="padding: 5px; ">{{ \Carbon\Carbon::parse($programaInscripcion->pro_fecha_inicio_clase)->format('d-m-Y') }}</td>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Duración</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion->pd_nombre }}</td>
            </tr>
        </table>

        @php
            $totalPagado = 0;
        @endphp

        @foreach ($programaBauchers as $baucher)
            @php
                $totalPagado += $baucher->pro_bau_monto;
            @endphp
        @endforeach

        <table width="100%" style="margin-top: 20px">
            <tr>
                <td width="100%" style="background-color: #ddd; padding: 5px; ">
                    <b>DATOS DE BAUCHERS</b>
                </td>
            </tr>
        </table>

        <table width="100%" style="margin-bottom: 20px">
            <thead>
                <tr>
                    <th width="20%" style="background-color: #ddd; padding: 5px; ">Número de Baucher</th>
                    <th width="20%" style="background-color: #ddd; padding: 5px; ">Monto (Bs)</th>
                    <th width="20%" style="background-color: #ddd; padding: 5px; ">Fecha de Pago</th>
                    <th width="40%" style="background-color: #ddd; padding: 5px; ">Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programaBauchers as $baucher)
                <tr>
                    <td style="padding: 5px; ">{{ $baucher->pro_bau_nro_deposito }}</td>
                    <td style="padding: 5px; ">Bs. {{ $baucher->pro_bau_monto }}</td>
                    <td style="padding: 5px; ">{{ \Carbon\Carbon::parse($baucher->pro_bau_fecha)->format('d-m-Y') }}</td>
                    <td style="padding: 5px; ">{{ $baucher->pro_bau_tipo_pago }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="background-color: #ddd; padding: 5px; "><b>Total Pagado</b></td>
                    <td colspan="2" style="padding: 5px; ">Bs {{ $totalPagado }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color: #ddd; padding: 5px; "><b>Saldo Restante</b></td>
                    <td colspan="2" style="padding: 5px; ">Bs {{ $programaInscripcion->pro_costo - $totalPagado }}</td>
                </tr>
            </tbody>
        </table>
         <!-- Mensaje de pago completado -->
         <div class="{{ $totalPagado >= $programaInscripcion->pro_costo ? 'completed-payment show-completed-payment' : 'completed-payment' }}">
            <p>¡PAGO COMPLETO!</p>
        </div>

        <br>
        <table width="100%" style="margin-top: 30px; font-size: 12px;">
            <tr>
                <td style="text-align: center; border: 1px solid white; width: 50%;">
                    <p style="margin: 0;">.................................................</p>
                    <h3 style="margin: 0;">{{ $responsable->nombre }} {{ $responsable->apellidos }}</h3>
                    <p style="margin: 0;">{{ $responsable->cargo }}</p>
                </td>
                <td style="text-align: center; border: 1px solid white; width: 50%;">
                    <p style="margin: 0;">.................................................</p>
                    <h3 style="margin: 0;">{{ $programaInscripcion->per_nombre1 }} {{ $programaInscripcion->per_nombre2 }} {{ $programaInscripcion->per_apellido1 . ' ' . $programaInscripcion->per_apellido2 }}</h3>
                    <p style="margin: 0;">PARTICIPANTE</p>
                </td>
            </tr>
        </table>
    </main>
    <footer>
        <!-- Footer content -->
    </footer>
</body>

</html>
