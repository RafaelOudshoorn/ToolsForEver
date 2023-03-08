<div class="container">
    <div class="row">
        <div class="card sticky-lg-top col-sm-12 col-lg-3" style="top:10px;height:150px">
            <div class="card-body">
                <hr>
                <ul class="list-unstyled">
                    <li class=""><a class="text-decoration-none" href="/account/"><i class="fas fa-sliders-h fa-fw"></i> Account</a></li>
                    <li class=""><a class="text-decoration-none" href="bestellingen"><i class="fa-solid fa-box fa-fw"></i> Bestellingen</a></li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="card col-sm-12 col-lg-9 bg-primary bg-gradient" style="min-height:400px">
            <div class="card-body p-2">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>