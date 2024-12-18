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
    vehicules </li>
@endsection
@section('content')
<map-trash />
<div class=" container-xxl " id="fab_content_container" data-select2-id="select2-data-fab_content_container">


    <div class="card" data-select2-id="select2-data-156-v9nn">

        <div class="card-header border-0 pt-6" data-select2-id="select2-data-155-sseq">

            <div class="card-title">

                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span class="path1"></span><span
                            class="path2"></span></i> <input type="text" data-kt-user-table-filter="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="Chercher une vehicule">
                </div>

            </div>



            <div class="card-toolbar" data-select2-id="select2-data-154-zqod">

                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">





                    <button type="button" class="btn btn-light-primary me-3" data-bs-target="#fab_docs"
                        data-bs-toggle="modal">
                        <i class="ki-duotone ki-file fs-2"><span class="path1"></span><span class="path2"></span></i>
                        Nouveau document
                    </button>

                </div>



                <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                    <div class="fw-bold me-5">
                        <span class="me-2" data-kt-user-table-select="selected_count"></span> Selectione(s)
                    </div>

                    <button type="button" class="btn btn-danger">
                        Supprimer
                    </button>
                </div>







            </div>

        </div>



        <div class="card-body py-4">


            <div id="fab_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                        id="fab_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" style="width: 29.9px;"
                                    aria-label="



            ">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#fab_table_users .form-check-input" value="1">
                                    </div>
                                </th>
                                <th class="min-w-125px sorting" tabindex="0" aria-controls="fab_table_users" rowspan="1"
                                    colspan="1" style="width: 206.533px;"
                                    aria-label="Marque/Model: activate to sort column ascending">Titre</th>
                                <th></th>
                                <th class="min-w-125px sorting" tabindex="0" aria-controls="fab_table_users" rowspan="1"
                                    colspan="1" style="width: 125px;"
                                    aria-label="Immatric.: activate to sort column ascending">Description</th>
                                <th class="sorting" tabindex="0" aria-controls="fab_table_users" rowspan="1" colspan="1"
                                    style="width: 125px;" aria-label="Proprietaire : activate to sort column ascending">
                                </th>
                                <th class=" sorting fs-8" tabindex="0" aria-controls="fab_table_users" rowspan="1"
                                    colspan="1" aria-label="Nbre d'infractions: activate to sort column ascending"></th>
                                <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                    style="width: 100px;" aria-label="Actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">






















                            @foreach ($docs as $doc)
                            <tr class="even/odd">
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1">
                                    </div>
                                </td>
                                <td class="d-flex align-items-center">

                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                        <a href="/">
                                            <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                <i class="ki-duotone ki-car fs-2x"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                            </div>
                                        </a>
                                    </div>


                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fs-7">{{
                                            $doc->title}} </a>
                                    </div>

                                </td>
                                <td>
                                </td>
                                <td data-order="2023-10-08T02:23:51+02:00">
                                    <div class="badge badge-light fw-bold">{{ $doc->description}}</div>
                                </td>
                                <td>

                                </td>
                                <td data-order="2023-08-19T20:43:00+02:00" class="text-center">
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('documents.edit', $doc->id)}}"
                                        class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                        tooltip="Mise a jour">
                                        <i class="ki-duotone ki-pencil fs-3"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span><span class="path5"></span></i>
                                    </a>

                                    <a href="{{ route('docs.destroy', $doc->id)}}"
                                        class="btn btn-icon btn-active-light-primary w-30px h-30px"
                                        data-kt-permissions-table-filter="delete_row">
                                        <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span><span class="path5"></span></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</div>
<div class="modal fade" id="fab_docs" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">

    <div class="modal-dialog mw-500px">

        <div class="modal-content">

            <div class="modal-header">

                <h2>Enregistement d'un nouveau document</h2>



                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>

            </div>



            <div class="modal-body scroll-y p-0">

                <form class="mx-auto w-100 py-10" action="/documents" method="POST">

                    @csrf
                    <div class="mx-10">

                        <div class="col-md-12">
                            <label class="required form-label">Titre</label>

                            <input type="text" class="form-control form-control-lg form-control-solid" name="title"
                                placeholder="Titre du document" value="">
                        </div>
                        <div>
                            <label class="form-label fw-normal fs-7">Description</label>
                            <div class="ms-auto">
                                <textarea id="" cols="20" rows="3" class="form-control bg-light"
                                    name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-center mt-5 gap-2">
                        <label class=" form-label">Avec Expiration</label>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" name="is_expired" type="checkbox" checked>
                        </div>
                    </div>

                    </div>


                    <div class="d-flex align-items-end justify-content-end pt-15 pe-md-10">



                        <div class="">
                            <button type="submit" class="btn btn-lg btn-primary me-3">
                                <span class="indicator-label" id="">
                                    Enregistrer <i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0"><span
                                            class="path1"></span><span class="path2"></span></i> </span>
                                <span class="indicator-progress">
                                    Veuillez patienter svp... <span
                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
