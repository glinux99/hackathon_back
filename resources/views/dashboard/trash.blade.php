@extends('layouts.app')
@section('menuTitle')
Tableau de bord
@endsection
@section('contentIndex')

<li class="breadcrumb-item text-muted">
    <a href="/" class="text-muted">
        Acceuil </a>
</li>
<li class="breadcrumb-item text-dark">
    vehicule </li>
@endsection
@section('content')
<div class="mx-10 d-flex flex-column">
    <form class="mx-auto w-100 pb-10" action="{{ route('car.update',$car->id)}}" method="POST">
        @csrf
        <div class="w-100 px-20 card my-5 py-8 ">
            <h3 class="stepper-title mb-5">
                Information sur le vehicule
            </h3>
            <div class="row ">
                <div class="col-md-6">
                    <label class=" form-label">Marque</label>
                    <input type="text" class="form-control form-control-lg form-control-solid" name="marque"
                        placeholder="model" value="{{ $car->marque}}">
                </div>
                <div class="col-md-6">
                    <label class=" form-label">Model </label>
                    <input type="text" class="form-control form-control-lg form-control-solid" name="model"
                        placeholder="model" value="{{ $car->model}}">
                </div>
                <div class="col-md-6 d-flex">
                    <div class="w-50">
                        <label class=" form-label">Couleur</label>
                        <input type="color" class="form-control form-control-lg form-control-solid" name="couleur"
                            placeholder="couleur" name="color" value="{{ $car->color}}">

                    </div>
                    <div class="w-50 ms-1 ">
                        <label class=" form-label">Carburateur</label>
                        <input type="text" class="form-control form-control-lg form-control-solid" name="couleur"
                            placeholder="couleur" name="carburateur" value="{{ $car->carburateur}}">

                    </div>
                </div>
                <div class="col-md-6">
                    <label class=" form-label">Annee de Fab</label>
                    <input type="text" class="form-control form-control-lg form-control-solid" placeholder=""
                        name="year" value="{{ $car->year}}">
                </div>
                <div class="col-md-6">
                    <label class=" form-label">Plaque du Vehicule</label>
                    <input type="text" class="form-control form-control-lg form-control-solid" placeholder=""
                        name="plaque" value="{{ $car->plaque}}">
                </div>
                <div class="col-md-6">
                    <label class=" form-label">Num d'identification du chassi</label>
                    <input type="text" class="form-control form-control-lg form-control-solid" placeholder=""
                        name="veh_id_number" value="{{ $car->veh_id_number}}">
                </div>
                @foreach ($docs as $doc)
                <div class="col-md-6">
                    <label class=" form-label">Document {{ $doc->document->title}} (# {{$doc->document->is_expired == true ? 'Peut' : 'Non'}} expire)</label>
                  
                    @if($doc->document->is_expired)
                    <input type="date" class="form-control form-control-lg form-control-solid" placeholder=""
                        name="expiration[]" value="{{ $doc->expiration}}">
                    <input type="hidden" name="documents[]" value="{{$doc->id}}">
                    @else
                    <div class="bg-secondary px-4 d-flex align-items-center justify-content-between">
                                                   <span > A duree indeterminee</span> 
                        
                        <span>
                                                   <div class="col-md-4">
                        <label class=" form-label">Present</label>
                        <div class="form-check form-check-sm form-check-custom form-check-solid mb-1">
                        <!-- <input type="hidden" name="docRead[]" value="{{$doc->id}}"> -->
                          <input class="form-check-input" name="is_read_{{$doc->id}}" type="checkbox" {{ $doc->is_read ?  "checked" : ''}}>
                        </div>
                    </div>  
                                                   </span>
                        </div>
                    @endif
                </div>
                @endforeach
                <div class="col-md-6 row d-flex align-items-center">
                    <div class="col-md-4">
                        <label class=" form-label">Infractions</label>
                        <input type="text" class="form-control form-control-lg form-control-solid" placeholder=""
                            name="inf" value="{{ $car->inf??0}}">
                    </div>
                    <div class="col-md-4">
                        <label class=" form-label">Status</label>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" name="status" type="checkbox" {{$car->status? 'checked' :
                            ''}}>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class=" form-label">Enferme</label>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" name="lock" type="checkbox" {{$car->lock? 'checked' : ''}}>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="w-100 px-20 d-md-flex flex-column card pt-5">
            <h3 class="stepper-title mb-5">
                Information sur le proprietaire
            </h3>
            <div class="row">
                <div class="col-md-6">
                    <label class=" form-label">Nom</label>
                    <input type="text" class="form-control form-control-lg form-control-solid" name="name"
                        placeholder="nom du proprietaire" value="{{ $car->customer->name}}">
                </div>
                <div class="col-md-6">
                    <label class=" form-label">Prenom</label>
                    <input type="text" class="form-control form-control-lg form-control-solid" name="l_name"
                        placeholder="prenom du proprietaire" value="{{ $car->customer->l_name}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class=" form-label">Telephone</label>
                    <input type="number" class="form-control form-control-lg form-control-solid" name="phone"
                        placeholder="" value="{{ $car->customer->phone}}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control form-control-lg form-control-solid" name="email"
                        placeholder="email du proprietaire" value="{{ $car->customer->email}}">
                </div>
            </div>
            <div>
                <label class="form-label">Adresse</label>
                <div class="ms-2 ">
                    <textarea id="" cols="20" rows="3" class="form-control bg-light" name="address">
                {{$car->customer->address}}
                </textarea>
                </div>
            </div>






            <div class="d-flex flex-stack pt-15 px-md-20 my-5 d-flex justify-content-end ">




                <div class=" ">
                    <button type="submit" class="btn btn-lg btn-primary me-3">
                        <span class="indicator-label">
                            Envoyer
                            <i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0"><span class="path1"></span><span
                                    class="path2"></span></i> </span>
                        <span class="indicator-progress">
                            Veuillez patienter svp... <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>

            </div>

    </form>

</div>
@endsection
