@section('title')PROFE - EVENTOS @stop
@section('description')✅ {{ $evento[0]->et_nombre . ': ' . $evento[0]->eve_nombre }} @stop
@section('url'){{ route('evento.index') }} @stop
@section('logos'){{ asset('/img/banner/' . $evento[0]->eve_afiche) }} @stop

<x-app-layout>
    <section class="max-w-7xl mx-auto px-6">
        <div class="container">
            <div class="pt-3">
                <img src="{{ asset('/img/banner/' . $evento[0]->eve_banner) }}" class="rounded-lg" width="100%">
            </div>

            <div class="col-span-4 mt-3">
                <x-card>
                    <h2 class="text-4xl text-center font-semibold text-black mt-6 pl-3">
                        Formulario de preinscripción
                    </h2>
                    <h2 class="text-3xl font-semibold text-gray-900 mt-6 pl-3" style="border-left:solid 5px">
                        {{ $evento[0]->et_nombre }}: {{ $evento[0]->eve_nombre }}
                    </h2> <br>

                    <form action="{{ route('evento.storeParticipante') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class=" md:gap-6 mb-6">
                            <div class="pt-4">
                                <x-label for="ei_ci">Número de cédula de identidad</x-label>
                                <x-input type="number" name="ei_ci" id="ei_ci" autofocus required minlength="4"
                                    maxlength="10" pattern="[0-9]+" />
                            </div>
                            <div class="pt-4">
                                <x-label for="ei_complemento">Complemento</x-label>
                                <x-input type="text" name="ei_complemento" id="ei_complemento" autofocus
                                    maxlength="3" />
                            </div>
                            <div class="pt-4">
                                <x-label for="ei_nombres">Nombres</x-label>
                                <x-input type="text" name="ei_nombres" id="ei_nombres" autofocus required
                                    onkeyup="mayusculas(this);" maxlength="38" />
                            </div>
                            <div class="pt-4">
                                <x-label for="ei_apellido1">Apellido1</x-label>
                                <x-input type="text" name="ei_apellido1" id="ei_apellido1"
                                    onkeyup="mayusculas(this);" maxlength="25" />
                            </div>
                            <div class="pt-4">
                                <x-label for="ei_apellido2">Apellido2</x-label>
                                <x-input type="text" name="ei_apellido2" id="ei_apellido2"
                                    onkeyup="mayusculas(this);" maxlength="25" />
                            </div>
                            <div class="pt-4">
                                <x-label for="ei_fecha_nacimiento">Fecha de nacimiento</x-label>
                                <x-input type="date" name="ei_fecha_nacimiento" id="ei_fecha_nacimiento" />
                            </div>
                            <div class="pt-4">
                                <x-label for="gen_id">Sexo</x-label>
                                <select name="gen_id" id="gen_id" required
                                    class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full text-gray-800">
                                    <option value="">
                                        Seleccione el sexo
                                    </option>
                                    @foreach ($generos as $gen)
                                        <option value="{{ encrypt($gen->gen_id) }}">
                                            {{ $gen->gen_nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pt-4">
                                <x-label for="ei_celular">Celular</x-label>
                                <x-input type="number" name="ei_celular" id="ei_celular" required min="0"
                                    pattern="[0-9]+" />
                            </div>
                            <div class="pt-4">
                                <x-label for="ei_correo">Correo electronico</x-label>
                                <x-input type="email" name="ei_correo" id="ei_correo" required
                                    onkeyup="minusculas(this);" maxlength="40" />
                            </div>
                            <div class="pt-4">
                                <x-label for="dep_id">En que departamento reside</x-label>
                                <select name="dep_id" id="dep_id" required
                                    class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full text-gray-800">
                                    <option value="">
                                        Seleccione
                                    </option>
                                    @foreach ($departamentos as $dep)
                                        <option value="{{ encrypt($dep->dep_id) }}">
                                            {{ $dep->dep_nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pt-4">
                                <x-label for="em_id">Modalidad de asistencia</x-label>
                                <select name="em_id" id="em_id" required
                                    class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full text-gray-800">
                                    <option value="">
                                        Seleccione
                                    </option>
                                    {{-- @if (count($participante) <= 500)
                                        <option value="1">Presencial</option>
                                    @endif --}}
                                    <option value="2">Virtual</option>
                                </select>
                            </div>
                            {{-- <div class="pt-4">
                                <x-label for="en_id">En qué nivel participara</x-label>
                                <select name="en_id" id="en_id" required
                                    class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full text-gray-800">
                                    <option value="">
                                        Seleccione
                                    </option>
                                    @foreach ($nivel as $en)
                                        <option value="{{ encrypt($en->en_id) }}">
                                            {{ $en->en_nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div>
                                <input type="hidden" name="eve_id" id="eve_id" type="hidden"
                                    value="{{ $evento[0]->eve_id }}">
                                {{-- <input type="hidden" name="em_id" id="em_id" type="hidden" value="2"> --}}
                                <input type="hidden" name="ent_id" id="ent_id" type="hidden" value="6">
                                <input type="hidden" name="ea_id" id="ea_id" type="hidden" value="15">
                                <input type="hidden" name="en_id" id="en_id" type="hidden"
                                    value="{{ encrypt(1) }}">
                                <input type="hidden" name="ei_autorizacion" id="ei_autorizacion" type="hidden"
                                    value="0">
                            </div>
                        </div>
                        <x-button-guardar type="submit">
                            Registrar
                        </x-button-guardar>
                        <x-button-cancelar>
                            <a href="{{ route('evento.index') }}">
                                Cancelar
                            </a>
                        </x-button-cancelar>
                    </form>

                </x-card>

            </div>
        </div>
    </section>
    <script>
        // Funcion JavaScript para la conversion a mayusculas
        function mayusculas(e) {
            e.value = e.value.toUpperCase();
        }

        function minusculas(e) {
            e.value = e.value.toLowerCase();
        }
    </script>
</x-app-layout>
