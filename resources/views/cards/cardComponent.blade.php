<div class="card  rounded shadow-sm  " id="print-content">
    <div class="h-10px bg-warning rounded rounded-bottom-0">

    </div>
    <div class="text-dark text-end me-5">
        {{ $code}}
    </div>
    <div class="row text-white py-10">
        <div class="col-md-3 d-flex align-items-center justify-content-center">
            <div class="image-input image-input-outline image-input-circle bg-secondary opacity-60 p-3">
                <img alt="Logo" src="{{ asset('assets/img/logo.png')}}" class="h-50px " />
            </div>
        </div>

        <div class="col-md-7 border-start border-4 border-primary text-dark ">
            <h2 class="text-center">
                Police de Circulation Routiere
            </h2>
            <div class="my-10 ms-6">
                <div class="fw-bold fs-3">
                    {{ $car->customer->name}} {{ $car->customer->l_name}}
                </div>
                <div class="fw-bold text-muted fs-5">
                    {{ $car->customer->email}}
                </div>
                <div class="fw-bold fs-6 text-primary">
                    {{ $car->plaque}}
                </div>
                <div class="fw-bold fs-6 text-primary">
                    {{ $car->marque}} /
                    {{ $car->model}}

                </div>
                <div class="fw-bold fs-6 text-primary">
                    {{ $car->color}}

                </div>
            </div>

        </div>
        <div class="col-md-2 d-flex align-items-end">
            <span>
                {{$qrcode}}
            </span>
        </div>
    </div>

    <div class="h-10px bg-warning rounded rounded-top-0">

    </div>
</div>
