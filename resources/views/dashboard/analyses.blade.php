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
    Analyse generale </li>
@endsection
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="fab_content">
    <!--begin::Container-->
    <div class=" container-xxl " id="fab_content_container">
        <!--begin::Stats-->
        <div class="row gx-6 gx-xl-9">
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Heading-->
                        <div class="fs-2hx fw-bold">{{ $carCount}}</div>
                        <div class="fs-4 fw-semibold text-gray-400 mb-7">Vehicules enregistrees</div>
                        <!--end::Heading-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Chart-->
                            <div class="d-flex flex-center h-100px w-100px me-9 mb-5">
                                <canvas id="fab_project_list_chart"></canvas>
                            </div>
                            <!--end::Chart-->

                            <!--begin::Labels-->
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                    <div class="bullet bg-primary me-3"></div>
                                    <div class="text-gray-400">Actives</div>
                                    <div class="ms-auto fw-bold text-gray-700">{{ $carActive}}</div>
                                </div>
                                <!--end::Label-->

                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                    <div class="bullet bg-success me-3"></div>
                                    <div class="text-gray-400">Arrete</div>
                                    <div class="ms-auto fw-bold text-gray-700">{{ $carError}}</div>
                                </div>
                                <!--end::Label-->

                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center">
                                    <div class="bullet bg-gray-300 me-3"></div>
                                    <div class="text-gray-400">En circulation</div>
                                    <div class="ms-auto fw-bold text-gray-700">{{ $carOk}}</div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-6 col-xxl-4">

                <!--begin::Clients-->
                <div class="card  h-100">
                    <div class="card-body p-9">
                        <!--begin::Heading-->
                        <div class="fs-2hx fw-bold">{{ $users->count()}}</div>
                        <div class="fs-4 fw-semibold text-gray-400 mb-7">Utilisateurs</div>
                        <!--end::Heading-->

                        <!--begin::Users group-->
                        <div class="symbol-group symbol-hover mb-9">

                            @foreach ($users as $index=>$user)
                            @if ($index <3) <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                title="{{ $user->name}}">
                                <img alt="Pic" src="{{ asset($user->avatar)}}" />
                        </div>
                        @endif
                        @endforeach

                        @if ($users->count()>3)
                        <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                            data-bs-target="#fab_modal_view_users">
                            <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{$users->count()}}</span>
                        </a>

                        @endif
                    </div>
                    <!--end::Users group-->

                    <!--begin::Actions-->
                    <div class="d-flex">
                        <a href="/user" class="btn btn-primary btn-sm me-3">Tous les
                            utilisateurs</a>
                    </div>
                    <!--end::Actions-->
                </div>
            </div>
            <!--end::Clients-->
        </div>

    </div>
    <!--end::Stats-->
</div>
<!--end::Container-->
</div>
<!--end::Content-->
@endsection
