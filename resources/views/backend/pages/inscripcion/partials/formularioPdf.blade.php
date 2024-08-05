<!DOCTYPE html>
<html>

<head>
    <title>MINEDU - PROFE</title>
</head>
<style>
    /** Define the margins of your page **/
    @page {
        /* margin: 170px 70px 70px 80px; */
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

        /** Extra personal styles **/
        /* background-color: #03a9f4; */
        /* color: white; */
        text-align: center;
        /* line-height: 35px; */
        font-size: 10px
    }
</style>


<body
    style=" text-align: center; background-image: url('data:image/jpeg;base64,{{ $fondo }}'); background-position: left; background-repeat: no-repeat; background-position: 5px 630px;  ">
    <header>

    </header>

    <main
        style="text-align: left; padding-top: 0px; padding-left: 50px; padding-right: 50px; font-size:12px; font-family: Helvetica;">
        <table width="100%">
            <tr>
                <td width="50%" style="text-align:left; "><img src="data:image/jpeg;base64,{{ $logo1 }}"
                        alt="" width="250px"></td>
                <td width="50%" style="text-align:right; "><img src="data:image/jpeg;base64,{{ $logo2 }}"
                        alt="" width="180px"></td>
            </tr>
        </table>

        <h2 style="margin-top:10px; text-align:center; ">FORMULARIO DE PREINSCRIPCIÓN</h2>

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
                <td width="35%" style="padding: 5px; ">{{ $programaInscripcion[0]->per_nombre1 }} {{ $programaInscripcion[0]->per_nombre2 }}</td>
                <td width="15%" style="background-color: #ddd; padding: 5px; ">Apellido(s)</td>
                <td width="30%" style="padding: 5px; ">
                    {{ $programaInscripcion[0]->per_apellido1 . ' ' . $programaInscripcion[0]->per_apellido2 }}
                </td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Cédula de identidad</td>
                <td width="35%" style="padding: 5px; ">
                    {{ $programaInscripcion[0]->per_ci . '  ' . $programaInscripcion[0]->per_complemento }}
                </td>
                <td width="15%" style="background-color: #ddd; padding: 5px; ">RDA</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion[0]->per_rda }}</td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Correo electrónico</td>
                <td width="35%" style="padding: 5px; ">{{ $programaInscripcion[0]->per_correo }}</td>
                <td width="15%" style="background-color: #ddd; padding: 5px; ">Celular</td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion[0]->per_celular }}</td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td width="100%" style="background-color: #ddd; padding: 5px; ">
                    <b>DATOS DE PREINSCRIPCIÓN</b>
                </td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">
                    {{ $programaInscripcion[0]->pro_tip_nombre }}</td>
                <td width="80%" style="padding: 5px; ">{{ $programaInscripcion[0]->pro_nombre }}</td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Departamento</td>
                <td width="80%" style="padding: 5px; ">
                    {{ $programaInscripcion[0]->dep_nombre }}
                </td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Sede</td>
                <td width="80%" style="padding: 5px; ">
                    {{ $programaInscripcion[0]->sede_nombre }}
                </td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">Turno</td>
                <td width="30%" style="padding: 5px; ">
                    {{ $programaInscripcion[0]->pro_tur_nombre }}
                </td>
                <td width="25%" style="background-color: #ddd; padding: 5px; ">Modalidad</td>
                <td width="25%" style="padding: 5px; ">
                    {{ $programaInscripcion[0]->pm_nombre }}
                </td>
            </tr>
            <tr>
                <td width="20%" style="background-color: #ddd; padding: 5px; ">
                    Versión
                </td>
                <td width="30%" style="padding: 5px; ">{{ $programaInscripcion[0]->pv_nombre }} {{ $programaInscripcion[0]->pv_numero }}</td>
                <td width="25%" style="background-color: #ddd; padding: 5px; ">Fecha de preinscripción</td>
                <td width="25%" style="padding: 5px; ">
                    {{ date('d-m-Y', strtotime($programaInscripcion[0]->created_at)) }}
                </td>
            </tr>
        </table>

        <table width="100%" style="padding-top: 10px">
            <tr>
                <td width="65%" class="text-center" style="text-align: center;">
                    <div style="border-color: #aaa; background-color: #bbb; padding: 15px; font-size: 18px; ">
                        <img src="data:image/jpeg;base64,{{ $icono1 }}" alt="" width="100px"> <br>
                        Una vez realizada la preinscripción, usted dispone de un plazo de 72 horas para confirmar la
                        inscripción en la sede correspondiente. De no hacerlo dentro de este período, la preinscripción
                        será automáticamente cancelada sin derecho a reclamo.
                    </div>
                </td>
                <td width="35%" style="text-align: center;">
                    <img src="data:image/jpeg;base64,{{ $qr }}" alt="" width="220px">
                    <p style="font-size: 10px; text-align:center">
                        VERIFICAR Y/O VOLVER A DESCARGAR <br> FORMULARIO DE PREINSCRIPCIÓN
                    </p>
                </td>
            </tr>
        </table>

        {{-- <table width="70%">
            <tr>
                <td width="100%"
                    style=" padding: 10px; text-align: justify; background-color: #eeeeee; font-size:11px; ">
                    <b>NOTA</b>
                    <ul>
                        <li>
                            Reiteramos la presentación de este formularios de preinscripción para confirmar su
                            participación.
                        </li>
                    </ul>
                </td>
            </tr>
        </table> --}}
    </main>

    <script>
        // Funcion JavaScript para la conversion a mayusculas
        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }

        function minusculas(e) {
            e.value = e.value.toLowerCase();
        }
    </script>

</body>

</html>
