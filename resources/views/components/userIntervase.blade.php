<div class="container">
    <div class="row overflow-hidden rounded">
        <div class="bg-primary p-3 col-sm-0 col-lg-3">
            <hr>
            <ul class="list-unstyled">
                <li class=""><a class="text-decoration-none text-light" href="/account/"><i class="fas fa-sliders-h fa-fw"></i> Account</a></li>
                <li class=""><a class="text-decoration-none text-light" href="bestellingen"><i class="fa-solid fa-box fa-fw"></i> Bestellingen</a></li>
            </ul>
            <hr>
            <ul class="list-unstyled">
                <li class=""><a class="text-decoration-none text-light" href="#">#</a></li>
            </ul>
            <hr>
            <ul class="list-unstyled">
                <li class=""><a class="text-decoration-none text-light" href="#">#</a></li>
            </ul>
            <hr>
        </div>
        <div class="bg-primary p-3 col-sm-12 col-lg-9">
            <div class="bg-light" style="height:500px">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>