<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="role-title">{{ $titulo }}</h4>
                    <p class="text-body-secondary">{{ $instruccion }}</p>
                </div>
                <hr>
                <form action="{{ route($ruta) }}" method="post">
                    @csrf
                    @foreach ($campos as $campo)
                        @switch($campo['control']['element'])
                            @case('input')
                                <label class="form-label">{{ $campo['label'] }}</label>
                                <input type="{{ $campo['control']['type'] }}" name="{{ $campo['name'] }}"
                                    class="@foreach ($campo['control']['classList'] as $class){{ $class }} @endforeach"
                                    minlength="{{ $campo['control']['min'] }}" maxlength="{{ $campo['control']['max'] }}"
                                    placeholder="{{ $campo['control']['placeholder'] }}">
                            @break

                            @case('select')
                                <label class="form-label">{{ $campo['label'] }}</label>
                                @if ($campo['control']['type'] == 'multiple')
                                    <div class="player-list-container"
                                        style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                        @foreach ($campo['control']['options'] as $opciones)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="{{ $campo['name'] }}[]"
                                                    value="{{ $opciones['id'] }}" id="player-{{ $opciones['id'] }}">
                                                <label class="form-check-label" for="player-{{ $opciones['id'] }}">
                                                    {{ $opciones->persona->user->name }} {{ $opciones->persona->user->lastname }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <select name="{{ $campo['name'] }}"
                                        class="@foreach ($campo['control']['classList'] as $class){{ $class }} @endforeach">
                                        @foreach ($campo['control']['options'] as $opciones)
                                            <option value="{{ $opciones['id'] }}">{{ $opciones['nombre'] }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            @break

                            @default
                        @endswitch
                    @endforeach
                    <hr>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
