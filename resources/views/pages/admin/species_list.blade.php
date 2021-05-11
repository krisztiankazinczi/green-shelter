@extends('layouts.admin')

@section('content')
<div class="mt-5 container-fluid">
    <div class="d-flex justify-content-between">
      <h2>Regisztrált állatfajták az oldalon</h2>
      <a href="{{ route('show.create.species') }}" class="text-decoration-none">
        <button class="mb-2 btn btn-primary btn-sm">
          Új létrehozása
        </button>
      </a>
    </div>
    <table class="table mt-3 table-striped">
        <thead>
            <tr>
              <th scope="col">Kép</th>
              <th scope="col">Fajta</th>
              <th scope="col">Leírás</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($animal_types as $type)
            <tr>
                <td>
                <div class="d-flex justify-content-center">
                  <img src="/images/{{ $type->image_uri }}" alt="{{ $type->name }}-fajta" style="height: 100px; max-width: 200px;" />
                </div>
                </td>
                <td>{{ $type->name }}</td>
                <td>{!! $type->description !!}</td>
                <td>
                  <div class="d-flex flex-column">
                    <a href="{{ route('anymal.type', ['type_id' => $type->id]) }}" class="text-decoration-none">
                      <button class="mb-2 btn btn-sm btn-link">
                        Megtekintés
                      </button>
                    </a>
                    {{-- <a href="/type/{{ $type->id }}/edit" class="text-decoration-none"> --}}
                    <a href="{{ route('anymal.type.show', ['id' => $type->id]) }}" class="text-decoration-none">
                      <button class="mb-2 btn btn-sm btn-link">
                        Szerkesztés
                      </button>
                    </a>
                    <button 
                      class="mb-2 btn btn-sm btn-link" 
                      data-toggle="modal" 
                      data-target="#{{ $type->id . '-delete-species' }}"
                    >
                      Törlés
                    </button>
                    @include(
                    'partials.modal_confirm', 
                    [
                      'id' => $type->id . '-delete-species',
                      'question' => 'Biztosan törölni szeretnéd ezt az állatfajtát? - ' . $type->name,
                      'route' => 'animal.type.delete',
                      'method' => 'DELETE',
                      'route_params' => [$type->id],
                      'action_button_text' => 'Biztosan törlöm',
                      'action_button_class' => 'btn btn-danger'
                    ])    
                  </div>
                </td>
            </tr>
            @endforeach            
        </tbody>
    </table>
  </div>
@endsection