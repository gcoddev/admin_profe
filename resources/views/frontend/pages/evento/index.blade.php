@extends('frontend.layouts.master')

@section('title')
    Evento - Desarrollo emocianal en la primera infancia
@endsection
@section('og-meta-tags')
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Evento - Desarrollo emocional en la primera infancia" />
    <meta property="og:description" content="Formulario de preinscripción para el evento de desarrollo emocional en la primera infancia." />
    <meta property="og:image" content="https://profe.minedu.gob.bo/assets/evento/30072024_afiche2.jpg" />
    <meta property="og:url" content="https://profe.minedu.gob.bo/evento/25" />
    <meta property="og:image:width" content="545" />
    <meta property="og:image:height" content="493" />
    <meta property="og:image:type" content="image/jpeg" />
@endsection
@section('styles')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        .form-title {
            text-align: center;
            font-size: 2.5em;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }
    </style>
@endsection

@section('frontend-content')
    <div id="content" class="site-content"> <!-- breadcrumb-area -->
        <section class="breadcrumb-area d-flex p-relative align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="breadcrumb-wrap text-left">
                            <div class="breadcrumb-title">
                                <h2>Desarrollo emocional en la primera infancia</h2>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="breadcrumb-wrap2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Desarrollo emocional en la primera
                                    infancia</li>
                            </ol>
                        </nav>
                    </div> --}}
                </div>
            </div>
        </section> <!-- breadcrumb-area-end --><!-- Project Detail -->
        <section>

            <div class="lower-content2">
                <div class="form-container">
                    <h2 class="form-title">Formulario de preinscripción</h2>
                    <form action="{{ route('evento.storeParticipante') }}" method="POST" enctype="multipart/form-data" id="inscripcionForm">
                        @csrf
                        <div class="form-group">
                            <label for="eve_ins_carnet_identidad">Número de cédula de identidad</label>
                            <input type="text" class="form-control" name="eve_ins_carnet_identidad" id="eve_ins_carnet_identidad" autofocus required
                            pattern="[0-9]{4,10}" title="Debe tener entre 4 y 10 dígitos." />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_carnet_complemento">Complemento</label>
                            <input type="text" class="form-control" name="eve_ins_carnet_complemento" id="eve_ins_carnet_complemento"
                                maxlength="3" />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_nombre_1">Nombres</label>
                            <input type="text" class="form-control" name="eve_ins_nombre_1" id="eve_ins_nombre_1" required
                                onkeyup="mayusculas(this);" maxlength="38" />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_apellido_1">Apellido1</label>
                            <input type="text" class="form-control" name="eve_ins_apellido_1" id="eve_ins_apellido_1"
                                onkeyup="mayusculas(this);" maxlength="25" />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_apellido_2">Apellido2</label>
                            <input type="text" class="form-control" name="eve_ins_apellido_2" id="eve_ins_apellido_2"
                                onkeyup="mayusculas(this);" maxlength="25" />
                        </div>
                        <div class="form-group">
                            <label for="eve_ins_fecha_nacimiento">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="eve_ins_fecha_nacimiento" id="eve_ins_fecha_nacimiento" />
                            <div id="error-message" style="color: red; display: none;">La fecha de nacimiento debe estar entre 1960 y 2010.</div>
                        </div>
                        <div class="form-group">
                            <label for="gen_id">Sexo</label>
                            <select class="form-control" name="gen_id" id="gen_id" required>
                                <option value="">Seleccione el sexo</option>
                                @foreach ($generos as $gen)
                                <option value="{{ encrypt($gen->gen_id) }}">{{ $gen->gen_nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="eve_celular">Celular</label>
                            <input type="text" class="form-control" name="eve_celular" id="eve_celular" required
                                   pattern="[67][0-9]{7}" title="El número debe comenzar con 6 o 7 y tener 8 dígitos." />
                        </div>
                        <div class="form-group">
                            <label for="eve_correo">Correo electronico</label>
                            <input type="email" class="form-control" name="eve_correo" id="eve_correo" required
                                onkeyup="minusculas(this);" maxlength="40" />
                        </div>
                        <div class="form-group">
                            <label for="dep_id">En que departamento reside</label>
                            <select class="form-control" name="dep_id" id="dep_id" required>
                                <option value="">Seleccione</option>
                                @foreach ($departamentos as $dep)
                                <option value="{{ encrypt($dep->dep_id) }}">{{ $dep->dep_nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pm_id">Modalidad de asistencia</label>
                            <select class="form-control" name="pm_id" id="pm_id" required>
                                <option value="">Seleccione</option>
                                {{-- @if (count($participante) <= 500) --}}
                                {{-- <option value="1">Presencial</option> --}}
                                {{-- @endif --}}
                                <option value="3">Virtual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="eve_id" id="eve_id" value="1">
                            {{-- <input type="hidden" name="en_id" id="en_id" value="{{ encrypt(1) }}"> --}}
                            {{-- <input type="hidden" name="ei_autorizacion" id="ei_autorizacion" value="0"> --}}
                        </div>
                        <button type="submit" class="btn submit-btn">Enviar</button>
                    </form>
                </div>
            </div>
        </section> <!--End Project Detail -->
    </div><!-- #content -->
@endsection

@section('scripts')
    <script>
        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }

        function minusculas(e) {
            e.value = e.value.toLowerCase();
        }
    </script>
    <script>
        document.getElementById('eve_ins_fecha_nacimiento').addEventListener('change', function() {
            const minDate = new Date('1960-01-01');
            const maxDate = new Date('2010-12-31');
            const selectedDate = new Date(this.value);
            const errorMessage = document.getElementById('error-message');

            if (selectedDate < minDate || selectedDate > maxDate) {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        });
    </script>
@endsection
