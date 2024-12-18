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
<div class="mx-10 d-flex flex-column" id="fab_create_account_stepper">
    <form class="mx-auto w-100 pb-10" method="POST" action="{{ route('doc.update',$doc->id)}}" method=" POST">
        @csrf
        <div class="w-100 px-20 card my-5 py-8 ">
            <h3 class="stepper-title mb-5">
                Information sur le document
            </h3>
            <div class="row ">
                <div class="col-md-12">
                    <label class=" form-label">Titre</label>
                    <input type="text" class="form-control form-control-lg form-control-solid" name="title"
                        placeholder="model" value="{{ $doc->title}}">
                </div>

            </div>
            <div>
                <label class="form-label">Description</label>
                <div class="ms-2 ">
                    <textarea id="" cols="20" rows="3" class="form-control bg-light" name="description">
                {{$doc->description}}
                </textarea>
                </div>
            </div>
            <div class="col-md-4">
                        <label class=" form-label">Avec Expiration</label>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                          <input class="form-check-input" name="is_expired" type="checkbox" {{$doc->is_expired? 'checked' :
                            ''}}>
                        </div>
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
