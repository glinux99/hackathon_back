<!DOCTYPE html>
<!--
Author: linux99
Product Name: PCR
Product Version: 1.0
Website: subnetcongo.net
Contact: danielkikimba@mali-tic.com
Follow: www.twitter.com/genesiskikimba
Like: www.facebook.com/danielkikimba
-->
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title>@yield('title', 'PCR Controller | Acceuil')</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="Seven admin dashboard live demo. Check out all the features of the admin panel. Light & dark skins. A large number of settings, additional services and widgets." />
    <meta name="keywords"
        content="Seven, bootstrap, bootstrap 5, dmin themes, free admin themes, bootstrap admin, bootstrap dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="controller la vehicule" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="Controlle de la vehicule" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />



    <link href="../../assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />




    <link href="../../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    @vite(['resources/js/app.js'])

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-37564768-1');
    </script>

    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>




<body id="fab_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">

    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>


    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>




    <div class="d-flex flex-column flex-root">

        <div class="page d-flex flex-row flex-column-fluid">
            @include('layouts.sidebar')


            <div class="wrapper d-flex flex-column flex-row-fluid" id="fab_wrapper">

                <div id="fab_header" class="header " data-kt-sticky="true" data-kt-sticky-name="header"
                    data-kt-sticky-offset="{default: '200px', lg: '300px'}">


                    <div class=" container-xxl  d-flex align-items-center justify-content-between"
                        id="fab_header_container">


                        <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-5 pb-lg-0"
                            data-kt-swapper="true" data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#fab_content_container', lg: '#fab_header_container'}">


                            <h1 class="text-dark fw-semibold my-0 fs-2">
                                @yield('menuTitle')</h1>



                            <ul class="breadcrumb breadcrumb-line text-muted fw-semibold fs-base my-1">

                                @yield('contentIndex')
                            </ul>

                        </div>



                        <div class="d-flex d-lg-none align-items-center ms-n2 me-2">

                            <div class="btn btn-icon btn-active-icon-primary" id="fab_aside_toggle">
                                <i class="ki-duotone ki-abstract-14 fs-2x"><span class="path1"></span><span
                                        class="path2"></span></i>
                            </div>



                            <a href="/" class="d-flex align-items-center">
                                <img alt="Logo" src="{{ asset('assets/img/logo.png')}}" class="h-40px" />
                            </a>

                        </div>



                        <div class="d-flex flex-shrink-0">

                            <div class="d-flex ms-3">
                                <a href="#" class=" btn bg-body btn-color-gray-600 btn-active-info"
                                    tooltip="Nouveau vehicule" data-bs-toggle="modal"
                                    data-bs-target="#fab_modal_create_account">
                                    Nouveau vehicule
                                </a>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="content d-flex flex-column flex-column-fluid" id="app">
                    <div class="mx-10">
                        @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $index=>$error)
                            {{ $error }}
                            @if($errors->count()>1)
                            @if ($index<$errors->count()-2)
                                ,
                                @elseif ($index == $errors->count()-2)
                                mais aussi
                                @endif

                                @endif

                                @endforeach
                                .
                        </div>
                        @endif
                    </div>
                    @yield('content')
                </div>

                @include('layouts.footer')
            </div>

        </div>

    </div>





    <div id="fab_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
    </div>



    <div class="modal fade" id="fab_modal_create_account" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true">

        <div class="modal-dialog mw-1000px">

            <div class="modal-content">

                <div class="modal-header">

                    <h2>Enregistement d'un nouveau vehicule</h2>



                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>

                </div>



                <div class="modal-body scroll-y p-0">

                    <div class="stepper stepper-links d-flex flex-column" id="fab_create_account_stepper">

                        <div class="stepper-nav ">

                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Information sur le vehicule
                                </h3>
                            </div>



                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">
                                    Information sur le proprietaire
                                </h3>
                            </div>



                        </div>



                        <form class="mx-auto w-100 py-10" novalidate="novalidate" id="fab_create_account_form"
                            action="/cars" method="POST" enctype="multipart/form-data">


                            <div class="current" data-kt-stepper-element="content">

                                <div class="w-100 px-20 d">
                                    <div class="row ">


                                        <div class="col-md-6">
                                            <label class="required form-label">Model / Marque</label>
                                            <select id="marque" data-close-on-select="false"
                                                data-placeholder="Chercher un model /Marque" data-allow-clear="true"
                                                class="form-select form-select-lg form-select-solid"
                                                data-placeholder="Select an option" name="marque">
                                                <option></option>
                                            </select>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="model" hidden id="model" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="required form-label">Plaque</label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="plaque" placeholder="0021BG | 01" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class=" form-label">Annee de Fab</label>
                                            <div class="input-group date">
                                                <input type="date"
                                                    class="form-control form-control-lg form-control-solid"
                                                    value="15/11/2023" name="year" />

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class=" form-label">Carburateur</label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="carburateur" id="carburateur" placeholder="" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="required form-label">Numero d'identification du chassi</label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="veh_id_number" placeholder="1HGCR222222222222" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class=" form-label">Couleur</label>
                                            <input type="color" class="form-control form-control-lg form-control-solid"
                                                name="color" placeholder="couleur du vehicule" value="">
                                        </div>
                                        @foreach (Session('documents') as $doc)
                                        <div class="card border border-dashed border-gray-300 my-5 pb-5  px-10">
                                            <span class="fw-bold fs-5 mb-3">
                                                Document {{ $doc->title}}
                                            </span>
                                            <div class="row ms-20">
                                                <div class="col-md-6">
                                                    <label class="required form-label">Date d'expiration</label>
                                                    @if($doc->is_expired)
                                                    <input type="date"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="expiration{{$doc->id}}" placeholder="couleur du vehicule"
                                                        value="">
                                                    @else
                                                    <div class="bg-secondary px-4 d-flex align-items-center justify-content-between">
                                                   <span > A duree indeterminee</span> 
                                                   <span>
                                                   <div class="col-md-4">
                        <label class=" form-label">Present</label>
                        <div class="form-check form-check-sm form-check-custom form-check-solid mb-1">
                          <input class="form-check-input" name="is_read{{ $doc->id}}" type="checkbox" checked>
                        </div>
                    </div>  
                                                   </span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label class=" form-label">Fichier</label>
                                                    <input type="file"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="file{{$doc->id}}" placeholder="couleur du vehicule"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>


                            <div data-kt-stepper-element="content">
                                @csrf
                                <div class="w-100 px-20 d-md-flex flex-column ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="required form-label">Nom</label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="name" placeholder="nom du proprietaire" value="">
                                        </div>
                                        <div class="col-md-6">
                                            <label class=" form-label">Prenom</label>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                name="l_name" placeholder="prenom du proprietaire" value="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="required form-label">Telephone</label>
                                            <input type="number" class="form-control form-control-lg form-control-solid"
                                                name="phone" placeholder="" value="" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control form-control-lg form-control-solid"
                                                name="email" placeholder="email du proprietaire" value="">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label fw-normal fs-7">Adresse</label>
                                        <div class="ms-auto">
                                            <textarea id="" cols="20" rows="3" class="form-control bg-light"
                                                name="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div class="d-flex flex-stack pt-15 px-md-20">

                                <div class="mr-2">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3"
                                        data-kt-stepper-action="previous" data-kt-stepper-state="hide-on-last-step">
                                        <i class="ki-duotone ki-arrow-left fs-4 me-1"><span class="path1"></span><span
                                                class="path2"></span></i> Back
                                    </button>
                                </div>



                                <div class="">
                                    <button type="submit" class="btn btn-lg btn-primary me-3"
                                        data-kt-stepper-action="submit">
                                        <span class="indicator-label" id="">
                                            Envoyer
                                            <i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0"><span
                                                    class="path1"></span><span class="path2"></span></i> </span>
                                        <span class="indicator-progress">
                                            Veuillez patienter svp... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <button type="submit" id="submitHidden" hidden></button>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                        Continue
                                        <i class="ki-duotone ki-arrow-right fs-4 ms-1 me-0"><span
                                                class="path1"></span><span class="path2"></span></i> </button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script>
        var hostUrl = "/";
    </script>


    <script src="../../assets/plugins/global/plugins.bundle.js"></script>
    <script src="../../assets/js/scripts.bundle.js"></script>



    <script src="../../assets/plugins/custom/datatables/datatables.bundle.js"></script>



    <script src="../../assets/js/custom/apps/projects/list/list.js"></script>
    <script src="../../assets/js/widgets.bundle.js"></script>
    <script src="../../assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="../../assets/js/custom/utilities/modals/create-account.js"></script>
    <script src="../../assets/js/custom/utilities/modals/create-campaign.js"></script>
    <script src="../../assets/js/custom/utilities/modals/users-search.js"></script>
    <script src="{{asset('assets/js/custom/apps/user-management/users/list/table.js')}}"></script>
    <script src="../assets/js/custom/account/settings/signin-methods.js"></script>
    <script src="../assets/js/custom/account/settings/profile-details.js"></script>
    <script src="../assets/js/custom/account/settings/deactivate-account.js"></script>
    <script src="../assets/js/custom/pages/user-profile/general.js"></script>
    <script>
        $('#marque').select2({
              placeholder: 'Seclectionner une marque',
              tags: true,
              ajax: {
                  url: '/selectModel',
                  dataType: 'json',
                  delay: 100,
                  processResults: function(data) {
                      return {
                          results: $.map(data, function(item) {
                            $('#carburateur').val(item.carburateur);
                            $('#model').val(item.model);
                              return {
                                text: `${item.model} / ${item.marque}`,
                                  id: item.marque,
                              }
                          }),
                      };
                  },
                  cache: true
              },
              dropdownParent: $('#fab_modal_create_account')
          });
    </script>

    <script>
        function printContent() {
      // Sélectionnez le contenu à imprimer
      var content = document.querySelector('#print-content');

      // Spécifiez la taille du texte imprimé
      content.style.fontSize = '20px';

      // Imprimez le contenu
      window.print();
    }
    </script>

</body>

</html>
